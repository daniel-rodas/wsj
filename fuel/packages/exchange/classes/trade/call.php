<?php

namespace Exchange\Market\Trade;

class Call extends Trade
{
    protected function trade($action)
    {
        /*
         * User has to pay for the rest of the call option when they execute
         * But there is not obligation to execute for a call option
         * The option is like a very light down payment and they're only obligated to pay in full if they execute
         */
        $this->_n = 17;
        $this->_m = 75;

        switch($action) :

            case 'New':
                /* 1. option of cost - NEW */
                return - ( $this->_theta / $this->_n );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':
                /* 2. cost if they execute - Execute */
                return $this->_theta + ( $this->_theta / $this->_m );

            case 'Expire':
                /*  3. cost of execute - After Execute*/
                return ( $this->_theta / $this->_n ) +  $this->_beta ;
        endswitch;
    }
}