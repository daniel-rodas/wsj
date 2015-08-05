<?php


class Model_Address extends \Orm\Model
{
	protected static $_properties = array(
		'id',
        'wallet_id',
        'address', // EAV Value
		'coin', // EAV Attribute
		'created_at',
		'updated_at',
	);
    protected static $_table_name = 'addresses';
    protected static $_belongs_to = array(
        'wallet' => array(
            'key_from' => 'wallet_id',
            'model_to' => 'Model_Wallet',
            'key_to' => 'id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
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

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('address', 'Address', 'required');
		$val->add_field('coin', 'Coin', 'required');

		return $val;
	}

}
