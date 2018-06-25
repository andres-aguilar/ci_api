<?php
class Chinchilla_model extends CI_Model {
    private $get_all_chinchillas = "SELECT idChinchilla, idMadre, colonia, edad, Calidad.calidad, Estatus.estatus, posicion, genero FROM  Chinchilla, Estatus, Calidad WHERE	Chinchilla.estatus = Estatus.idEstatus AND Chinchilla.calidad = Calidad.idCalidad;";
    private $get_chinchilla = "SELECT idChinchilla, idMadre, colonia, edad, Calidad.calidad, Estatus.estatus, posicion, genero, fecha_alta, fecha_nacimiento, imagen FROM  Chinchilla, Estatus, Calidad WHERE	Chinchilla.estatus = Estatus.idEstatus AND Chinchilla.calidad = Calidad.idCalidad AND idChinchilla = ?;";
    private $get_males = "SELECT idChinchilla FROM Chinchilla WHERE genero='macho';";
    private $get_females = "SELECT idChinchilla FROM Chinchilla WHERE genero='hembra';";
    private $get_childs_mother = "SELECT idChinchilla, genero FROM Chinchilla WHERE idMadre=?;";
    private $get_childs_father = "SELECT idChinchilla, genero FROM Chinchilla WHERE idPadre=?;";
    private $get_parents = "SELECT idMadre, idPadre FROM Chinchilla WHERE idChinchilla=?;";
    private $get_childs = "SELECT idChinchilla FROM Chinchilla WHERE idMadre=? AND idPadre=?;";
    private $register_crosses = "INSERT INTO `chinchibei`.`Cruza` (`idMacho`, `idHembra`, `fechaCruza`) VALUES (?, ?,  NOW());";
    private $get_possible_crosses = "SELECT idChinchilla FROM Chinchilla WHERE idChinchilla NOT IN ";

    public function getAll() {
        $query = $this->db->query($this->get_all_chinchillas);
        return $query->result();
    }

    public function getChinchilla($id) {
        $query = $this->db->query($this->get_chinchilla, array($id));

        return $query->result();
    }

    public function getMales() {
        $query = $this->db->query($this->get_males);
        return $query->result();
    }

    public function getFemales() {
        $query = $this->db->query($this->get_females);

        return $query->result();
    }

    public function registerCrosses($male, $females) {
        foreach ($females as $female) {
        if ($female != "null")
            $query = $this->db->query($this->register_crosses, array($male, $female));
        }
    }

    private function getChilds($idChinchilla, $gender = '') {
      if ($gender == '') {
        // get gender from DB
        $query = $this->db->select("genero")->from("Chinchilla")->where("idChinchilla", $idChinchilla)->get();
        $row = $query->row();

        if (isset($row)) {
            $gender = $row->genero;
        }

        //echo "Genero: {$gender}".PHP_EOL;
      }

      $query_tmp = ($gender == 'hembra') ? $this->get_childs_mother : $this->get_childs_father;
      $query = $this->db->query($query_tmp, array($idChinchilla));

      $results = array();
      foreach($query->result() as $row) {
        array_push($results, array('idChinchilla' => $row->idChinchilla, 'genero' => $row->genero));
      }

      return $results;
    }

    private function getFamilyDownTree($idChinchilla) {
        /* Get family down tree 3gens */
        $family = array();

        // Get childs
        $childs = $this->getChilds($idChinchilla); // 1st Gen
        if (!empty($childs))
            $family = array_merge($family, $childs);

        foreach($childs as $child) {
            //echo "Hijo: {$child['idChinchilla']} : {$child['genero']}".PHP_EOL;
            $grandChilds = $this->getChilds($child['idChinchilla'], $child['genero']); // 2nd Gen

            if(!empty($grandChilds))
                $family = array_merge($family, $grandChilds);

            if (isset($grandChilds)){
                foreach($grandChilds as $grandchild) {
                    //echo "Nieto: {$grandchild['idChinchilla']} : {$grandchild['genero']}".PHP_EOL;
                    $childs_3gen = $this->getChilds($grandchild['idChinchilla'], $grandchild['genero']);  // 3rd Gen
                    if (!empty($childs_3gen))
                        $family = array_merge($family, $childs_3gen);
                }
            }
        }

        $results = array();
        if(!empty($family)) {
            foreach($family as $member) {
                //echo "Miembro: {$member['idChinchilla']}".PHP_EOL;
                array_push($results, $member['idChinchilla']);
            }
        }
        return $results;
    }

}