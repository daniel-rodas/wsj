<?php

namespace Account;

class Balance
{
    /*
     * Get Balance of Total, Daily, Period, Customer.
     */


    /*
     * @var $instance to add support for static methods
     */
    private static $_instance = null;

    private static function instance()
    {
        /*
         * Singleton to call internal method
         */
        if(is_null( self::$_instance) )
        {
            self::$_instance = new self();
            return self::$_instance;
        }
    }

    public static function getBalance( $balance )
    {
        return '\Model_Balance::' .  strtoupper($balance)  . '_Balance()';
    }


    public static function allBalances()
    {
        $balances = array();
        $balances['total']  = \Model_Balance::totalBalance();
        $balances['daily'] =  \Model_Balance::dailyBalance();
        $balances['period'] =  \Model_Balance::periodTimeBalance();
        $balances['customer'] = $Balance = \Model_Balance::customerBalance();

        return $balances;
    }








}