<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chinchilla extends REST_Controller
{
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
        'error' => array('message' => "error"),
    );

    public function index_get($id='')
    {
        $this->load->model("Chinchilla_model");
        if ($id != '') {
            if ($id == 'males') {
                // Get all males
                $chinchillas = $this->Chinchilla_model->getMales();
                $status = (empty($chinchillas)) ? 404 : 200;
                $chinchilla = (!empty($chinchillas)) ? $chinchillas : $this->messages['error'];
                $this->response($chinchillas, $status);

            } elseif ($id == 'females') {
                // Get all females
                $chinchillas = $this->Chinchilla_model->getFemales();
                $status = (empty($chinchillas)) ? 404 : 200;
                $chinchilla = (!empty($chinchillas)) ? $chinchillas : $this->messages['error'];
                $this->response($chinchillas, $status);

            } else {
                // Get chinchilla by Id
                $chinchilla = $this->Chinchilla_model->getChinchilla($id);

                $status = (empty($chinchilla)) ? 404 : 200;
                $chinchilla = (!empty($chinchilla)) ? $chinchilla[0] : $this->messages['error'];
                $this->response($chinchilla, $status);
            }
        } else {
            // Get all chinchillas
            $chinchillas = $this->Chinchilla_model->getAll();
            $this->response($chinchillas);
        }
    }

    public function exist($id)
    {
        $this->load->model("Chinchilla_model");
        $chinchilla = $this->Chinchilla_model->getChinchilla($id);

        return !empty($chinchilla);
    }

    public function index_post()
    {
        if ($this->input->post()) {
            $id = $this->input->post('idChinchilla', true);
            $idMother = $this->input->post('idMother', true);
            $idFather = $this->input->post('idFather', true);
            $colony = $this->input->post('colony', true);
            $age = $this->input->post('age', true);
            $quality = $this->input->post('quality', true);
            $status = $this->input->post('status', true);
            $location = $this->input->post('location', true);
            $gender = $this->input->post('gender', true);
            $birth_date = $this->input->post('birth', true);
            $date = date("Y-m-d");
            $image = "";

            // Upload image
            $config['upload_path'] = './assets/media/'; // chmod 777
            $config['allowed_types'] = 'jpg';
            $config["overwrite"] = true;
            $config['file_name'] = "{$id}.jpg";

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                error_log($this->upload->display_errors());
            } else {
                error_log("OK, PHOTO UPLOADED");
                $image = "assets/media/{$id}.jpg";
            }

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
                'imagen' => $image,
            );

            $this->load->model("Chinchilla_model");
            if ($this->Chinchilla_model->registerChinchilla($chinchilla)) {

                $this->response(array('message' => 'ok', 'chinchilla' => $chinchilla), 201);
            } else {
                $this->response($this->messages['error']);
            }

        } else {
            $this->response($this->messages['error'], 404);
        }
    }

    public function index_put()
    {
        $id = $this->put('idChinchilla');
        $idMother = $this->put('idMother');
        $idFather = $this->put('idFather');
        $colony = $this->put('colony');
        $age = $this->put('age');
        $quality = $this->put('quality');
        $status = $this->put('status');
        $location = $this->put('location');
        $gender = $this->put('gender');

        $chinchilla = array(
            'idMadre' => $idMother,
            'idPadre' => $idFather,
            'colonia' => $colony,
            'edad' => $age,
            'calidad' => $quality,
            'estatus' => $status,
            'posicion' => $location,
            'genero' => $gender,
        );

        if (!$this->exist($id)) {
            $this->response($this->messages["error"], 404);
        } else {
            $this->load->model("Chinchilla_model");
            $res = $this->Chinchilla_model->updateChinchilla($chinchilla, $id);
            $this->response(array('message' => 'success', 'id' => $id), 201);
        }
    }

    public function index_delete($id='')
    {
        if ($id == '' || !$this->exist($id)) {
            $this->response(array("message" => "ERROR"), 404);
        } else {
            $this->load->model("Chinchilla_model");

            // set Status = 8
            $res = $this->Chinchilla_model->updateChinchilla(array('estatus' => 8), $id);
            $this->response(array('message' => 'success'), 201);
        }
    }

}
