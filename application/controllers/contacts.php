<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts extends CI_Controller {

    function index() {
        $data = array ();
		$this->load->view('contacts', $data);
    }

}
