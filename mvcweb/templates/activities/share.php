<?php
status_header( 204 );

if ( empty( @$_POST[ 'code' ] ) ) return;
if ( empty( @$_POST[ 'email' ] ) ) return;
if ( empty( @$_COOKIE[ 'fav-activities' ] ) ) return;

$code = $_POST[ 'code' ];
$mailto = $_POST[ 'email' ];
$message = $_POST[ 'message' ];
$from = $_POST[ 'from' ];
$favorites = explode( '\\",\\"', substr( $_COOKIE[ 'fav-activities' ], 3, -3 ) );

if ( empty( get_option("MVC_OSA_" . strtolower( $code ) ) ) ) return;

$data = new SimpleXMLElement( get_option("MVC_OSA_" . strtolower( $code ) ) );


// from cookies we got all user favorites (may contain favs from diff resorts), so need to filter this list

$activities = array();
$activitiesData = array(); // required only to retreive occurrences by getActivitiesOccurences()
$favOccIds = array(); // for fast search btw all occurrences

foreach ( $favorites as $fav ){
    $fd = explode( '_', $fav );
    $xd = $data->xpath("//OSARowCollection/Row[@id='$fd[0]'][active='yes']");
    if ( !$xd ) continue;
    $activitiesData[ $fd[0] ] = $xd[0]; // use activity id as key to prevent duplicates of same event
    $act = new stdClass();
    $act->id = $fd[0];
    $act->dateTime = DateTime::createFromFormat( 'YmdHi', $fd[1] );
    $act->dateTimeTxt = $fd[1];
    $act->data = $xd[0];
    $activities[] = $act;
    
    $favOccIds[] = $fav;
}

// in the case when user add activity occurrence to favs, and after, occurrence time was changed,
// we need to retrieve all occurrences for selected activities to not mail events with wrong times
require_once 'activity-events.php';
$occurrences = getActivitiesOccurences( $activitiesData ); // array indexed by occurences times + 4 digits (seq number)
unset( $activitiesData, $favorites, $data );

foreach ( $occurrences as $occTimeSeq => $occ ){
    $oi = $occ->data->xpath("@id")[0] . '_' . substr( $occTimeSeq, 0, -4 );
    if ( !in_array( $oi, $favOccIds ) ){
        unset( $occurrences[ $occTimeSeq ] );
    }
}

unset( $activities, $favOccIds );

// Start of email compose

// get mail body
ob_start();
include 'email-template.php';
$mailBody = ob_get_clean();

//echo $mailBody;

// generate ICS file
require_once dirname(__DIR__) . '/classes/ics-class.php';
$calendars = array();
foreach ( $occurrences as $occ ){
    $cal = new ICS();
    $cal->begin( 'VEVENT' );
    $cal->addRow( 'UID', $occ->data->xpath("@id")[0] .'_'.$occ->occurenceDate->format('YmdHi') );
    $cal->addRow( 'DTSTAMP', 'now', ICS::FORMAT_DATE_TIME );
    $cal->addRow( 'SUMMARY', $occ->data->xpath("ActivityTitle")[0] );
    $cal->addRow( 'DESCRIPTION', $occ->data->xpath("ActivityDescription")[0], ICS::FORMAT_TEXT );
    $cal->addRow( 'DTSTART', $occ->occurenceDate, ICS::FORMAT_DATE_TIME );
    $cal->end( 'VEVENT' );
    $calendars[] = $cal->toString();
}

// add attachments
global $phpmailer;
add_action( 'phpmailer_init', function( &$phpmailer )use( $occurrences, $calendars ){
    $phpmailer->SMTPDebug = 2;
    $phpmailer->AltBody = strip_tags($phpmailer->Body);
    foreach ( $occurrences as $occ ){
        $file = $occ->data->xpath("photo")[0];
        $uid = 'img_' . $occ->data->xpath("@id")[0];
        $phpmailer->AddEmbeddedImage( getcwd() . $file, $uid );
    }
    
    $phpmailer->AddEmbeddedImage( getcwd() . '/wp-content/plugins/mvcweb/assets/images/mvc-logo.png', 'mvc-logo' );
    
    $i=1;
    foreach ( $calendars as $c ){
        $phpmailer->addStringAttachment( $c, 'calendar' . $i . '.ics' );
        $i++;
    }
});

// setup mail headers
$headers = array(
    'Content-Type: text/html; charset=UTF-8'
);

// send mail
wp_mail( $mailto, 'Favorite activities from MariottVacationClub.com', $mailBody, $headers );
























