<?php

namespace Exchange\Trade;

use Exchange\IStrategy;

class Future implements IStrategy
{
    public function algorithmTrade($option)
    {
        $option->n = 17;
        $option->m = 75;

        switch($option->getStatus()) :
            case 'Initialized':
                /* 1. option of cost - NEW */
                return - (  $option->theta + ( $option->theta / $option->n ) );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Executing':

                return $option->beta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $option->beta;
        endswitch;
    }
}