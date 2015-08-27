<?php

class Controller_Base_Backend extends \Controller_Base_Template
{
    public function before()
    {
        parent::before();

        // Check Auth Access
        if (!\Auth::check()) {
            \Messages::warning(__('user.login.not-logged'));
            \Response::redirect('user/service/index/login');
        }

        $this->template->title = "RN | Members Area. Wall Street Journal.";
    }
}
