<?php

namespace Authentication;

class Controller_Password extends Controller_Base
{
    public function action_update()
    {
        // If not logged in redirect to home
        if (!\Auth::check())
        {
            \Messages::info(__('user.login.not-logged'));
            \Response::redirect_back();
        }
            // was the login form posted?
        if (\Input::method() == 'POST')
        {
            // check the credentials.
            if (\Auth::instance()->validate_user( \Auth::get_email(), \Input::param('password') ))
            {
                if ( \Input::param('new_password') === \Input::param('confirm_password') )
                {
                    \Auth::change_password(\Input::param('password'),\Input::param('new_password'));
                    // inform the user the password trade was successful

                    \Messages::success( __('user.login.changed'));
                    \Response::redirect_back();
                }

                \Messages::warning(__('user.login.mismatch-password'));
            }
            else
            {
                // login failed, show an error message

                \Messages::error( __('user.login.bad-password'));
            }
            \Response::redirect_back('/backend/account/index/password');
        }
        // display the password reset page
        return \Response::forge(  \View::forge('password/update') );
    }


    public function action_recover($hash = null)
    {
        /*
         * https://myturbotax.intuit.com/account-recovery?offering_id=Intuit.cg.myturbotax&username=daniel.rodas1&locale=en-Us&offering_env=prd&confirmation_id=910855&namespace_id=50000003
         */
        //email use a link

    // was the lostpassword form posted?
        if (\Input::method() == 'POST')
        {
        // do we have a posted email address?
            if ($email = \Input::post('email'))
            {
            // do we know this user?
                if ($user = \Model\Auth_User::find_by_email($email))
                {
                // generate a recovery hash
                    $hash = \Auth::instance()->hash_password(\Str::random()).$user->id;

                // and store it in the user profile
                    \Auth::update_user(
                        array(
                            'lostpassword_hash' => $hash,
                            'lostpassword_created' => time(),
                            ),
                        $user->username
                        );

                    \Package::load('email');
                    $email = \Email::forge();
                    $data = array();
                    $hash = \Crypt::encode($hash, 'R@nd0mK~Y');
                    $data['url'] = \Uri::create('authentication/password/recover/' . $hash );
                    $data['user'] = $user;

                // use a view file to generate the email message
                    $email->html_body(
                        \View::forge('password/email', $data)
                        );

                // give it a subject
                    $email->subject('RN | WJS Password Recovery');
//                    $email->subject(__('user.login.password-recovery'));

                // add from- and to address

//                    $from = \Config::get('application.email-addresses.from.website');

//                    $from = array('email' => 'daniel.rodas1@yahoo.com', 'name' => 'RN | Wall Street Journal');
//                    $email->from($from['email']);
                    $email->from('daniel.rodas1@yahoo.com');
                    $email->to($user->email);

                // and off it goes (if all goes well)!
                    try
                    {
                    // send the email
//                        $email->send();

                        \Messages::success('Please check your email for instructions to reset your password');
//                        \Messages::success(__('user.login.recovery-email-send'));
                        \Response::redirect('authentication/password/confirm/' . $user->id );
                    }

                // this should never happen, a users email was validated, right?
                    catch(\EmailValidationFailedException $e)
                    {
                        \Messages::error('INVALID EMAIL !');
                        \Messages::error($e->getMessage());
//                        \Messages::error(__('user.login.invalid-email-address'));
                        \Response::redirect_back();
                    }

                // what went wrong now?
                    catch(\Exception $e)
                    {
                    // log the error so an administrator can have a look
                        logger(\Fuel::L_ERROR, '*** Error sending email ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());

//                        \Messages::error($e->getMessage());
                        \Messages::error('ERROR SENDING EMAIL !');
//                        \Messages::error(__('user.login.error-sending-email'));

                    }
                }
            }

        // posted form, but email address posted?
            else
            {
            // inform the user and fall through to the form
                \Messages::error(__('user.login.error-missing-email'));
            }

        // inform the user an email is on the way (or not ;-))
            \Messages::info(__('user.login.recovery-email-send'));
            echo 'Controller\Password\recover()<br />';
            echo 'User Info not on the way. redirecting user back';
            die();
//            \Response::redirect_back();
        }

        // no form posted, do we have a hash passed in the URL?

        elseif ($hash !== null)
        {
            $hash = \Crypt::decode($hash, 'R@nd0mK~Y');

            // get the userid from the hash
            $user = substr($hash, 44);

        // and find the user with this id
            if ($user = \Model\Auth_User::find_by_id($user))
            {
            // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
                if (isset($user->lostpassword_hash) and $user->lostpassword_hash == $hash and time() - $user->lostpassword_created < 86400)
                {
                // invalidate the hash
                    \Auth::update_user(
                        array(
                            'lostpassword_hash' => null,
                            'lostpassword_created' => null
                            ),
                        $user->username
                        );

                // log the user in and go to the profile to trade the password
                    if (\Auth::instance()->force_login($user->id))
                    {
                        \Messages::info('LOGGED IN');
                        $tempPass = \Auth::instance()->reset_password($user->username);


                        if ( $tempPass )
                        {

                        \Messages::info(__('user.login.password-recovery-accepted'));
                            \Messages::info("Your temporary password is : $tempPass ");
                            echo "Congratulations here is your temp pass: $tempPass .";
                            echo 'Authentication\Controller\Password\recover()';
                            die();
//                            \Response::redirect('backend/account/index/password');
                        }
                        else
                        {
                            echo 'Something went wrong resetting password';
                            // something wrong with the hash
                            \Messages::error(__('user.login.recovery-hash-invalid'));
                            echo 'Authentication\Controller\Password\recover()';
                            die();
//                            \Response::redirect_back();
                        }
                    }
                }
            }
            echo  'Not sure what went wrong resetting password';
            echo 'Authentication\Controller\Password\recover()';
            die();
        // something wrong with the hash
            \Messages::error(__('user.login.recovery-hash-invalid'));
            \Response::redirect_back();
        }

    // no form posted, and no hash present. no clue what we do here
        else
        {
            \Config::set('security.csrf_expiration', 3600); // set the expiration to one hour
           // display the login page
        return \Response::forge( \View::forge('password/recover') );

        }
    }

    public function action_confirm($id)
    {
        $data = array();
        $user = Model_User::query()->where('id', $id)->get_one();
        $data['user'] = $user;
        $this->template = \View::forge('template');
        $this->template->title = 'Balls';
        $this->template->content = \View::forge('password/confirm', $data);
    }

    public function action_mock_email($id)
    {
        $data = array();
        $user = Model_User::query()->where('id', $id)->get_one();
        $data['user'] = $user;
        $this->template = \View::forge('template_email');
        $this->template->title = 'Balls';
        if (  isset($user->lostpassword_hash) )
        {
            // TODO move hash key to configuration file.
            $hash = \Crypt::encode($user->lostpassword_hash, 'R@nd0mK~Y');
            $data['url'] = \Uri::create('authentication/password/recover/' . $hash );
            $this->template->content = \View::forge('password/email', $data);
        }
        else
        {
            $this->template->content = \View::forge('password/expired');
        }
    }

    public function action_mock_phone($id)
    {
        $data = array();
        $user = Model_User::query()->where('id', $id)->get_one();
        $data['user'] = $user;
        $this->template = \View::forge('template_phone');
        $this->template->title = 'Balls';
        if (  isset($user->lostpassword_hash) )
        {
            $hash = \Crypt::encode($user->lostpassword_hash, 'R@nd0mK~Y');
            $data['url'] = \Uri::create('authentication/password/recover/' . $hash );
            $this->template->content = \View::forge('password/phone', $data);
        }
        else
        {
            $this->template->content = \View::forge('password/expired');
        }
    }
}
