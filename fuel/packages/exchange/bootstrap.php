<?php

Autoloader::add_core_namespace('Exchange');

Autoloader::add_classes(array(
    'Exchange'                => __DIR__.'/classes/market/base.php',
    'Exchange'                => __DIR__.'/classes/cron/market.php',
    'Exchange'                => __DIR__.'/classes/model/market/history.php',
    'Exchange'                => __DIR__.'/classes/model/coin.php',
    'Exchange'                => __DIR__.'/classes/model/option.php',
    'Exchange'                => __DIR__.'/classes/model/transaction.php',
    'Exchange'                => __DIR__.'/classes/observer/transaction.php',
//    'Exchange'                => __DIR__.'/classes/cron/market.php',
//	'Exchange\\Exchange_Addons_Twig'    => __DIR__.'/classes/messages/addons/twig.php',
//	'Exchange\\Exchange_Instance'                => __DIR__.'/classes/messages/instance.php',
));

/* End of file bootstrap.php */
