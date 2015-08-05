<?php

namespace Fuel\Migrations;

class Create_options
{
	public function up()
	{
		\DBUtil::create_table('options', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'serial' => array('constraint' => 255, 'type' => 'varchar'),
			'market' => array('constraint' => "24,10", 'type' => 'float'),
			'strike' => array('constraint' => "24,10", 'type' => 'float'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'coin_id' => array('constraint' => 11, 'type' => 'int'),
			'quantity' => array('constraint' => 11, 'type' => 'int'),
			'price' => array('constraint' => "14,2", 'type' => 'float'),
            'expiration_date' => array('constraint' => 11, 'type' => 'int'),
			'category' => array('constraint' =>"'Future', 'Call', 'Put', 'Short'", 'type' => 'enum'),
			'status' => array('constraint' =>"'New', 'Sell', 'Sold', 'Execute'", 'type' => 'enum'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('options');
	}
}