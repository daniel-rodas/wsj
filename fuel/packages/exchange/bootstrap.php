<?php

Autoloader::add_core_namespace('Exchange', true);

Autoloader::add_classes(array(
    'Exchange\\Exchange'                => __DIR__.'/classes/exchange.php',
    'Exchange\\Validation'                => __DIR__.'/classes/validation.php',
    'Exchange\\IStrategy'                => __DIR__.'/classes/istrategy.php',
    'Exchange\\Cron\Market'                => __DIR__.'/classes/cron/market.php',
    'Exchange\\Expiration\Date'                => __DIR__.'/classes/expiration/date.php',
    'Exchange\\Market\Context'                => __DIR__.'/classes/market/context.php',
    'Exchange\\Market\Information'                => __DIR__.'/classes/market/information.php',
    'Exchange\\Market\Coin'                => __DIR__.'/classes/market/coin.php',
    'Exchange\\Market\Option'                => __DIR__.'/classes/market/option.php',
    'Exchange\\Market\Option\Create'                => __DIR__.'/classes/market/option/create.php',
    'Exchange\\Market\Option\Sell'                => __DIR__.'/classes/market/option/sell.php',
    'Exchange\\Market\Option\Buy'                => __DIR__.'/classes/market/option/buy.php',
    'Exchange\\Market\Option\Execute'                => __DIR__.'/classes/market/option/execute.php',
    'Exchange\\Market\Price'                => __DIR__.'/classes/market/price.php',
    'Exchange\\Model\Market\History'                => __DIR__.'/classes/model/market/history.php',
    'Exchange\\Model\Coin'                => __DIR__.'/classes/model/coin.php',
    'Exchange\\Model\Option'                => __DIR__.'/classes/model/option.php',
    'Exchange\\Model\Transaction'                => __DIR__.'/classes/model/transaction.php',
    'Exchange\\Observer\Transaction'                => __DIR__.'/classes/observer/transaction.php',
    'Exchange\\Trade\Call'                => __DIR__.'/classes/trade/call.php',
    'Exchange\\Trade\Future'                => __DIR__.'/classes/trade/future.php',
    'Exchange\\Trade\Put'                => __DIR__.'/classes/trade/put.php',
    'Exchange\\Trade\Short'                => __DIR__.'/classes/trade/short.php',
    'Exchange\\Trade\Trade'                => __DIR__.'/classes/trade/trade.php',
));

/* End of file bootstrap.php */
