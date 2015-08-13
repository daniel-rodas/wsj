<?php

namespace Exchange\Trade;

class Put implements IStrategy
{
    public function algorithmTrade($option)
    {
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
                /* 2. cost if they execute - Execute (Put is no obligation)*/
                return $option->beta + ( $option->beta / $option->m  ); /*  cost of execute */ /* cost if they execute */;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $option->theta ;
        endswitch;
    }
}