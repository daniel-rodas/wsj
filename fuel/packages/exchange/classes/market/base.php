<?php

namespace Exchange\Market;

use Exchange\Trade\Call;
use Exchange\Trade\Future;
use Exchange\Trade\Put;
use Exchange\Trade\Short;
use Exchange\Trade\Trade;

class Base
{
    // <Context> class for strategy pattern

    public function Call()
    {
        return new Trade( new Call() );
    }
    public function Put()
    {
        return new Trade( new Put() );
    }
    public function Short()
    {
        return new Trade( new Short() );
    }
    public function Future()
    {
        return new Trade( new Future() );
    }
}