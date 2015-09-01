<?php

class Controller_Base_Backend extends \Controller_Base_Template
{
    use Trait_Auth;

    public function before()
    {
        parent::before();
        $this->check();
        $this->template->title = "RN | Members Area. Wall Street Journal.";
    }
}
