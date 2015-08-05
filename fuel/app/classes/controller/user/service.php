<?php

class Controller_User_Service extends Controller_Template
{
    protected $_userId;
    protected $_userSubscriptionStatus;
    protected $_userEmail;
    protected $_navigation;
    protected $_header;
    protected $selfReferrerLogin = 'user/service/index/login';
    protected $selfReferrerRegistration = 'user/service/index/register';

    public function before()
    {
        parent::before();

        // Load translation
        \Lang::load('application');
        if ( Request::is_hmvc() )
        {
            $this->template = View::forge('user/hmvc/template');
        }
        elseif ( ! Input::is_ajax() )
        {
            $this->template = View::forge('main_template');
            $this->template->title = 'WSJ User Authentication';
            $this->_navigation = View::forge('_templates/top_navbar');
            $this->_header = View::forge('_templates/header');
            // Put navigation view into header
            $this->_header->set('navigation',$this->_navigation);
        }
    }

    public function action_index($ng_view = 'register')
    {
        $data = array();
        $data['facebook_login'] = View::forge('user/facebook');
        $data['form_create'] = Request::forge('user/auth/create', false)->execute()->response()->body();
        $data['form_login'] = Request::forge('user/auth/login', false)->execute()->response()->body();
        $data['form_recover'] = Request::forge('user/password/recover', false)->execute()->response()->body();

        $authentication_forms = View::forge('user/service/index')->set('content', $data)->set('ng_view', $ng_view);

        $this->template->content = View::forge('user/page')->set('header', $this->_header)->set('content', $authentication_forms);
    }
}