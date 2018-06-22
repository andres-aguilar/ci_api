<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_chinchilla extends CI_Migration {

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
			'fecha_alta' => array(
				'type' => 'DATETIME'
			),
			'genero' => array(
				'type' => 'ENUM("macho", "hembra")'
			),
			'fecha_nacimiento' => array(
				'type' => 'DATETIME'
			),
			'imagen' => array(
                'type' => 'VARCHAR',
				'constraint' => '200'                
			)
		));

		/* Adding foreign keys */
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (idMadre) REFERENCES Chinchilla(idChinchilla)');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (idPadre) REFERENCES Chinchilla(idChinchilla)');

		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (estatus) REFERENCES Estatus(idEstatus) ON DELETE CASCADE ON UPDATE CASCADE');
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (calidad) REFERENCES Estatus(idCalidad) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->dbforge->add_key('idChinchilla', TRUE);
		$this->dbforge->create_table('Chinchilla');
	}

	public function down()
	{
		$this->dbforge->drop_table('Chinchilla');
    }
}