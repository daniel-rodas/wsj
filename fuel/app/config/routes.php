<?php

return array(
	'_root_' => 'frontend/index',  // The default route
	'_404_' => 'base/template/404',    // The main 404 route

//    User Login
    'user/link' => array('authentication/user/ling', 'name' => 'link'),
    'user/login' => array('user/service/login', 'name' => 'login'),
    'user/logout' => array('user/service/logout', 'name' => 'logout'),
    'user/register' => array('user/service/register', 'name' => 'register'),
    'user/password/recover' => array('user/service/recover', 'name' => 'password_recover'),
    'user/password/update' => array('user/password/update', 'name' => 'password_update'),
    'user/password/confirm/(:data)' => array('user/password/confirm/$data', 'name' => 'password_confirm'),

//    OAuth
    'user/auth/oauth/google' => array('user/auth/oauth/google', 'name' => 'oauth_google'),
    'user/auth/oauth/facebook' => array('user/auth/oauth/facebook', 'name' => 'oauth_facebook'),
    'user/auth/oauth/twitter' => array('user/auth/oauth/twitter', 'name' => 'oauth_twitter'),

//    Admin Blog
    'admin' => array('backend/admin/index', 'name' => 'admin'),
    'admin/post/add' => array('backend/admin/post/add', 'name' => 'admin_post_add'),
    'admin/post/add/(:id)' => array('backend/admin/post/add/$1', 'name' => 'admin_post_edit'),
    'admin/category' => array('backend/admin/category', 'name' => 'admin_category'),
    'admin/category/add' => array('backend/admin/category/add', 'name' => 'admin_category_add'),
	'admin/category/add/(:id)' => array('backend/admin/category/add/$1', 'name' => 'admin_category_edit'),


//    Admin Trading App
//    'admin/transactions' => array('transactions/index', 'name' => 'admin_transaction'),
//    'admin/wallets' => array('backend/admin/wallet/index', 'name' => 'admin_wallet'),

//    Authenticated User Section
    'backend' => array('backend/index', 'name' => 'backend'),
    'backend/new' => array('backend/index/index', 'name' => 'backend_new'),
    'backend/option' => array('backend/index/option', 'name' => 'backend_option'),
    'backend/account' => array('backend/account', 'name' => 'backend_account'),
    'backend/account/basic' => array('backend/account/index/basic', 'name' => 'backend_account_basic'),
    'backend/account/save' => array('backend/account/index/save', 'name' => 'backend_account_save'),
    'backend/subscription' => array('backend/account/subscription', 'name' => 'backend_subscription'),
    'backend/deposit' => array('backend/index/deposit', 'name' => 'backend_deposit'),
    'backend/sendcoin' => array('backend/index/sendcoin/create', 'name' => 'backend_sendcoin'),
    'backend/feedback' => array('backend/index/feedback/create', 'name' => 'backend_feedback'),

//    App Logic via REST controller
    'app/new' => array('backend/wallstreet/new', 'name' => 'app_new'),
    'app/buy' => array('backend/wallstreet/buy', 'name' => 'app_buy'),
    'app/app' => array('backend/wallstreet/sell', 'name' => 'app_sell'),
    'app/execute' => array('backend/wallstreet/execute', 'name' => 'app_execute'),

    // Article View
//    '(:segment)' => array('frontend/index/article/$1', 'name' => 'show_post'),
);