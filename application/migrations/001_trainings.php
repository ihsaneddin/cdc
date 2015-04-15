<?php

class Migration_Trainings extends CI_Migration {
	public function up()
	{
		$this->dbforge->add_field(
			array(
				'id' => array('type' => 'INT', 'unsigned' => true, 'auto_increment' => true),
				'slug' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'title' => array( 'type' => 'VARCHAR', 'constraint' => '255'),
				'type' => array('type' => 'VARCHAR', 'constraint' => '255'),
				'banner' => array('type' => 'VARCHAR', 'constraint' => '255'),
				'description' => array('type' => 'TEXT'),
				'start_date' => array('type' => 'DATE', 'null' => false),
				'end_date' => array('type' => 'DATE', 'null'=> false),
				'quota' => array('type' => 'INT', 'unsigned' => true),
				'created_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				'updated_at' => ['type' => 'TIMESTAMP', 'default' => '0000-00-00 00:00:00'],
				)
			);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('trainings');

	}

	public function down()
	{
		$this->dbforge->drop_table('trainings');
	}
}