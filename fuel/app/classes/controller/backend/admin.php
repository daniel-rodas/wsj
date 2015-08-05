<?php

class Controller_Backend_Admin extends \Controller_Base_Backend
{

    public function before()
    {
        parent::before();
        // Check if the current user is an administrator
        if ( !  \Auth::member(6))
        {
            \Messages::warnig(__('user.login.permission-denied'));
            \Response::redirect(\Router::get('backend'));
        }
        $this->template->title = "RN | ADMIN";
        // Set global
        $this->template->title = \Config::get('application.seo.backend.title');

    }
    /**
     * Admin only area
     */
    public function action_index()
    {
        $this->template->title = 'RN WSJ | Gangsta';

        // Put navigation view into header
        $this->_header->set('navigation',$this->_navigation);

        // Grab presenter to be used for layout
        $presenter = Presenter::forge('admin/page')->set('header',$this->_header);

        $create_article = \Request::forge('blog/backend/post/add', false)->execute()->response()->body();
        $content = \Request::forge('blog/backend/post', false)->execute()->response()->body();
        $category = \Request::forge('blog/backend/category', false)->execute()->response()->body();
        $users = \Request::forge('user/auth/admincreate', false)->execute()->response()->body();
        $authors = \Request::forge('blog/backend/author', false)->execute()->response()->body();
        $presenter->set('create_article', $create_article);
        $presenter->set('content', $content);
        $presenter->set('users', $users);
        $presenter->set('category', $category);
        $presenter->set('authors', $authors);
        $this->template->content = $presenter;
    }


    public function action_category($add = null , $id = null)
    {
        // is add present
        if($id)
        {
            $view = \Request::forge('blog/backend/category/add/'.$id, false)->execute()->response()->body();
            $this->template->content = $view;
        }

        $view = \Request::forge('blog/backend/category/add', false)->execute()->response()->body();
        $this->template->content = $view;
    }

    public function action_post($add = null , $id = null)
    {
        if($id)
        {
            $view = \Request::forge('blog/backend/post/add/'.$id, false)->execute()->response()->body();
            $this->template->content = $view;
        }
        $view = \Request::forge('blog/backend/post/add', false)->execute()->response()->body();
        $this->template->content = $view;
    }

    public function action_wallet()
    {
        $data['wallets'] = '';

        if($userId = \Input::get('userId'))
        {
            $data['wallets'] = Model_Wallet::find('all', array(
                'where' => array(
                    array('user_id', '=', $userId),
                ),
            ));
            $data['wallet_user'] = $userId;
            $data['available_wallets'] = Model_Wallet::find('all', array(
                'where' => array(
                    array('user_id', 'is', null),
                ),
            ));
        }

        $this->template->title = 'Wallet Manager';

        $data['users'] = Model_User::find('all');
        $this->template->content = View::forge('backend/admin/wallet/index', $data);
    }
}