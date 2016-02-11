<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rules extends CI_Controller {

    function index() {
        $data = array ();
		$this->load->view('rules', $data);
    }

}
