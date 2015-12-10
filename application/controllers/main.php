<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->load->library('session');
    }


    public function index()
	{
            date_default_timezone_set('UTC');
                $this->load->model('main1');
                $mod = new Main1;
                $data['news'] = $mod->get_news();

                $data['video'] = $mod->get_video();
                $data['video']['links'] = $mod->get_video_links();
                $data['team1'] = "Liverpool";
                $data['team2'] = "Chelsea";
                $data['show'] = 1;
                $data['cost'] = 3;

		$this->load->view('template', $data);
	}
        public function buy(){
            $email = $_POST['email'];
            $tmp_date = now();
            $data = array(
               'date' => date("Y-m-d H:i:s", $tmp_date) ,
               'email' => $email ,
               'game' => '1'
            );

            $this->db->insert('email', $data);
            $this->session->set_userdata('email', $email);
            sleep(0.5);
            echo 'Session work!'.$this->session->userdata('email');
        }


}

