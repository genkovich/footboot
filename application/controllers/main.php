<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


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

		$this->load->view('template', $data);
	}


}

