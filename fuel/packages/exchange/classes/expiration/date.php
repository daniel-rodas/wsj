<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 1:46 AM
 */

namespace Exchange\Expiration;

class Date
{
    public function get( $timeFrame )
    {
        // Figure out expiration date for option
        switch ( $timeFrame ) {
            case '30m':
                return  time() + ((60 * 60) / 2);

            case '90m':
                return  time() + ((60 * 60) * 1.5);

            case '6h':
                return  time() + (6 * 60 * 60);

            case '1d':
                return  time() + (24 * 60 * 60);
            // TODO turn seven day options after Sept 11, 2016

//            case '7d':
//                return  time() + (7 * 24 * 60 * 60);

            default:
                /*
                * If the user does not pick a set the option to expire at the current time.
                */
                return time();
        }
    }
}