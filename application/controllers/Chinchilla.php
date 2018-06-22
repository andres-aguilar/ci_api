<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chinchilla extends CI_Controller {
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

    public function test() {
        $this->JSONresponse(array("message" => "Chinchilla GET"));
    }

    public function testPost() {
        $this->JSONresponse(array("message" => "Chinchilla POST"), 201);
    }

    public function testPut() {
        $this->JSONresponse(array("message" => "Chinchilla PUT"), 201);
    }
    public function testDelete() {
        $this->JSONresponse(array("message" => "Chinchilla DELETE"));
    }


}