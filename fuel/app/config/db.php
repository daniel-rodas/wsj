<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'development' => array(

    'type'           => 'pdo',

    'connection'     => array(

        'dsn'            => 'mysql:host=localhost;dbname=wsj_db',

        'username'       => 'wsj_db',

        'password'       => 'wsj_db+++###eggeggqgq3vt 11t 1qrcq qefcaa',

        'persistent'     => false,

        'compress'       => false,

    ),

    'identifier'   => '"',

    'table_prefix'   => '',

    'charset'        => 'utf8',

    'enable_cache'   => false,

    'profiling'      => false,

),

);
