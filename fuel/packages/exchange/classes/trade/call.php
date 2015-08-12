<?php

namespace Exchange\Trade;

class Call extends Trade
{
    protected function algorithmTrade($action)
    {
        /*
         * User has to pay for the rest of the call option when they execute
         * But there is not obligation to execute for a call option
         * The option is like a very light down payment and they're only obligated to pay in full if they execute
         */
        $this->n = 17;
        $this->m = 75;

        switch($action) :

            case 'New':
                /* 1. option of cost - NEW */
                return - ( $this->theta / $this->n );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':
                /* 2. cost if they execute - Execute */
                return $this->theta + ( $this->theta / $this->m );

            case 'Expire':
                /*  3. cost of execute - After Execute*/
                return ( $this->theta / $this->n ) +  $this->beta ;
        endswitch;
    }
}