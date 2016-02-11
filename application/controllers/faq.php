<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends CI_Controller {

    function index() {
        $data = array ();
		$this->load->view('faq', $data);
    }

}
