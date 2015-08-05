<?php

class Model_Wallet extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'created_at',
		'updated_at',
	);
    protected static $_table_name = 'wallets';
    protected static $_belongs_to = array('users');
    protected static $_has_many = array(
        'addresses' => array(
            'key_from' => 'id',			// key in this model
            'model_to' => 'Model_Address',      // related model
            'key_to' => 'wallet_id',		// key in the related model
            'cascade_save' => true,		// update the related table on save
            'cascade_delete' => true,		// delete the related data when deleting the parent
        )
    );
    // define the EAV container like so
    protected static $_eav = array(
        'addresses' => array(			// we use the statistics relation to store the EAV data
            'model_to' => 'Model_Address',      // related model
            'attribute' => 'coin',		// the key column in the related table contains the attribute
            'value' => 'address',			// the value column in the related table contains the value
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
	public static function validate_assign($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}
    public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('id', 'Wallet Id', 'required|valid_string[numeric]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');

		return $val;
	}

}
