<?php

namespace Authentication;

class Controller_Base extends \Controller_Hybrid
{
    public function before()
    {
        parent::before();
    }

    public function action_link()
    {
        // fetch the oauth provider from the session (if present)
        $provider = \Session::get('auth-strategy.authentication.provider', false);

        if ($provider) {
            # code...
            // get the auth-strategy data from the session (created by the callback)
            $user_hash = \Session::get('auth-strategy.user', array());

            // populate the registration form with the data from the provider callback
            $fullname = \Arr::get($user_hash, 'name');
            $email = \Arr::get($user_hash, 'email');

            // Check if Provider user has a local account.
            $userExists = Model_User::find('first', array(
                'where' => array(
                    array('email', $email),
                ),
                'select' => array('id'),
            ));
            if ($userExists) {
                \Auth::force_login($userExists->id);
                $this->link_provider($userExists->id);
                \Response::redirect();
            }

            $serial = time() . '' . rand(55, time());
            $password = $serial . '' . $fullname . '' . time();

            $user = \Auth::create_user(
                $email,
                $password,
                $email,
                1,
                array(
                    'serial' => $serial,
                    'fullname' => $fullname,
                )
            );

            \Auth::force_login($user);
            $this->link_provider($user);
            \Messages::info("5 articles left to read for $email");
            \Response::redirect('/');
        }
    }

    protected function link_provider($userId)
    {
        // do we have an auth strategy to match?
        if ($authentication = \Session::get('auth-strategy.authentication', array())) {
            // don't forget to pass false, we need an object instance, not a strategy call
            $opauth = \Auth_Opauth::forge(false);

            // call Opauth to link the provider login with the local user
            $insert_id = $opauth->link_provider(array(
                'parent_id' => $userId,
                'provider' => $authentication['provider'],
                'uid' => $authentication['uid'],
                'access_token' => $authentication['access_token'],
                'secret' => $authentication['secret'],
                'refresh_token' => $authentication['refresh_token'],
                'expires' => $authentication['expires'],
                'created_at' => time(),
            ));
        }
    }
}