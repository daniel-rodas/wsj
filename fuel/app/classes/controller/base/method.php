<?php

class Controller_Base_Method extends \Controller_Base_Template
{
    use Trait_Auth;
    public function before()
    {
        parent::before();
        // Check Auth Access
        $this->check();
        // Set Navigation

        $this->template->title = "RN | Wall Street Journal";
    }
}
