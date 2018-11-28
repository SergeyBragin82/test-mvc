<?php

class ICS {
    const FORMAT_NONE = 0;
    const FORMAT_DATE = 1;
    const FORMAT_DATE_TIME = 2;
    const FORMAT_TEXT = 3;
    
    private $rows = array();
    
    public function addRow( $param, $value, $format = self::FORMAT_NONE ){
        if ( $format !== self::FORMAT_NONE ){
            $value = self::formatValue( $value, $format );
        }
        $value = strtoupper( $param ) . ':' . $value;
        $this->rows[] = wordwrap( $value, 75, "\r\n ");
    }
    
    public function begin( $section ){
        $this->addRow( 'BEGIN', strtoupper( $section ) );
    }
    
    public function end( $section ){
        $this->addRow( 'END', strtoupper( $section ) );
    }
    
    public static function formatValue( $value, $format = self::FORMAT_NONE ){
        if ( $format !== self::FORMAT_NONE ){
            switch ( $format) {
                case self::FORMAT_DATE:
                    $d = ( $value instanceof DateTimeInterface ) ? $value : new DateTime( $value );
                    $value = $d->format( 'Ymd' );
                    break;
                    
                case self::FORMAT_DATE_TIME:
                    $dt = ( $value instanceof DateTimeInterface ) ? $value : new DateTime( $value );
                    $value = $dt->format( 'Ymd\THis\Z' );
                    break;
                case self::FORMAT_TEXT:
                    $value = str_replace( array("\r\n", "\n", "\r" ), '\\n', $value );
                    break;
                default:
                    ;
                    break;
            }
        }
        return $value;
    }
    
    public function toString(){
        $pre = array(
            'BEGIN:VCALENDAR',
            'VERSION:2.0',
            'CALSCALE:GREGORIAN',
        );
        $rows = array_merge( $pre, $this->rows );
        $rows[] = 'END:VCALENDAR';
        
        $result = implode( "\r\n", $rows );
        
        
        return $result . "\r\n";
    }
}