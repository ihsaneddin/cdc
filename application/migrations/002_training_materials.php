<?php

class Migration_Training_Materials extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'training_id' => array('type' => 'INT', 'unsigned' => true),
				'file' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('training_materials');

	}

	public function down()
	{
		$this->dbforge->drop_table('training_materials');
	}
}