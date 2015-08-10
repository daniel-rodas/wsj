<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/8/2015
 * Time: 1:46 AM
 */

namespace Exchange\market\expiration;


class Date
{
    public function get()
    {
        // Figure out expiration date for option
        switch (Input::param('timeframe')) {
            case '30m':
                return $this->_expirationDate = time() + ((60 * 60) / 2);

            case '90m':
                return $this->_expirationDate = time() + ((60 * 60) * 1.5);

            case '6h':
                return $this->_expirationDate = time() + (6 * 60 * 60);

            case '1d':
                return $this->_expirationDate = time() + (24 * 60 * 60);

            case '7d':
                return $this->_expirationDate = time() + (7 * 24 * 60 * 60);

            default:
                /*
                * If the user does not pick a set the option to expire at the current time.
                */
                return $this->_expirationDate = time();
        }
    }
}