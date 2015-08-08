<?php

namespace Fuel\Migrations;

class Create_balances
{
	public function up()
	{
		\DBUtil::create_table('balances', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'user_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'description' => array('type' => 'text'),
			'debit' => array('constraint' => '24,10', 'type' => 'float'),
			'credit' => array('constraint' => '24,10', 'type' => 'float'),
			'balance' => array('constraint' => '24,10', 'type' => 'float'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('balances');
	}
}