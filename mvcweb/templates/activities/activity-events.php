<?php

function getActivitiesOccurences( $activities ){
    $now = new DateTime( 'now' );
    $now->setTime( 0, 0 );
    $events = array();
    $intervalWeek = new DateInterval( 'P7D' );
    $intervalDay = new DateInterval( 'P1D' );
    
    foreach( $activities as $activity_row) {
        $event = new stdClass();
        $event->data = $activity_row;
        $event->startDate = new DateTime( $activity_row->startDate );
        $event->endDate = new DateTime( $activity_row->endDate );
        $event->endDate->setTime( $event->startDate->format('H'), $event->startDate->format('i') );
        $startTimeStr = $event->startDate->format( 'H:i' );
        
        if ( $activity_row->frequency == 'weekly' ){
            $weekOcStr = explode( '|', $activity_row->dayOfWeek );
            $startDayOfWeek = (int) $event->startDate->format( 'w' );
            foreach ( $weekOcStr as $weekOc ){
                $weekOcParams = explode( '/', $weekOc );
                if ( $weekOcParams[0] == '' ) continue; // day not set
                
                $diffWithNext = $weekOcParams[0] - $startDayOfWeek;
                if ( $diffWithNext < 0 ) $diffWithNext += 7;
                $nextDate = clone $event->startDate;
                $nextDate->add( new DateInterval( 'P' . $diffWithNext . 'D' ) );
                
                if ( $weekOcParams[1] == '' ){ // hour not set, use time from event start param
                    $ocTime = $startTimeStr;
                } else {
                    $ocTime = sprintf( '%02d', $weekOcParams[1] ) . ':' . sprintf( '%02d', $weekOcParams[2] );
                    $nextDate->setTime( $weekOcParams[1], $weekOcParams[2] );
                }
                
                if ( $nextDate->format( 'G' ) == '0' ){ // if it's fist hour of day php DateTime::format generate wrong string
                    $fakeNextDate = clone $nextDate;
                    $fakeNextDate->sub( new DateInterval( 'P1D' ) );
                    $repeatAt = 'every ' . $fakeNextDate->format( 'D \a\t 12:i\p\m' );
                } else {
                    $repeatAt = 'every ' . $nextDate->format( 'D \a\t g:ia' );
                }
                
                while ( $nextDate <= $event->endDate ){
                    if ( $nextDate >= $now ){
                        $ocEvent = clone $event;
                        $ocEvent->occurenceDate = clone $nextDate;
                        $ocEvent->repeatAt = $repeatAt;
                        $events[ $nextDate->format( 'YmdHi' ).sprintf( '%04d', count( $events ) ) ] = $ocEvent;
                    }
                    $nextDate->add( $intervalWeek );
                }
            }
            
            
            
        } elseif( $activity_row->frequency == 'daily' ) {
            $nextDate = clone $event->startDate;
            if ( $nextDate->format( 'G' ) == '0' ){ // if it's fist hour of day php DateTime::format generate wrong string
                $fakeNextDate = clone $nextDate;
                $fakeNextDate->sub( new DateInterval( 'P1D' ) );
                $event->repeatAt = 'every day at ' . $fakeNextDate->format( '12:i\p\m' );
            } else {
                $event->repeatAt = 'every day at ' . $nextDate->format( 'g:ia' );
            }
            
            while ( $nextDate <= $event->endDate ){
                if ( $nextDate >= $now ){
                    $ocEvent = clone $event;
                    $ocEvent->occurenceDate = clone $nextDate;
                    $events[ $nextDate->format( 'YmdHi' ).sprintf( '%04d', count( $events ) ) ] = $ocEvent;
                }
                $nextDate->add( $intervalDay );
            }
            
        } else { //onetime events
            if ( $event->startDate >= $now ){
                //$event->repeatAt = $nextDate->format( 'l F jS Y - g:ia' );
                $event->occurenceDate = $event->startDate;
                $events[ $event->occurenceDate->format( 'YmdHi' ).sprintf( '%04d', count( $events ) ) ] = $event;
            }
        }
        
        
        
    }
    ksort( $events, SORT_NUMERIC );
    
    return $events;
}