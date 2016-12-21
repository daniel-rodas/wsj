<?php


class Controller_Angular_Laboratory extends \Controller_Template
{
    public function before()
    {
        parent::before();

        $this->template = \View::forge('angular/blank');
    }

    public function action_hello()
    {
        $this->template->content = View::forge('angular/application');
    }

    public function action_navigation()
    {
        $this->template->content = View::forge('angular/navigation');
    }

    public function action_whats_news()
    {
        $this->template->content = View::forge('angular/whats-news');
    }

    public function action_application()
    {
        $this->template->content = View::forge('angular/application');
    }

    public function action_navigation_modal()
    {
        $this->template->content = View::forge('angular/navigation-modal');
    }

    public function action_navigation_user_setting_option_dropdown()
    {
        $this->template->content = View::forge('angular/navigation-user-setting-option-dropdown');
    }
}
