<?php

namespace Fuel\Migrations;

class Create_coins
{
	public function up()
	{
		\DBUtil::create_table('coins', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 11, 'type' => 'text'),
			'file' => array('constraint' => 255, 'type' => 'varchar'),
			'alt' => array('constraint' => 255, 'type' => 'varchar'),
			'api' => array('constraint' => 255, 'type' => 'varchar'),
			'market' => array('constraint' => 255, 'type' => 'varchar'),
			'active' => array( 'type' => 'boolean'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('coins');
	}
}