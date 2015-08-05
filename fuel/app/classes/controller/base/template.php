<?php

class Controller_Base_Template extends \Controller_Hybrid
{
    public $template = 'main_template';
    public $dataGlobal = array();
    protected $_userId;
    protected $_userSubscriptionStatus;
    protected $_userEmail;
    protected $_navigation;
    protected $_header;

    public function before()
    {
        parent::before();

         // Check Auth Access
        if (\Auth::check())
        {
            /*
                     *  Get the current user id and email address
                     * */
            list(, $this->_userId) = Auth::get_user_id();
            $user = Model_User::find($this->_userId, array('select' => array('email')));
            $this->_userEmail = $user->email;
        }
        $this->template->title = "Wall Street Journal";
        $this->_navigation = View::forge('_templates/top_navbar')->set('user_email', $this->_userEmail);
        $this->_header = View::forge('_templates/header');

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

