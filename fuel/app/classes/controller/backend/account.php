<?php

class Controller_Backend_Account extends \Controller_Base_Backend
{
    /*
     * This controller takes care of rendering the views for logged in users;
     * It call data for New, Options, and Account tabs.
     * The requests for the application is handled by the Controller_Backend_App REST controller.
     */

    public function action_index($view = 'basic')
    {
        // Put navigation view into header
        $this->_header->set('navigation',$this->_navigation);

        // Grab presenter to be used for layout
        $presenter = Presenter::forge('account/page')->set('header',$this->_header);

        // Get view and place in presenter
        $data['user'] = $this->_user;
        $view = View::forge('account/' . $view . '/index', $data);
        $presenter->set('content', $view);

        $this->template->content = $presenter;
    }

    public function action_basic($id = null)
    {
        is_null($id) and Response::redirect('');

        if ( ! $user = Model_User::find($id))
        {
            \Messages::error('Could not find user #'.$id);

            Response::redirect('');
        }

        $val = \Model_User::validate_basic('edit');

        if ($val->run())
        {
            $user->firstname = Input::post('firstname');
            $user->lastname = Input::post('lastname');
            $user->email = Input::post('email');

            if ($user->save())
            {
                \Messages::success('Updated user #' . $id);

            }
            else
            {
                \Messages::error('Could not update user #' . $id);
            }

            \Response::redirect('backend/account/index/basic');
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $user->firstname = $val->validated('firstname');
                $user->lastname = $val->validated('lastname');
                $user->email = $val->validated('email');


                \Messages::error($val->error());
            }


            $data['user'] = $this->_user;
            $this->template->content = View::forge('account/basic/edit', $data);
        }
        $this->template->title = "Basic Information";
        $data['user'] = $this->_user;
        $this->template->content = View::forge('account/basic/edit', $data);

    }

    public function action_subscription($id = null)
    {
        is_null($id) and Response::redirect('');

        if ( ! $user = Model_User::find($id))
        {
            Messages::error('Could not find user #'.$id);
            Response::redirect('');
        }

        $val = \Model_User::validate_subscription('edit');

        if ($val->run())
        {
            $user->delivery_address = Input::post('delivery_address');
            $user->delivery_address_2 = Input::post('delivery_address_2');
            $user->delivery_city = Input::post('delivery_city');
            $user->delivery_state = Input::post('delivery_state');
            $user->delivery_zip_code = Input::post('delivery_zip_code');

            if ($user->save())
            {
                Messages::success('Updated user #' . $id);

            }

            else
            {
                Messages::error('Could not update user #' . $id);
            }
            \Response::redirect('backend/account/index/subscription');
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $user->delivery_address = $val->validated('delivery_address');
                $user->delivery_address_2 = $val->validated('delivery_address_2');
                $user->delivery_city = $val->validated('delivery_city');
                $user->delivery_state = $val->validated('delivery_state');

                Session::set_flash('error', $val->error());
            }


            $data['user'] = $this->_user;
            $this->template->content = View::forge('account/subscription/edit', $data);
        }
        $this->template->title = "Delivery Settings";
        $data['user'] = $this->_user;
        $this->template->content = View::forge('account/subscription/edit', $data);

    }

    public function action_social_disconnect($provider)
    {
        // we have a UID and logged in? Just attach this authentication to a user
        if (\Auth::check())
        {
            list(, $user_id) = \Auth::instance()->get_user_id();
            $entry = Model_Users_Providers::query()
                ->where('parent_id', $user_id)
                ->and_where_open()
                    ->where('provider', $provider)
                ->and_where_close()
                ->get_one();

            if ($entry)
            {
                $entry->delete();
                // attachment went ok so we'll redirect
                Messages::success( 'Social Media Account Unlinked');
                Response::redirect_back();
            }
            else
            {
                Messages::warning('Social Mediea Account not found');
                Response::redirect_back();
            }
        }
        return false;
    }

}