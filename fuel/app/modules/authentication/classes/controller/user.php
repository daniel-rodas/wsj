<?php

namespace Authentication;

class Controller_User extends Controller_Base
{


    public function action_login()
    {
        // already logged in?
        if (\Auth::check())
        {
            // yes, so go back to the page the user came from, or the
            // application dashboard if no previous page can be detected
            \Messages::info(__('user.login.already-logged-in'));
            \Response::redirect_back();
        }

        // was the login form posted?
        if (\Input::method() == 'POST')
        {
            // check for a valid CSRF token
            if ( ! \Security::check_token())
            {
                // CSRF attack or expired CSRF token
                // login failed, show an error message
                \Messages::error(__('user.login.failure'));
                \Response::redirect_back();
            }
            else
            {
                // token is valid, you can process the form input
                //// check the credentials.
                if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
                {
                    $user = \Input::param('username');
                    \Messages::info("Welcome back $user");

                    /*
                     * FIxes loop problem after redirect
                     * ( Input::referrer() === $main_login_forms or Input::referrer() === $main_registration_forms )
                     */
                    $main_login_forms = Uri::base(false) . $this->selfReferrerLogin;
                    $main_registration_forms = Uri::base(false) . $this->selfReferrerRegistration;
                    if ( Input::referrer() === $main_login_forms or Input::referrer() === $main_registration_forms )
                    {
                        \Response::redirect('/');
                    }
                    \Response::redirect_back();
                }
                else
                {
                    // login failed, show an error message
                    \Messages::error(__('user.login.failure'));
                    \Response::redirect_back();
                }
            }

        }

        // display the login page
        return \View::forge('user/login');
    }

    public function action_logout()
    {
        // remove the remember-me cookie, we logged-out on purpose
        \Auth::dont_remember_me();

        // logout
        \Auth::logout();

        // inform the user the logout was successful
        \Messages::info(__('user.login.logged-out'));

        // and go back to where you came from (or the application
        // homepage if no previous page can be determined)
        \Response::redirect('user/service/index/login');
    }

    public function action_admincreate()
    {
        // Check if the current user is an administrator
        if (!\Auth::member(6)) {
            \Messages::info(__('user.login.not-logged'));
            \Response::redirect(\Router::get('login'));
        }

        if (Input::method() == 'POST') {

            try {
                /*
                 * Unique serial based off timestamp and rand()
                 *  for user saved in EAV table by FuelPHP
                 */

                $user = \Auth::create_user(
                    Input::post('email'),
                    Input::post('email'),
                    Input::post('email'),
                    1,
                    array(
                        'author' => true,
                        'first_name' => Input::post('first_name'),
                        'last_name' => Input::post('last_name'),
                    )
                );

                $email = Input::post('email');

                \Messages::success( "Created author $email" );


            } catch (Exception $e) {

                \Messages::error( $error = $e->getMessage() );
            }
            \Response::redirect_back();
        }

        return View::forge('user/admin/create');
    }

    public function action_register()
    {
        if (\Input::method() == 'POST')
        {
            if ( \Input::post('password')  )
            {
                $val = \Validation::forge();
                $val->add_field('email', 'Email address', 'valid_email')
                    ->set_error_message('valid_email', ' Please provide a valid email address.');

                $val->add('password', 'Password')->add_rule('required')
                    ->add_rule('min_length', 8)
                    ->add_rule('max_length', 100)
                    ->set_error_message('min_length', ' Password must contain between 8 to 100 characters')
                    ->set_error_message('max_length', ' Password must contain between 8 to 100 characters');

                if ($val->run())
                {
                    /*
                     * Validation passed
                     */
                    try
                    {
                        /*
                         * Unique serial based off timestamp and rand()
                         *  for user saved in EAV table by FuelPHP
                         */
                        $options = array(
                            'new_user' => true,
                            'subscription' => \Input::post('subscription'),
                            'billing_address',
                            'billing_address',
                            'billing_city',
                            'billing_state',
                            'billing_zip_code',
                            'credit_card_number',
                            'credit_card_csv',
                            'credit_card_zip_code',
                            'credit_card_expiration',

                        );

                        if (\Input::post('subscription') != 'digital')
                        {
                            $options = array(
                                'delivery_address',
                                'delivery_address',
                                'delivery_city',
                                'delivery_state',
                                'delivery_zip_code',
                            );
                        }

//                        $options = array(
//                            'subscription' => Input::post('subscription'),
//                        );

                        $user = \Auth::create_user(
                            Input::post('username'),
                            Input::post('password'),
                            Input::post('username'),
                            1,
                            $options
                        );

                        \Auth::force_login($user);
                        $email = \Input::post('username');
                        \Messages::success( "Created account for $email" );
                        /*
                     * ( Input::referrer() === $main_login_forms or Input::referrer() === $main_registration_forms )
                     * FIxes loop problem after redirect
                     */
//                        $main_login_forms = \Uri::base(false) . $this->selfReferrerLogin;
//                        $main_registration_forms = \Uri::base(false) . $this->selfReferrerRegistration;
//                        if ( \Input::referrer() === $main_login_forms or \Input::referrer() === $main_registration_forms )
//                        {
//                            \Response::redirect('backend/account');
//                        }
                        \Response::redirect_back();
                    }
                    catch (\Exception $e)
                    {
                        \Messages::error( $e->getMessage() );
                        \Response::redirect_back();
                    }
                }
                else
                {
                    $error = array();
                    foreach ($val->error() as $field => $error)
                    {
                        \Messages::error( $error->get_message() );
                        // The field Title is required and must contain a value.
                    }


                    \Response::redirect_back();
                }
            }
            else
            {

                \Messages::error(  'Please specify a password.');
                \Response::redirect_back();
            }
        }

        // display the login page
        return \View::forge('user/register');
    }

}

//public function action_oauth($provider = null)
//{
//    // bail out if we don't have an OAuth provider to call
//    if ($provider === null)
//    {
//        \Messages::error(__('login-no-provider-specified'));
//        \Response::redirect_back();
//    }
//
//    // load Opauth, it will load the provider strategy and redirect to the provider
//    \Auth_Opauth::forge();
//}

//
//protected function link_provider($userid)
//{
//    // do we have an auth strategy to match?
//    if ($authentication = \Session::get('auth-strategy.authentication', array()))
//    {
//        // don't forget to pass false, we need an object instance, not a strategy call
//        $opauth = \Auth_Opauth::forge(false);
//
//        // call Opauth to link the provider login with the local user
//        $insert_id = $opauth->link_provider(array(
//            'parent_id' => $userid,
//            'provider' => $authentication['provider'],
//            'uid' => $authentication['uid'],
//            'access_token' => $authentication['access_token'],
//            'secret' => $authentication['secret'],
//            'refresh_token' => $authentication['refresh_token'],
//            'expires' => $authentication['expires'],
//            'created_at' => time(),
//        ));
//    }
//}

//public function action_callback()
//{
//    // Opauth can throw all kinds of nasty bits, so be prepared
//    try
//    {
//        // get the Opauth object
//        $opauth = \Auth_Opauth::forge(false);
//
//        // and process the callback
//        $status = $opauth->login_or_register();
//
//        // fetch the provider name from the opauth response so we can display a message
//        $provider = $opauth->get('auth.provider', '?');
//
//        // deal with the result of the callback process
//        switch ($status)
//        {
//
//            // a local user was logged-in, the provider has been linked to this user
//            case 'linked':
//                // inform the user the link was succesfully made
//                \Messages::success(sprintf(__('user.login.provider-linked'), ucfirst($provider)));
//                // and set the redirect url for this status
//                $url = '';
//                break;
//
//            // the provider was known and linked, the linked account as logged-in
//            case 'logged_in':
//                // inform the user the login using the provider was succesful
//                \Messages::success(sprintf(__('user.login.logged_in_using_provider'), ucfirst($provider)));
//                // and set the redirect url for this status
//                $url = '';
//                break;
//
//            // we don't know this provider login, ask the user to create a local account first
//            case 'register':
//                // inform the user the login using the provider was succesful, but we need a local account to continue
//                \Messages::info(sprintf(__('user.login.register-first'), ucfirst($provider)));
//                // and set the redirect url for this status
////                    $url = 'user/create';
//                $url = 'user/link';
//                break;
//
//            // we didn't know this provider login, but enough info was returned to auto-register the user
//            case 'registered':
//                // inform the user the login using the provider was succesful, and we created a local account
//                \Messages::success(__('user.login.auto-registered'));
//                // and set the redirect url for this status
//                $url = '';
//                break;
//
//            default:
//                throw new \FuelException('Auth_Opauth::login_or_register() has come up with a result that we dont know how to handle.');
//        }
//
//        // redirect to the url set
//        \Response::redirect($url);
//    }
//
//        // deal with Opauth exceptions
//    catch (\OpauthException $e)
//    {
//        \Messages::error($e->getMessage());
//        \Response::redirect_back();
//    }
//
//        // catch a user cancelling the authentication attempt (some providers allow that)
//    catch (\OpauthCancelException $e)
//    {
//        // you should probably do something a bit more clean here...
//        exit('It looks like you canceled your authorisation.'.\Html::anchor('users/oath/'.$provider, 'Click here').' to try again.');
//    }
//}