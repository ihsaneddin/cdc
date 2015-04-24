<?php

class Migration_Articles extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'user_id' => array('type' => 'INT', 'unsigned' => true),
				'title' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'slug' => ['type' => 'VARCHAR', 'constraint' => '255'],
				'status' => array('type' => 'BOOLEAN', 'default' => false),
				'image' => array('type' => 'VARCHAR', 'default' => null, 'constraint' => '255'),
				'content' => array('type' => 'TEXT'),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('articles');

	}

	public function down()
	{
		$this->dbforge->drop_table('articles');
	}
}