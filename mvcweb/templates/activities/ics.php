<?php

require_once dirname(__DIR__) . '/classes/ics-class.php';

$resort_code = @$_GET['code'];
$activityOccurenceId = @$_GET['id'];
if ( empty( $resort_code ) || empty( $activityOccurenceId ) ) wp_die( 'Bad request. Please try later.' );
$activityIdData = explode( '_', $activityOccurenceId );
$activityId = $activityIdData[0];

if ( count( $activityIdData ) > 1 ){
    $occurenceDT = DateTime::createFromFormat( 'YmdHi', $activityIdData[1] );
} else {
    $occurenceDT = false;
}


$rawData = get_option( "MVC_OSA_" . strtolower($resort_code) );
if ( !$rawData ) wp_die( 'Bad request. Please try later.' );
$activities = new SimpleXMLElement( $rawData );
$activity = $activities->xpath( "//Row[@id='" . $activityId . "']" )[0];
$startDT = new DateTimeImmutable( $activity->xpath("startDate")[0] );
$frequency = $activity->xpath("frequency")[0];

$events = array();
if ( $frequency == 'weekly' && !$occurenceDT ) {
    $baseTime = $startDT->format('H:i');
    $wDays = explode( '|', $activity->xpath("dayOfWeek")[0] );
    $times = array(); // key - h:m, value - array of week days
    foreach ( $wDays as $wDay ){
        $dayData = explode( '/', $wDay );
        if ( $dayData[0] == '' ) continue; // empty day
        if ( $dayData[1] == '' ) {
            $eTime = $baseTime;
        } else {
            if ( $dayData[2] == '' ) $dayData[2] = 0;
            $eTime = sprintf( '%02d', $dayData[1] ) . ':' . sprintf( '%02d', $dayData[2] );
        }
        if ( !array_key_exists( $eTime, $times ) ) $times[ $eTime ] = array();
        $times[ $eTime ][] = (int) $dayData[0];
    }
    unset( $wDays );
    
    $dayNumToStr = array( "SU", "MO", "TU", "WE", "TH", "FR", "SA" );
    $startDayOfWeek = (int) $startDT->format( 'w' );
    foreach ( $times as $wTime => $wDays ){
        $wDaysStr = array();
        sort( $wDays, SORT_NUMERIC );
        $daysToNext = 99;
        foreach ( $wDays as $eventDayOfWeek ) {
            $wDaysStr[] = $dayNumToStr[ $eventDayOfWeek ]; // prepare string representation of week days
            if ( $startDayOfWeek == $eventDayOfWeek && $wTime < $baseTime ){ // if next event will be in same day of week but time is less than activity start time
                $daysToNext = min( $daysToNext, 7 );
            } else {
                $daysToNext = min( $daysToNext, $eventDayOfWeek < $startDayOfWeek ? 7 + ( $eventDayOfWeek - $startDayOfWeek ) : $eventDayOfWeek - $startDayOfWeek );
            }
        }
        $eventHourMinute = explode( ':', $wTime );
        $eventStartDT = $startDT->add( new DateInterval( 'P' . $daysToNext . 'D' ) )->setTime( $eventHourMinute[0], $eventHourMinute[1] );
        $events[] = array(
            'UID' => $activityId . '_' . $wTime,
            'DTSTART' => $eventStartDT,
            'RRULE' => 'FREQ=DAILY;UNTIL=' . ICS::formatValue( $activity->xpath("endDate")[0], ICS::FORMAT_DATE ) . ';BYDAY=' . implode( ',', $wDaysStr ),
            
        );
    }
} else {
    $events[] = array();
    if ( $occurenceDT ){
        $events[0]['DTSTART'] = $occurenceDT;
        $events[0]['UID'] = $activityOccurenceId;
    }
}


$cal = new ICS();
foreach ( $events as $e ){
    $cal->begin( 'VEVENT' );
        $cal->addRow( 'UID', empty( $e['UID'] ) ? $activityId : $e['UID'] );
        $cal->addRow( 'DTSTAMP', 'now', ICS::FORMAT_DATE_TIME );
        $cal->addRow( 'SUMMARY', $activity->xpath("ActivityTitle")[0] );
        $cal->addRow( 'DESCRIPTION', $activity->xpath("ActivityDescription")[0], ICS::FORMAT_TEXT );
        $cal->addRow( 'DTSTART', empty( $e['DTSTART'] ) ? $activity->xpath("startDate")[0] : $e['DTSTART'], ICS::FORMAT_DATE_TIME );
        if ( !$occurenceDT ){
            if ( $frequency == 'daily' ){
                $cal->addRow( 'RRULE', 'FREQ=DAILY;UNTIL=' . ICS::formatValue( $activity->xpath("endDate")[0], ICS::FORMAT_DATE ) );
            } elseif ( $frequency == 'weekly' ){
                $cal->addRow( 'RRULE', $e['RRULE'] );
            }
        }
    $cal->end( 'VEVENT' );
}
echo $cal->toString();
