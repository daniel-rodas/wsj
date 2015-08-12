<?php

namespace Exchange\Trade;

class Put extends Trade
{
    protected function algorithmTrade($action)
    {
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
                /* 2. cost if they execute - Execute (Put is no obligation)*/
                return $this->beta + ( $this->beta / $this->m  ); /*  cost of execute */ /* cost if they execute */;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->theta ;
        endswitch;
    }
}