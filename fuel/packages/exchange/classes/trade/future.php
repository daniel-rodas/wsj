<?php

namespace Exchange\Trade;

class Future extends Trade
{
    protected function algorithmTrade($action)
    {
        $this->_n = 17;
        $this->_m = 75;

        switch($action) :
            case 'New':
                /* 1. option of cost - NEW */
                return - (  $this->_theta + ( $this->_theta / $this->_n ) );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':

                return $this->_beta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->_beta;
        endswitch;
    }
}