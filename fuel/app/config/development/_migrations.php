<?php
return array(
  'version' => 
  array(
    'app' => 
    array(
      'default' => 
      array(
        0 => '003_create_options',
        1 => '004_create_coins',
        2 => '005_create_transactions',
        3 => '006_create_users',
        4 => '007_create_market_histories',
        5 => '007_create_transactions',
        6 => '008_create_balances',
        7 => '009_create_addresses',
        8 => '010_create_wallets',
        9 => '011_create_sendcoins',
        10 => '012_create_feedbacks',
      ),
    ),
    'module' => 
    array(
    ),
    'package' => 
    array(
      'auth' => 
      array(
        0 => '001_auth_create_usertables',
        1 => '002_auth_create_grouptables',
        2 => '003_auth_create_roletables',
        3 => '004_auth_create_permissiontables',
        4 => '005_auth_create_authdefaults',
        5 => '006_auth_add_authactions',
        6 => '007_auth_add_permissionsfilter',
        7 => '008_auth_create_providers',
        8 => '009_auth_create_oauth2tables',
        9 => '010_auth_fix_jointables',
      ),
    ),
  ),
  'folder' => 'migrations/',
  'table' => 'migration',
);
