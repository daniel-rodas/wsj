<?php

namespace Exchange;

class Controller_Base extends \Controller_Hybrid
{
    public function before()
    {
        parent::before();

        // Load Exchange package
        \Package::load('Exchange');
    }
//    public function before()
//    {
//        parent::before();
//
//        // Stops direct access to module from browser
//        if( ! \Request::is_hmvc() )
//        {
//            throw new \HttpNotFoundException();
//        }
//    }

    public function action_index()
    {
        throw new \HttpNotFoundException();
    }
}