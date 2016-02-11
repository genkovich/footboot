<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About extends CI_Controller {

    function index() {
        $data = array ();
		$this->load->view('about', $data);
    }

}
