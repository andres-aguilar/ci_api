<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quality extends REST_Controller {
    private $messages = array(
        'success' => array('message' => "ok"),
        'error' => array('message' => "error"),
    );

    private function exist($id)
    {
        $this->load->model("Catalog_model");
        $item = $this->Catalog_model->get_quality($id);

        return !empty($item);
    }

    public function create() {
        if ($this->input->post()) {
            $this->response($this->messages['success'], 201);
        } else {
            $this->response($this->messages['error'], 404);
        }
    }

    public function get($id = '') {
        if ($id != '') {
            if ($this->exist($id)) {
                $this->response($this->messages['success']);
            } else {
                $this->response($this->messages['error'], 404);
            }
        } else {
            $this->response($this->messages['success']);
        }
    }

    public function update($id = '') {
        if ($id != '' && $this->exist($id)) {
            $this->response($this->messages['success'], 201);
        } else {
            $this->response($this->messages['error'], 404);
        }
    }
    
    

}