<?php
class Chinchilla_model extends CI_Model {
    private $get_all_chinchillas = "SELECT idChinchilla, idMadre, colonia, edad, Calidad.calidad, Estatus.estatus, posicion, genero FROM  Chinchilla, Estatus, Calidad WHERE	Chinchilla.estatus = Estatus.idEstatus AND Chinchilla.calidad = Calidad.idCalidad;";
    private $get_chinchilla = "SELECT idChinchilla, idMadre, colonia, edad, Calidad.calidad, Estatus.estatus, posicion, genero, fecha_alta, fecha_nacimiento, imagen FROM  Chinchilla, Estatus, Calidad WHERE	Chinchilla.estatus = Estatus.idEstatus AND Chinchilla.calidad = Calidad.idCalidad AND idChinchilla = ?;";
    private $get_males = "SELECT idChinchilla FROM Chinchilla WHERE genero='macho';";
    private $get_females = "SELECT idChinchilla FROM Chinchilla WHERE genero='hembra';";
    private $get_parents = "SELECT idMadre, idPadre FROM Chinchilla WHERE idChinchilla=?;";
    private $get_childs_mother = "SELECT idChinchilla, genero FROM Chinchilla WHERE idMadre=?;";
    private $get_childs_father = "SELECT idChinchilla, genero FROM Chinchilla WHERE idPadre=?;";
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

    public function registerChinchilla($chinchilla) {
        return $this->db->insert('Chinchilla', $chinchilla);
    }

    public function updateChinchilla($chinchilla, $id) {
        $this->db->set($chinchilla);
        $this->db->where('idChinchilla', $id);
        return $this->db->update('Chinchilla');
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

    public function getFamilyUpTree($idChinchilla) {
        /* Get family up tree 3gens */
        $family = array();
        $idMother;
        $idFather;
        $idGrandMother;
        $idGrandFather;
        // Get Parents
        $query = $this->db->query($this->get_parents, array($idChinchilla));
        $row = $query->row();

        if (isset($row)) {
            $idMother = $row->idMadre;
            $idFather = $row->idPadre;

            if(isset($idMother)) 
                array_push($family, $idMother);
            if(isset($idFather))
                array_push($family, $idFather);
        }
        $query->free_result();

        // Validate parent ids
        if (isset($idMother) && isset($idFather)) {
            //echo "Padres: {$idMother} - {$idFather}".PHP_EOL;
            /* Get brothers & sisters */
            $query = $this->db->query($this->get_childs, array($idMother, $idFather));
            foreach ($query->result() as $row) {
                $chinchilla = $row->idChinchilla;

                if(isset($chinchilla))
                    array_push($family, $chinchilla);
            }
            $query->free_result();

            /* Get Grandparents */
            $query = $this->db->query($this->get_parents, array($idMother));
            foreach ($query->result() as $row) {
                $idGrandMother = $row->idMadre;
                $idGrandFather = $row->idPadre;

                if(isset($idGrandMother)) 
                    array_push($family, $idGrandMother);
                if(isset($idGrandFather))
                    array_push($family, $idGrandFather);
            }
            $query->free_result();

            // Validate grandpas
            if (isset($idGrandMother) && isset($idGrandFather)) {
                /* Get aunts and uncles */
                //echo "Abuelos: {$idGrandMother} - {$idGrandFather}".PHP_EOL;
                $query = $this->db->query($this->get_childs, array($idGrandMother, $idGrandFather));
                foreach ($query->result() as $row) {
                    $chinchilla = $row->idChinchilla;

                    if(isset($chinchilla))
                        array_push($family, $chinchilla);
                }
                $query->free_result();

                /* get Grandparents parents =P */
                $query = $this->db->query($this->get_parents, array($idGrandMother));
                foreach ($query->result() as $row) {
                    $idGrandMother2 = $row->idMadre;
                    $idGrandFather2 = $row->idPadre;

                    if(isset($idGrandMother2)) 
                        array_push($family, $idGrandMother2);
                    if(isset($idGrandFather2))
                    array_push($family, $idGrandFather2);
                }
                $query->free_result();

                $query = $this->db->query($this->get_parents, array($idGrandFather));
                foreach ($query->result() as $row) {
                    $idGrandMother1 = $row->idMadre;
                    $idGrandFather1 = $row->idPadre;

                    if(isset($idGrandMother1)) 
                        array_push($family, $idGrandMother1);
                    if(isset($idGrandFather1))
                    array_push($family, $idGrandFather1);
                }
                $query->free_result();
            }
        }
        return $family;
    }

    public function getPossibleCrosses($id) {
        // get family
        $down = $this->getFamilyDownTree($id);
        $up = $this->getFamilyUpTree($id);

        $family = array_merge($down, $up);
        $family_str = implode("', '", $family);
        $family_str = "'{$family_str}'";

        // get gender
        $query = $this->db->select("genero")->from("Chinchilla")->where("idChinchilla", $id)->get();
        $row = $query->row();

        if (isset($row)) {
            $gender = $row->genero;
        }
        $query->free_result();

        // Search for opposite sex
        $gender = ($gender == "macho") ? "hembra" : "macho";

        // Not in family
        $query = $this->db->query($this->get_possible_crosses."({$family_str}) AND genero='{$gender}' AND estatus NOT IN (2, 8, 9);");

        $results = array();
        foreach($query->result() as $row) {
            array_push($results, $row->idChinchilla);
        }

        return $results;
    }

}