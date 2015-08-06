<?php

namespace Authentication;
class Controller_Base extends \Controller_Hybrid
{
    public function before()
    {
        parent::before();

        // Load translation
        \Lang::load('app');
    }
}