<?php

class Controller_Base_Backend extends \Controller_Base_Template
{
//    use Trait_Auth;

    public function before()
    {
        parent::before();
//        $this->check();

        // Check Auth Access
        if ( ! \Auth::check() ) {

            echo 'FAiled Check';
            var_dump($this->user);

            \Messages::warning('You should not be here unless logged in.');
//            \Response::redirect(Router::get('login'));
        }
        $this->template->title = "RN | Members Area. Wall Street Journal.";
    }

    public function check ()
    {
        // Check Auth Access
        if ( ! \Auth::check() ) {
            \Messages::warning('You should not be here unless logged in.');
            \Response::redirect(Router::get('login'));
        }
    }
}
