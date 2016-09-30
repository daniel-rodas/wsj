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
            if( is_null($this->user) )
            {
                /*
                 *  Get the current user id and email address
                 * */
                list(, $userId) = Auth::get_user_id();
                $this->user = Request::forge('authentication/user/find/' . $userId )->execute()->response()->body();
            }
        }

        $this->template->title = "RN | Wall Street Journal";

        $this->template->header = Presenter::forge('header/template')
            ->set('user', $this->user )
            ->set('brand', 'WSJ' );
    }

    public function action_index()
    {

    }

    public function action_404()
    {
        $messages = array('Uh Oh!', 'Huh ?');
        $data = [];
        $data['notfound_title'] = $messages[array_rand($messages)];
        $data['h1'] = '404 Times';
        $this->template->title = 'Page Not Found.';
        $this->template->content =  View::forge('404', $data) ;
    }
}

