<?php

namespace Exchange;

class Model_Coin extends \Orm\Model_Soft
{
    protected static $_properties = array(
		'id',
		'name',
		'file',
		'alt',
		'api',
        'market',
        'deleted_at',
		'created_at',
		'updated_at',
		'deleted_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

    protected static $_has_many = array(
        'options' ,
        );

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('name', 'Name', 'required');
		$val->add_field('alt', 'Alt Text', 'required');
		$val->add_field('file', 'File', 'required');
		$val->add_field('api', 'API', 'required');
		$val->add_field('market', 'Market Label', 'required');
		return $val;
	}

}