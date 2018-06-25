<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_Schema extends CI_Migration {

	public function up()
	{
		// Calidad
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

		// Estatus
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

		// Chinchilla
		$this->dbforge->add_field(array(
			'idChinchilla' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => FALSE
			),
			'idMadre' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
			),
			'idPadre' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
				'null' => TRUE
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
				'constraint' => '200',
				'null' => TRUE             
			)
		));

		/* Adding foreign keys */
		$this->dbforge->add_field('CONSTRAINT `FK_REFERENCE_madre` FOREIGN KEY (`idMadre`) REFERENCES `Chinchilla` (`idChinchilla`)');
		$this->dbforge->add_field('CONSTRAINT `FK_REFERENCE_padre` FOREIGN KEY (`idPadre`) REFERENCES `Chinchilla` (`idChinchilla`)');

		$this->dbforge->add_field('CONSTRAINT `FK_REFERENCE_estatus` FOREIGN KEY (`estatus`) REFERENCES `Estatus` (`idEstatus`) ON DELETE CASCADE ON UPDATE CASCADE');
		$this->dbforge->add_field('CONSTRAINT `FK_REFERENCE_calidad` FOREIGN KEY (`calidad`) REFERENCES `Calidad` (`idCalidad`) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->dbforge->add_key('idChinchilla', TRUE);
		$this->dbforge->create_table('Chinchilla');


	}

	public function down()
	{
		$this->dbforge->drop_table('Chinchilla');
		$this->dbforge->drop_table('Estatus');
		$this->dbforge->drop_table('Calidad');
    }
}