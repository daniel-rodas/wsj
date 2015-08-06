<?php

/**
 * The Article Page presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_User_Page extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $data = array();
        $data['facebook_login'] = View::forge('user/facebook');

        // $this->ng_view has a value of either register, login, or recover
        $form = 'form_' . $this->ng_view;

        switch ( $this->ng_view )
        {
            case 'register':
                $uri = 'user/register';
                break;
            case 'login':
                $uri = 'user/login';
                break;
            case 'recover':
                $uri = 'password/recover';
                break;
        }

        // HMVC call to authentication module
        $data[$form] = Request::forge('authentication/' . $uri , false)->execute()->response()->body();
        $this->content = View::forge('user/service/index')->set('content', $data);
    }
}
