<?php

class Lunit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
         $this->load->helper('url');
        $this->load->library('session');
    }

    function index() {

        $data['team1']   = 'TEAM';
        $data['team2']   = 'CREW';
        $data['hours']   = '22';
        $data['minutes'] = '45';
        $data['price']   = '3';
        $this->load->view('admin', $data);
    }

    function login() {
        echo 'login';
    }

    function logout() {
        echo 'logout';
    }

    function showdate() {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        echo $date1. $date2;
        $this->db->select('email, date, game');
        $this->db->from('email');
        $this->db->where('date > ', $date1);
        $this->db->where('date < ', $date2);
        $query = $this->db->get();
        print_r($query->result());
        foreach ($query->result() as $row) {
            echo $row->email;
        }
    }

}
