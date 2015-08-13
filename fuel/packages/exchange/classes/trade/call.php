<?php

namespace Exchange\Trade;

class Call implements IStrategy
{
    public function algorithmTrade($option)
    {
        /*
         * User has to pay for the rest of the call option when they execute
         * But there is not obligation to execute for a call option
         * The option is like a very light down payment and they're only obligated to pay in full if they execute
         */
        $option->n = 17;
        $option->m = 75;

        switch($option->getStatus()) :

            case 'Initialized':
                /* 1. option of cost - NEW */
                return - ( $option->theta / $option->n );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':
                /* 2. cost if they execute - Execute */
                return $option->theta + ( $option->theta / $option->m );

            case 'Expire':
                /*  3. cost of execute - After Execute*/
                return ( $option->theta / $option->n ) +  $option->beta ;
        endswitch;
    }
}