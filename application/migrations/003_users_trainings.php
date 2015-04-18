<?php

class Migration_Users_Trainings extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'user_id' => array( 'type' => 'INT', 'unsigned' =>
				true),
				'training_id' => array('type' => 'INT', 'unsigned' => true),
				'state' => array('type' => 'VARCHAR', 'constraint' => '255', 'default' => 'up coming'),
				'participate' => array('type' => 'BOOLEAN', 'NULL' => true ),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('users_trainings');

	}

	public function down()
	{
		$this->dbforge->drop_table('users_trainings');
	}
}