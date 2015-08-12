<?php

namespace Exchange\Trade;

class Future extends Trade
{
    protected function algorithmTrade($action)
    {
        $this->n = 17;
        $this->m = 75;

        switch($action) :
            case 'New':
                /* 1. option of cost - NEW */
                return - (  $this->theta + ( $this->theta / $this->n ) );

            case 'Sell':
                return true;

            case 'Sold':
                return true;

            case 'Execute':

                return $this->beta;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->beta;
        endswitch;
    }
}