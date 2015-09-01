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
            echo 'Controller\User\login()<br />';
            echo 'Already Logged in. redirecting user back';
            die();
//            \Response::redirect_back();
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
                echo 'Controller\User\login()<br />';
                echo 'Failed Security Check. redirecting user back';
                die();
//                \Response::redirect_back();
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
//                    $main_login_forms = Uri::base(false) . $this->selfReferrerLogin;
//                    $main_registration_forms = Uri::base(false) . $this->selfReferrerRegistration;
//                    if ( \Input::referrer() === $main_login_forms or Input::referrer() === $main_registration_forms )
//                    {
//                        \Response::redirect('/');
//                    }
                    echo 'Controller\User\login()<br />';
                    echo 'Login Success. redirecting user back';
//                    \Response::redirect_back();
                }
                else
                {
                    \Auth::force_login(3);
                    // login failed, show an error message
                    \Messages::error(__('user.login.failure'));
                    echo 'Controller\User\login()<br />';
                    echo 'Forced login after  Login Failure. redirecting user back';
                    \Response::redirect_back();
                }
            }

        }

        // display the login page
        return \Response::forge( \View::forge('user/login') );
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
        \Response::redirect( Router::get('login') );
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

        return \Response::forge( View::forge('user/admin/create'));
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
                        echo 'Controller\User\register()<br />';
                        echo 'Already Logged in. redirecting user back';
                        die();
//            \Response::redirect_back();
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

                    echo 'Controller\User\register()<br />';
                    echo 'Already Logged in. redirecting user back';
                    die();
//            \Response::redirect_back();
                }
            }
            else
            {

                \Messages::error(  'Please specify a password.');
                echo 'Controller\User\register()<br />';
                echo 'Please Specify a password. redirecting user back';
                die();
//            \Response::redirect_back();
            }
        }

        // display the login page
        return \Response::forge(\View::forge('user/register'));
    }

    public function action_find($id)
    {
        return Model_User::query()->where('id', $id)->get_one();
    }
}