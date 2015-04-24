<?php

class Migration_Training_Photos extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'imageable_id' => array('type' => 'INT', 'unsigned' => true),
				'imageable_type' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'file_name' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('photos');

	}

	public function down()
	{
		$this->dbforge->drop_table('photos');
	}
}