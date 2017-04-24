<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'mysql:host=localhost;dbname=wsj_db',

                        'username'   => 'wsj_db_dev',

                        'password'   => '8@skIl3#ka~sFj32',
		),
        'profiling' => 'true',
	),
);
