<?php

class Controller_Base_Template extends \Controller_Hybrid
{
    protected $user = null;
    protected $userSubscriptionStatus;

    public function before()
    {
        parent::before();

         // Check Auth Access
        if (\Auth::check())
        {
            /*
             *  Get the current user id and email address
             * */
            list(, $userId) = Auth::get_user_id();
            $this->user = Model_User::find($userId);
        }

        $this->template->title = "RN | Wall Street Journal";

        $this->template->header = Presenter::forge('header/template')->set('user', $this->user );

        // Load translation
        \Lang::load('application');


        // If ajax or content_only, set a theme with an empty layout
        if (\Input::is_ajax())
        {
            return parent::before();
        }

    }

    public function action_index()
    {

    }

    public function action_404()
    {
        $messages = array('Uh Oh!', 'Huh ?');
        $data['notfound_title'] = $messages[array_rand($messages)];
        $this->dataGlobal['pageTitle'] = __('page-not-found');
        $this->template->content = View::forge('404', $data);
    }
}

