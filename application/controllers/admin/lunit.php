<?php

class Lunit extends CI_Controller {

    public $adm;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('adm');
        $this->adm = new Adm;

        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != 'footboot-admin' || $_SERVER['PHP_AUTH_PW'] != 'Zx4dRpxAd') {
            header('WWW-Authenticate: Basic realm="footboot.org"');
            header('HTTP/1.0 401 Unauthorized');
            die('Access Denied');
        }
    }

    function index() {
        $game            = $this->adm->getGame();
        $video           = $this->adm->getVideo();
        $data['video1']  = $video->video1;
        $data['video2']  = $video->video2;
        $data['video3']  = $video->video3;
        $data['video4']  = $video->video4;
        $data['team1']   = $game->team1;
        $data['team2']   = $game->team2;
        $data['timeend'] = $game->datetime;
        $time = explode(":", $game->time_match);
        $data['hours']   = $time[0];
        $data['minutes'] = $time[1];
        $data['price']   = $game->price;
        $data['show']    = $game->show == 1 ? 'checked' : '';

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
        echo $date1 . $date2;
        $this->db->select('email, date, team1, team2, price');
        $this->db->from('email');
        $this->db->join('game', 'game.id = email.game');
        $this->db->where('date > ', $date1);
        $this->db->where('date < ', $date2);
        $this->db->where('status ', 1);
        $query = $this->db->get();
        //var_dump($query->result());
        echo "<table cellspacing='0' border='1' cellpadding='0'>";
        echo "<thead>"
        . "<th>Email</th>"
        . "<th>Date</th>"
        . "<th>Game</th>"
        . "<th>Price</th>"
        . "</thead>";
        foreach ($query->result() as $row) {
            echo "<tr>"
            . "<td> $row->email</td>"
            . "<td> $row->date</td>"
            . "<td> $row->team1 vs $row->team2 </td>"
            . "<td> $row->price</td>"
            . "</tr>";
        }
        echo "</table>";
    }

    function save() {
        if (isset($_POST['team1']) && isset($_POST['team2']) && isset($_POST['price'])) {
            $team1   = $_POST['team1'];
            $team2   = $_POST['team2'];
            $price   = $_POST['price'];
            $show    = $_POST['show'];
            $timeend = $_POST['timeend'];
            $time_match =  $_POST['time_match'];
            $res     = $this->adm->save($team1, $team2, $price, $show, $timeend, $time_match);
            if ($res) {
                echo 'Сохранено';
            }
        }
    }

    function newGame() {
        if (isset($_POST['team1']) && isset($_POST['team2']) && isset($_POST['price'])) {
            $team1   = $_POST['team1'];
            $team2   = $_POST['team2'];
            $price   = $_POST['price'];
            $show    = $_POST['show'];
            $timeend = $_POST['timeend'];
            $time_match =  $_POST['time_match'];
            $res     = $this->adm->newGame($team1, $team2, $price, $show, $timeend, $time_match);
            if ($res) {
                echo 'Добавлено';
            }
        }
    }

    function savevideo() {
        for ($i = 1; $i <= 4; $i++) {
            $vid[] = $_POST['video' . $i];
        }

        $this->adm->saveVideo($vid);
    }

    function newletter() {
        $emails = $this->db->select('email')->from('email')->group_by('email')->get()->result();
        foreach ($emails as $email) {
            $data['email'][] = $email->email;
        }
        $this->load->view('letter', $data);
    }

    function sendmess() {
        $adres = explode(",", $_POST['opt']);
        foreach ($adres as $adr) {
            $to    = $adr;
            $title = $_POST['subj'];
            $all   = $_POST['mess'];
            $e     = mail($to, $title, $all, 'From: footboot.org', ' -fnoreply@footboot.org' ); //, " -fnoreply@footboot.org"); //'From: genkovich@mail.ru');// " -fnoreply@footboot.org");
            var_dump($e);
        }

    }

}
