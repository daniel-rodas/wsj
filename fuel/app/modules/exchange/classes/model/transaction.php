<?php

namespace Exchange;

class Model_Transaction extends \Orm\Model_Soft
{
    public static function _init()
    {
        // this is called upon loading the class
        \Module::load('authentication');
    }

    protected static $_properties = array(
		'id',
		'user_id',
		'option_id',
		'action',
		'purchase',
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

    protected static $_soft_delete = array(
        'mysql_timestamp' => false,
    );

    protected static $_belongs_to = [
        'option',
        'user' => [
            'model_to' => '\Authentication\Model_User',
        ]
    ];

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('option_id', 'Option Id', 'required|valid_string[numeric]');
		$val->add_field('action', 'Action', 'required');
		$val->add_field('purchase', 'Purchase', 'required');
		return $val;
	}

    public static function validate_sell($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
        $val->add_field('option_id', 'Option Id', 'required|valid_string[numeric]');
        $val->add_field('action', 'Action', 'required');
        $val->add_field('purchase', 'Purchase', 'required');

       return $val;
    }

}
