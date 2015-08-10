<?php

namespace Fuel\Migrations;

class Create_transactions
{
	public function up()
	{
		\DBUtil::create_table('transactions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'option_id' => array('constraint' => 11, 'type' => 'int'),
            'action' => array('constraint' => "'New', 'Sell', 'Sold', 'Execute'", 'type' => 'enum'),
            'purchase' => array('constraint' => "14,2", 'type' => 'float'),
            'market' => array('constraint' => "24,10", 'type' => 'float'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('transactions');
	}
}