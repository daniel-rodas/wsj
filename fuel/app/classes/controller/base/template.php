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
        $data['title'] = '<h1>404 Times</h1>';
        $this->template->title = __('page-not-found');
        $this->template->content = Presenter::forge('frontpage/page')->set('content', View::forge('404', $data) );
    }
}

