<?php

namespace Fuel\Migrations;

class Create_market_histories
{
	public function up()
	{
		\DBUtil::create_table('market_histories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'market' => array('constraint' => 255, 'type' => 'varchar'),
			'coin_id' => array('constraint' => 11, 'type' => 'int'),
			'last_price' => array('constraint' => "24,10", 'type' => 'float'),
			'api_url' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('market_histories');
	}
}