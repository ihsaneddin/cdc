<?php

class Migration_Recommendations extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'training_id' => array('type' => 'INT', 'unsigned' => true),
				'content' => array( 'type' => 'TEXT'),
				'from' => array('type' => 'INT', 'unsigned' => true),
				'to' => array('type' => 'INT', 'unsigned' => true),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('recommendations');

	}

	public function down()
	{
		$this->dbforge->drop_table('recommendations');
	}
}