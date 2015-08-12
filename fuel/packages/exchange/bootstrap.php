<?php

Autoloader::add_core_namespace('Exchange', true);

Autoloader::add_classes(array(
    'Exchange\\Exchange'                => __DIR__.'/classes/exchange.php',
    'Exchange\\Cron\Market'                => __DIR__.'/classes/cron/market.php',
    'Exchange\\Expiration\Date'                => __DIR__.'/classes/expiration/date.php',
    'Exchange\\Market\Base'                => __DIR__.'/classes/market/base.php',
    'Exchange\\Market\Information'                => __DIR__.'/classes/market/information.php',
    'Exchange\\Market\Option'                => __DIR__.'/classes/market/option.php',
    'Exchange\\Market\Price'                => __DIR__.'/classes/market/price.php',
    'Exchange\\Model\Market\History'                => __DIR__.'/classes/model/market/history.php',
    'Exchange\\Model\Coin'                => __DIR__.'/classes/model/coin.php',
    'Exchange\\Model\Option'                => __DIR__.'/classes/model/option.php',
    'Exchange\\Model\Transaction'                => __DIR__.'/classes/model/transaction.php',
    'Exchange\\Observer\Transaction'                => __DIR__.'/classes/observer/transaction.php',
    'Exchange\\Trade\Trade'                => __DIR__.'/classes/trade/trade.php',
    'Exchange\\Trade\IStrategy'                => __DIR__.'/classes/trade/istrategy.php',
    'Exchange\\Trade\Call'                => __DIR__.'/classes/trade/call.php',
    'Exchange\\Trade\Future'                => __DIR__.'/classes/trade/future.php',
    'Exchange\\Trade\Put'                => __DIR__.'/classes/trade/put.php',
    'Exchange\\Trade\Short'                => __DIR__.'/classes/trade/short.php',
//    'Exchange'                => __DIR__.'/classes/cron/market.php',
//	'Exchange\\Exchange_Addons_Twig'    => __DIR__.'/classes/messages/addons/twig.php',
//	'Exchange\\Exchange_Instance'                => __DIR__.'/classes/messages/instance.php',
));

/* End of file bootstrap.php */
