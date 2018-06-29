<?php
class Catalog_model extends CI_Model 
{
    private $get_status = "SELECT * FROM Estatus;";
    private $get_status_by_id = "SELECT * FROM Estatus WHERE idEstatus = ?;";
    private $new_status = "INSERT INTO Estatus VALUES (NULL, ?);";

    private $get_quality = "SELECT * FROM Calidad;";
    private $get_quality_by_id = "SELECT * FROM Calidad WHERE idCalidad = ?;";
    private $new_quality = "INSERT INTO Caldiad VALUES (NULL, ?);";

    public function get_status($id) {}

    public function get_all_status() {}

    public function new_status($item) {}

    public function get_quality($id) {}

    public function get_all_qualities() {}

    public function new_quality($item) {}
}