<?php

namespace Fuel\Tasks;
use Exchange\Cron\Market as TMarket;

class Market
{
    public static function _init()
    {
        // this is called upon loading the class
        \Package::load('exchange');
    }
    public function ticker()
    {
        TMarket::populateHistory();
    }
}
