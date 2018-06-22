<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chinchilla extends CI_Controller {
    private $messages = array(
        'success' => array('message' => "ok"),
        'error'   => array('message' => "error")
    );

    public function JSONresponse($msg) {
        /* Return a JSON message

            Params
            $msg : Array with a message to encode as a JSON response
        */
        $this->output->set_content_type('application/json')
            		 ->set_output(json_encode($msg));
    }
}