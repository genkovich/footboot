<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    public $adm;
    public function __construct() {
        parent::__construct();
        $this->load->model('main1');
        $this->load->helper('date');
        $this->load->library('session');
        $this->load->model('adm');
        $this->adm = new Adm;
    }


    public function index()
	{
            date_default_timezone_set('UTC');
                $mod = new Main1;
                $game = $this->adm->getGame();
                $data['news'] = $mod->get_news();
                $data['video'] = $mod->get_video();
                $data['video']['links'] = $mod->get_video_links();
                $data['team1'] = $game->team1;
                $data['team2'] = $game->team2;
                $data['show'] = $game->show;
                $data['cost'] = $game->price;

		$this->load->view('template', $data);
	}
        public function buy(){
            $game = $this->adm->getGame();
            $id = $game->id;
            $email = $_POST['email'];
            $tmp_date = now();
            $data = array(
               'date' => date("Y-m-d H:i:s", $tmp_date) ,
               'email' => $email ,
               'game' => $id,
            );

            $this->db->insert('email', $data);
            $this->session->set_userdata('email', $email);
            sleep(0.5);
            echo 'Session work!'.$this->session->userdata('email');
        }


}

