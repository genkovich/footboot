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

    public function isSended($email) {
        $game      = $this->adm->getGame();
        $idGame    = $game->id;
        $isInTable = $this->db->select('email')->from('email')->where('game', $idGame)->where('email', $email)->where('status', 1)->get()->row();
        return $isInTable;
    }

    public function isInTable($email) {
        $game      = $this->adm->getGame();
        $idGame    = $game->id;
        $isInTable = $this->db->select('email, id')->from('email')->where('game', $idGame)->where('email', $email)->get()->row();
        return $isInTable;
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
        $game  = $this->adm->getGame();
        $id    = $game->id;
        $cost  = $game->price;
        $team1 = $game->team1;
        $team2 = $game->team2;
        $user  = $this->isInTable($email);
        if ($user == false) {
            $this->addEmail($email);
            $user_id = $this->db->insert_id();
        } else {
            $user_id = $user->id;
        }

        $pay_id = $id . '0' . $user_id;
        $cur    = 'RUB';
        if ($this->getIkInf($pay_id) == false) {
            $pay_data = array(
                'ik_payment_id'     => $pay_id,
                'ik_payment_amount' => $cost,
                'id_user'           => $user_id,
                'date_created'      => date("Y-m-d H:i:s", now()),
                'cur'               => $cur,
            );

            $this->db->insert('ik_kassa', $pay_data);
        }


        echo $this->ikFormGenerate($pay_id, $cost, $cur, $email, $team1, $team2);

        $m_shop    = '112761500';
        $m_orderid = $pay_id;
        $m_amount  = number_format($cost, 2, '.', '');
        $m_curr    = 'RUB';
        $m_desc    = base64_encode('footboot.org');
        $m_key     = 'xxsd';

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key
        );
        $sign   = strtoupper(hash('sha256', implode(':', $arHash)));

        if ($this->getPayeerInf($pay_id) == false) {
            $pay_data = array(
                'm_orderid'    => $m_orderid,
                'm_amount'     => $cost,
                'id_user'      => $user_id,
                'date_created' => date("Y-m-d H:i:s", now()),
                'm_curr'       => $cur,
            );

            $this->db->insert('payeer', $pay_data);
        }

        echo $this->payerFormGenerate($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc, $sign);
    }

    protected function payerFormGenerate($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc, $sign) {
        $form = '<form class="payment" method="GET" action="https://payeer.com/merchant/">
                    <input type="hidden" name="m_shop" value="' . $m_shop . '">
                    <input type="hidden" name="m_orderid" value="' . $m_orderid . '">
                    <input type="hidden" name="m_amount" value="' . $m_amount . '">
                    <input type="hidden" name="m_curr" value="' . $m_curr . '">
                    <input type="hidden" name="m_desc" value="' . $m_desc . '">
                    <input type="hidden" name="m_sign" value="' . $sign . '">
                    <input id="payeer" type="submit" name="m_process" value="send" />
                </form>';
        return $form;
    }

    protected function ikFormGenerate($pay_id, $cost, $cur, $email, $team1, $team2) {
        $form = ' <form class="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
            <input type="hidden" name="ik_co_id" value="56698a273c1eaf250b8b4568" />
            <input type="hidden" name="ik_pm_no" value="' . $pay_id . '" />
            <input type="hidden" name="ik_am" value="' . $cost . '" />
            <input type="hidden" name="ik_cur" value="' . $cur . '" />
            <input type="hidden" name="ik_email" value="' . $email . '" />
            <input type="hidden" name="ik_desc" value="' . $team1 . 'vs' . $team2 . '" />
            <input id="interkassa" type="submit" value="Pay" >
        </form>';
        return $form;
    }

    function getIkInf($ik_payment_id) {
        $ik_kassa = $this->db->from('ik_kassa')
                ->where('ik_payment_id', $ik_payment_id)
                ->limit('1')
                ->get()
                ->row();
        return $ik_kassa;
    }

    function getPayeerInf($m_orderid) {
        $payeer = $this->db->from('payeer')
                ->where('m_orderid', $m_orderid)
                ->limit('1')
                ->get()
                ->row();
        return $payeer;
    }

    public function isConfirmIk($ik_payment_amount, $ik_payment_id, $ik_payment_state, $ik_currency_exch) {
        $ik_kassa = $this->getIkInf($ik_payment_id);
        if ($ik_kassa->ik_payment_amount == $ik_payment_amount && $ik_payment_state == 'success' && $ik_kassa->ik_payment_id == $ik_payment_id && $ik_kassa->cur == $ik_currency_exch) {
            //$this->addEmail($email);
            return $ik_kassa->id_user;
        }
    }
     public function isConfirmPayeer($m_orderid) {
        $m_orderid = $this->getPayeerInf($m_orderid);
            //$this->addEmail($email);
            return $m_orderid->id_user;

    }

    public function updateStatus($userId) {
        $game  = $this->adm->getGame();
        $id    = $game->id;
        $status =  $this->db->select()->from('email')->where('game', $id)->where('id', $userId)->where('status', 1)->get()->row();
      if ($status == false){
        $data = array(
            'status' => 1,
        );
        $this->db->where('id', $userId)->update('email', $data); // обновляем запись,что платеж прошел успешно
        return true;
      } else {
          return false;
      }

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
