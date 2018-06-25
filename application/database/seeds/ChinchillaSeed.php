<?php

class ChinchillaSeed extends Seeder
{
    public function run()
    {
        $this->db->query("SET FOREIGN_KEY_CHECKS=0;");
        /** Calidad */
        $this->db->truncate("Calidad");

        $data = array(
            array('idCalidad' =>1, 'calidad' => 'excelente'), 
            array('idCalidad' =>2, 'calidad' => 'buena'), 
            array('idCalidad' =>3, 'calidad' => 'regular'), 
            array('idCalidad' =>4, 'calidad' => 'mala')
        );

        foreach($data as $row) {
            $this->db->insert("Calidad", $row);
        }


        /** Estatus */
        $this->db->truncate("Estatus");

        $data = array(
            array('idEstatus' =>1, 'estatus' => 'productivo'), 
            array('idEstatus' =>2, 'estatus' => 'procesado'), 
            array('idEstatus' =>3, 'estatus' => 'enfermo'), 
            array('idEstatus' =>4, 'estatus' => 'en tratamiento'), 
            array('idEstatus' =>5, 'estatus' => 'piel dañada'),
            array('idEstatus' =>6, 'estatus' => 'bajo peso'), 
            array('idEstatus' =>7, 'estatus' => 'sobre peso'), 
            array('idEstatus' =>8, 'estatus' => 'difunto'), 
            array('idEstatus' =>9, 'estatus' => 'preñada')
        );

        foreach($data as $row) {
            $this->db->insert("Estatus", $row);
        }

        /** Chinchilla */
        $this->db->truncate("Chinchilla");

        $data = array(
            array('idChinchilla' => 'CC1', 'idMadre' =>  NULL, 'idPadre' => NULL,  'colonia' => 'Col1', 'edad' => '5', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C1', 'fecha_alta' => 'NOW()', 'genero'=>'hembra', 'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC2', 'idMadre' => 'CC1', 'idPadre' => 'CC1', 'colonia' => 'Col1', 'edad' => '6', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C2', 'fecha_alta' => 'NOW()', 'genero'=>'macho',  'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC3', 'idMadre' => 'CC1', 'idPadre' => 'CC1', 'colonia' => 'Col1', 'edad' => '7', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C3', 'fecha_alta' => 'NOW()', 'genero'=>'hembra', 'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC4', 'idMadre' => 'CC3', 'idPadre' => 'CC3', 'colonia' => 'Col1', 'edad' => '8', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C4', 'fecha_alta' => 'NOW()', 'genero'=>'macho',  'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC5', 'idMadre' => 'CC3', 'idPadre' => 'CC3', 'colonia' => 'Col1', 'edad' => '8', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C5', 'fecha_alta' => 'NOW()', 'genero'=>'hembra', 'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC6', 'idMadre' => 'CC5', 'idPadre' => 'CC5', 'colonia' => 'Col1', 'edad' => '2', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C6', 'fecha_alta' => 'NOW()', 'genero'=>'hembra', 'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC7', 'idMadre' => 'CC5', 'idPadre' => 'CC5', 'colonia' => 'Col1', 'edad' => '2', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C7', 'fecha_alta' => 'NOW()', 'genero'=>'macho',  'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC8', 'idMadre' => 'CC6', 'idPadre' => 'CC6', 'colonia' => 'Col1', 'edad' => '2', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C8', 'fecha_alta' => 'NOW()', 'genero'=>'hembra', 'fecha_nacimiento' => 'NOW()', 'imagen' => NULL),
            array('idChinchilla' => 'CC9', 'idMadre' => 'CC6', 'idPadre' => 'CC6', 'colonia' => 'Col1', 'edad' => '2', 'calidad' => 2, 'estatus' => 1, 'posicion' => 'N1-F1-C9', 'fecha_alta' => 'NOW()', 'genero'=>'macho',  'fecha_nacimiento' => 'NOW()', 'imagen' => NULL)
        );

        foreach($data as $row) {
            $this->db->insert("Chinchilla", $row);
        }

        $this->db->query("SET FOREIGN_KEY_CHECKS=1;");
        echo "Done!".PHP_EOL;
    }
}
