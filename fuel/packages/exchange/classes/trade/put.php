<?php

namespace Exchange\Market\Trade;

class Put extends Trade
{
    protected function trade($action)
    {
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
                /* 2. cost if they execute - Execute (Put is no obligation)*/
                return $this->_beta + ( $this->_beta / $this->_m  ); /*  cost of execute */ /* cost if they execute */;

            case 'Expire' :
                /*  3. cost of execute - After Execute*/
                return $this->_theta ;
        endswitch;
    }
}