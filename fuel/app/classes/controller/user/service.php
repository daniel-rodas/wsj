<?php

class Controller_User_Service extends \Controller_Base_Template
{
    public function action_index($ng_view = 'register')
    {

        $this->template->title = $ng_view . " | Wall Street Journal";

        // Set Authentication as the section header
        $this->template->header->set('section', $this->template->title);

        // Pass in the ng_view type, register, login, or recover password
        $this->template->content = Presenter::forge('user/page')->set('ng_view', $ng_view);
    }
}