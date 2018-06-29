<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crosses extends REST_Controller {
    private $messages = array(
        'success' => array('message' => "ok"),
        'error' => array('message' => "error"),
    );

    private function exist($id)
    {
        $this->load->model("Chinchilla_model");
        $chinchilla = $this->Chinchilla_model->getChinchilla($id);

        return !empty($chinchilla);
    }

    public function byId($id = '') {}

    public function general() {}
}