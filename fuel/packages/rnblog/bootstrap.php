<?php

Autoloader::add_core_namespace('Rnblog');

Autoloader::add_classes(array(
	'Rnblog\\Rnblog' => __DIR__ . '/classes/rnblog.php',
	'Rnblog\\RnblogException' => __DIR__ . '/classes/rnblog.php',

	'Rnblog\\Rnblog_Driver' => __DIR__ . '/classes/rnblog/driver.php',
	'Rnblog\\Rnblog_Rodasnet' => __DIR__ . '/classes/rnblog/rodasnet.php',
	'Rnblog\\Rnblog_Wordpress' => __DIR__ . '/classes/rnblog/wordpress.php',
));
