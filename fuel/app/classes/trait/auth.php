<?php
/**
 * Created by PhpStorm.
 * User: Rodas
 * Date: 8/31/2015
 * Time: 6:05 PM
 */

trait Trait_Auth
{
    public function check ()
    {
        // Check Auth Access
        if ( ! \Auth::check() ) {
            \Messages::warning('You should not be here unless logged in.');
            \Response::redirect(Router::get('login'));
        }
    }
}