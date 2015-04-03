<?php

class Migration_Notifications extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'notify_id' => array('type' => 'INT', 'unsigned' => true),
				'notify_type' =>array('type' => 'VARCHAR', 'constraint' => '255'),
				'title' => ['type' => 'VARCHAR', 'constraint' => '255'],
				'slug' => ['type' => 'VARCHAR', 'constraint' => '255'],
				'content' => array( 'type' => 'TEXT'),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('notifications');

	}

	public function down()
	{
		$this->dbforge->drop_table('notifications');
	}
}