<?php

namespace Exchange\Model;

class Option extends \Orm\Model_Soft
{
    public static function _init()
    {
        // this is called upon loading the class
        \Module::load('authentication');
        \Module::load('wallet');
        \Package::load('exchange');
    }

    protected static $_properties = array(
		'id',
		'serial',
		'strike',
		'coin_id',
		'quantity',
		'price',
		'category',
		'user_id',
		'status',
        'expiration_date',
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
        '\Exchange\Observer\Transaction',
        '\Wallet\Observer_Balance',
	);

    protected static $_belongs_to = [
        'coins' => [
            'model_to' => '\Exchange\Model\Coin',
        ],
        'users' => [
            'model_to' => '\Authentication\Model_User',
        ]
    ];

    protected static $_has_many = [
        'transactions' => [
            'model_to' => '\Exchange\Model\Transaction',
        ],
    ];


    public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('strike', 'Strike', 'required'); // NEED API TO MAKE REQUIRED
		$val->add_field('quantity', 'Quantity', 'required|valid_string[numeric]');
		$val->add_field('price', 'Price', 'required');
        $val->add_field('expiration_date', 'Expiration Date', 'required|valid_string[numeric]');
        $val->add_field('coin_id', 'Coin', 'required|valid_string[numeric]');
		$val->add_field('category', 'Category', 'required|max_length[255]');

		return $val;
	}

    public static function validate_new($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('strike', 'Strike', 'required');
        $val->add_field('serial', 'Serial', 'required');
        $val->add_field('quantity', 'Quantity', 'required|valid_string[numeric]');
        $val->add_field('price', 'Price', 'required|valid_string[numeric]');
        $val->add_field('coin_id', 'Coin', 'required|valid_string[numeric]');
        $val->add_field('category', 'Category', 'required');

        return $val;
    }

    public static function validate_sell($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('price', 'Price', 'required');
        $val->add_field('status', 'Status', 'required');

        return $val;
    }

    public static function validate_buy($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('status', 'Status', 'required');

        return $val;
    }

    public static function validate_execute($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('status', 'Status', 'required');

        return $val;
    }
}
