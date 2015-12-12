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
    }

    function index() {
        $game = $this->adm->getGame();

        $data['team1']   = $game->team1;
        $data['team2']   = $game->team2;
        $data['hours']   = '22';
        $data['minutes'] = '45';
        $data['price']   = $game->price;
        $data['show'] = $game->show == 1 ? 'checked' : '';
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
        $query = $this->db->get();
        //var_dump($query->result());
        echo "<table cellspacing='0' border='1' cellpadding='0'>";
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

    function save(){
        if(isset($_POST['team1']) && isset($_POST['team2']) && isset($_POST['price'])){
            $team1 = $_POST['team1'];
            $team2 = $_POST['team2'];
            $price = $_POST['price'];
            $show = $_POST['show'];
            $res = $this->adm->save($team1, $team2, $price, $show);
            if ($res) {
                echo 'Сохранено';

            }
        }

    }

}
