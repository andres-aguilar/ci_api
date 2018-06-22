<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['title'] = "Inicio";
		$this->layout->view('welcome_message', $data);
	}
}
