<?php

namespace Exchange\Trade;

class Short implements IStrategy
{
    public function algorithmTrade($option)
    {
        $option->n = 13;
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

                return $option->theta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return - ( $option->beta );
        endswitch;

    }
}