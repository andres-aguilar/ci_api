<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_calidad extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idCalidad' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'calidad' => array(
				'type' => 'VARCHAR',
				'constraint' => '45'
			)
		));

        $this->dbforge->add_key('idCalidad', TRUE);
		$this->dbforge->create_table('Calidad');
	}

	public function down()
	{
		$this->dbforge->drop_table('Calidad');
    }
}