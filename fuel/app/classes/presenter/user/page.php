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
        $data = [];
        $data['ng_view'] = $this->ng_view;
        $data['facebook_login'] = View::forge('user/facebook');

        // HMVC call to authentication module
//        $data['register'] = Request::forge('authentication/user/register' )->execute();
//        $data['login'] = Request::forge('authentication/user/login' )->execute();
//        $data['recover'] = Request::forge('authentication/password/recover' )->execute();

        $this->content = View::forge('user/service/index', $data);
    }
}
