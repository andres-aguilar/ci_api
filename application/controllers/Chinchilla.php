<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chinchilla extends REST_Controller {
    /**
     * API RESTfull
     * 
     * Methods:
     *   POST   : Create => 201 or 200 status
     *   GET    : Read   => 200 status & JSON response
     *   PUT    : Update => 201 status
     *   DELETE : Delete => 200 status
    */

    private $messages = array(
        'success' => array('message' => "ok"),
        'error'   => array('message' => "error")
    );

    private function JSONresponse($msg, $status=200) {
        /* Return a JSON message

            Params
            $msg : Array with a message to encode as a JSON response
        */
        $this->output->set_status_header($status)
                     ->set_content_type('application/json', 'utf-8')
            		 ->set_output(json_encode($msg));
    }

    public function index_get($id='') {
        $this->load->model("Chinchilla_model");
        if ($id != '') {
            // Get chinchilla by Id
            $chinchilla = $this->Chinchilla_model->getChinchilla($id);
            $this->JSONresponse($chinchilla[0]);
        } else {
            // Get all chinchillas
            $chinchillas = $this->Chinchilla_model->getAll();
            $this->JSONresponse($chinchillas);
        }
    }

    public function index_post() {
        if ($this->input->post()) {
            $id = $this->input->post('idChinchilla', true);
            $idMother = $this->input->post('idMother', true);
            $idFather = $this->input->post('idFather', true);
            $colony = $this->input->get_post('colony', true);
            $age = $this->input->get_post('age', true);
            $quality = $this->input->get_post('quality', true);
            $status = $this->input->get_post('status', true);
            $location = $this->input->get_post('location', true);
            $date = date("Y-m-d");
            $gender = $this->input->get_post('gender', true);
            $birth_date = $this->input->get_post('birth', true);
            //$image = "assets/media/{$this->input->get_post('bornCode', true)}.jpg";
            $image = $this->input->get_post('image', true);

            $chinchilla = array(
                'idChinchilla' => $id,
                'idMadre' => $idMother,
                'idPadre' => $idFather,
                'colonia' => $colony,
                'edad' => $age,
                'calidad' => $quality,
                'estatus' => $status,
                'posicion' => $location,
                'genero' => $gender,
                'fecha_alta' => $date,
                'fecha_nacimiento' => $birth_date,
                'imagen' => $image
            );

            $this->JSONresponse($chinchilla, 201);
        } else {
            $this->JSONresponse(array("message" => "ERROR"), 404);
        }
    }

    public function index_put() {
        $this->JSONresponse(array("message" => "Chinchilla PUT"), 201);
    }
    public function index_delete($id='') {
        if ($id == '') {
            // No params
            $this->JSONresponse(array("message" => "ERROR"), 404);
        } else {
            $this->JSONresponse(array("message" => "Chinchilla DELETE Id: {$id}"));
        }
    }

}