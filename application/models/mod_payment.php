<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of payment
 *
 * @author genkovich
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_Payment extends CI_Model {

    public $adm;

    function __construct() {
        parent::__construct();
        $this->load->model('adm');
        $this->adm = new Adm;
        $this->load->helper('date');
        $this->load->library('session');
        date_default_timezone_set('UTC');
    }

    public function checkCost() {
        $query = $this->db->select('price')
                ->from('game')
                ->order_by('id', 'desc')
                ->limit('1')
                ->get()
                ->row();
        return $query->price;
    }

    public function addEmail($email) {
        $game   = $this->adm->getGame();
        $idGame = $game->id;
        $date   = now();
        $data   = array(
            'date'  => date("Y-m-d H:i:s", $date),
            'email' => $email,
            'game'  => $idGame,
        );
        return $this->db->insert('email', $data) ? true : false;
    }

    public function buy($email) {
        $game     = $this->adm->getGame();
        $id       = $game->id;
        $cost     = $game->price;
        $team1    = $game->team1;
        $team2    = $game->team2;
        $this->addEmail($email);
        $user_id  = $this->db->insert_id();
        $pay_id   = $id . $user_id;
        $cur      = 'RUB';
        $pay_data = array(
            'ik_payment_id'     => $pay_id,
            'ik_payment_amount' => $cost,
            'id_user'           => $user_id,
            'date_created'      => date("Y-m-d H:i:s", now()),
            'cur'               => $cur,
        );
        $this->db->insert('ik_kassa', $pay_data);
       echo $this->ikFormGenerate($pay_id, $cost, $cur, $email, $team1, $team2);
    }

    protected function ikFormGenerate($pay_id, $cost, $cur, $email, $team1, $team2) {
        $form = ' <form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
            <input type="hidden" name="ik_co_id" value="56698a273c1eaf250b8b4568" />
            <input type="hidden" name="ik_pm_no" value="' . $pay_id . '" />
            <input type="hidden" name="ik_am" value="' . $cost . '" />
            <input type="hidden" name="ik_cur" value="' . $cur . '" />
            <input type="hidden" name="ik_email" value="' . $email . '" />
            <input type="hidden" name="ik_desc" value="' . $team1 . 'vs' . $team2 . '" />
            <input type="submit" value="Pay">
        </form>';
        return $form;
    }

    public function isConfirm($ik_payment_amount, $ik_payment_id, $ik_payment_state, $ik_currency_exch) {
        $ik_kassa = $this->db->from('ik_kassa')
                ->where('ik_payment_id', $ik_payment_id)
                ->limit('1')
                ->get()
                ->row();

        if ($ik_kassa->ik_payment_amount == $ik_payment_amount && $ik_payment_state == 'success' && $ik_kassa->ik_payment_id == $ik_payment_id && $ik_kassa->cur == $ik_currency_exch) {
            return $ik_kassa->id_user;
        }
    }

    public function updateStatus($userId) {
        $data = array(
            'status' => 1,
        );
        $this->db->where('id', $userId)->update('email', $data); // обновляем запись,что платеж прошел успешно
    }

    public function getEmail($id) {
        $user_mail = $this->db->from('email')
                ->where('id', $id)
                ->limit('1')
                ->get()
                ->row();
        return $user_mail->email;
    }

}
