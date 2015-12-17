<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    public $adm;
    public $payment;
    public function __construct() {
        parent::__construct();
        $this->load->model('main1');
        $this->load->model('adm');
        $this->adm = new Adm;
    }


    public function index()
	{
            date_default_timezone_set('UTC');
                $mod = new Main1;
                $game = $this->adm->getGame();
                $video = $this->adm->getVideo();
        $data['video1'] = $video->video1;
        $data['video2'] = $video->video2;
        $data['video3'] = $video->video3;
        $data['video4'] = $video->video4;
                $data['news'] = $mod->get_news();
                $data['video'] = $mod->get_video();
                $data['video']['links'] = $mod->get_video_links();
                $data['team1'] = $game->team1;
                $data['team2'] = $game->team2;
                $data['show'] = $game->show;
                $data['cost'] = $game->price;
		$this->load->view('template', $data);
	}



}

