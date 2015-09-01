<?php

class Controller_User_Service extends \Controller_Base_Template
{
    public function action_login()
    {
        $this->present('login');
    }

    public function action_register()
    {
        $this->present('register');
    }

    public function action_recover()
    {
        $this->present('recover');
    }

    public function action_logout()
    {
        if ( ! Request::forge('authentication/user/logout')->execute()->response()->body() )
        throw new \Fuel\Core\FuelException('Logout not yet hooked up.');
    }

    protected function present($ng_view = 'register')
    {
        $this->template->title = ucfirst($ng_view) ;

        // Set Authentication as the section header
        $this->template->header->set('section', $this->template->title);

        // Pass in the ng_view type, register, login, or recover password
        $this->template->content = Presenter::forge('user/page')->set('ng_view', $ng_view);
    }
}