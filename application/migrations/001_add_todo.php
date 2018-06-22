<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_todo extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'idChinchilla' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => FALSE
			),
			'idMadre' => array(
				'type' => 'VARCHAR',
				'constraint' => '50'
			),
			'idPadre' => array(
				'type' => 'VARCHAR',
				'constraint' => '50'
            ),
            'colonia' => array(
                'type' => 'VARCHAR',
				'constraint' => '45'                
			),
			'edad' => array(
				'type' => 'int',
				'constraint' => '11'
			),
			'calidad' => array(
				'type' => 'int',
				'constraint' => '11'
			),
			'estatus' => array(
				'type' => 'int',
				'constraint' => '11'
			),
			'posicion' => array(
                'type' => 'VARCHAR',
				'constraint' => '45'                
			),
		));

        $this->dbforge->add_key('idChinchilla_id', TRUE);
		$this->dbforge->create_table('Chinchilla');
	}

	public function down()
	{
		$this->dbforge->drop_table('todo');
    }
}