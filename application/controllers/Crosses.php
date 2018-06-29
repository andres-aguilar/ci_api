<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crosses extends REST_Controller
{
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

    public function index_get($id='') {
        if ($id != '' && $this->exist($id)) {
            $this->load->model('Chinchilla_model');

            $crosses = $this->Chinchilla_model->getPossibleCrosses($id);
            $this->response(array('candidates' => $crosses));
        } else {
            $this->response($this->messages['error'], 404);
        }
    }

    public function index_post() {
        if ($this->input->post())  {
            $this->load->model('Chinchilla_model');
            $male    = $this->post('male');
            $females = $this->post('females'); 

            $this->Chinchilla_model->registerCrosses($male, $females);

            $this->response(array('male' => $male, 'females' => $females), 201);
        } else {
            $this->response($this->messages['error'], 404);
        }
    }
}