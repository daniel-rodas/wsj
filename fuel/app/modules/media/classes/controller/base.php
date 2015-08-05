<?php

namespace Media;
class Controller_Base extends \Controller_Hybrid
{
    public function before()
    {
        parent::before();

        // Load translation
        \Lang::load('blog');
    }
}