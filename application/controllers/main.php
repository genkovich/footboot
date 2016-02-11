<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    public $adm;
    public $payment;
    public function __construct() {
        parent::__construct();
        $this->load->model('main1');
        $this->load->model('adm');
        $this->adm = new Adm;
        $this->load->helper('date');
    }

    public function test () {
        $this->load->view('admin/templates/header');
        $this->load->view('admin/templates/footer');
    }

    public function index()
	{

            date_default_timezone_set('UTC');
                $mod = new Main1;
                $game = $this->adm->getGame();
                $video = $this->adm->getVideo();
        $data['vid'][1] = $video->video1;
        $data['vid'][2] = $video->video2;
        $data['vid'][3] = $video->video3;
        $data['vid'][4] = $video->video4;
                $data['news'] = $mod->get_news();
                $data['video'] = $mod->get_video();
                $data['video']['links'] = $mod->get_video_links();
                $data['team1'] = $game->team1;
                $data['team2'] = $game->team2;
                $now = now();
                if(strtotime($game->datetime) < $now){
                    $data['show'] = 0;
                } else {
                    $data['show'] = $game->show;
                }


                $data['cost'] = $game->price;
                $time_match_tmp = explode(":", $game->time_match);
                $data['time_match'] = $time_match_tmp[0].":".$time_match_tmp[1];
		$this->load->view('template', $data);
	}

        public function pay(){
            $game = $this->adm->getGame();
            $data['cost'] = $game->price;
            if ($game->show == 1){
            $this->load->view('template_pay', $data);
            } else {
                echo 'Подписка закрыта';
            }
        }



}

