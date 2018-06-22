<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_estatus extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idEstatus' => array(
				'type' => 'INT',
				'constraint' => '11',
				'null' => FALSE
			),
			'estatus' => array(
				'type' => 'VARCHAR',
				'constraint' => '45'
			)
		));

        $this->dbforge->add_key('idEstatus', TRUE);
		$this->dbforge->create_table('Estatus');
	}

	public function down()
	{
		$this->dbforge->drop_table('Estatus');
    }
}