<?php

class Controller_Base_Backend extends \Controller_Base_Template
{
    protected $_user;


    public function before()
    {
        parent::before();

        // Get action, module and controller name
        $this->actionName = \Request::active()->action;
        $this->moduleName = \Request::active()->module;

        $this->controllerName = strtolower(str_replace('Controller_', '', \Request::active()->controller));
        $this->controllerName = str_replace($this->moduleName . '\\', '', $this->controllerName);

        // Check Auth Access
        if (!\Auth::check()) {
            \Messages::warning(__('user.login.not-logged'));
            \Response::redirect('user/service/index/login');

        }

        $this->_user = Model_User::find($this->_userId);
        // Set Navigation

        $this->template->title = "RN | Wall Street Journal";

        // Set global
        $this->dataGlobal['title'] = \Config::get('application.seo.backend.title');
    }
}
