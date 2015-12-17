<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    public $payment;
    public $mailer;

    function __construct() {
        parent::__construct();
        $this->load->model('mod_payment');
        $this->payment = new Mod_Payment;
        $this->load->model('mailer');
        $this->mailer  = new Mailer;
    }

    function index() {

    }

    function confirm() {

    }

    public function buy() {
        $email = $_POST['email'];
        $form  = $this->payment->buy($email);
        echo $form;
    }

    function status() {
        $price = $this->payment->checkCost();
        if ($price == 0) {
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
                $this->payment->addEmail($email);
                $this->mailer->test($email);
            } else {
                echo 'Почта была отправлена неверно';
            }
        }
        if ($price > 0) {
            $buff = '';
            foreach ($_POST as $key => $val) {
                $buff .= "$key: $val";
            }
            $data = array(
            'log' => $buff,
        );
            $this->db->insert('log', $data);
            $ik_payment_amount = trim(stripslashes($_POST['ik_am'])); // 1;   //Сумма платежа (recipientAmount);
            $ik_payment_id     = trim(stripslashes($_POST['ik_pm_no']));   //242;     //Идентификатор платежа
            $ik_payment_state  = trim(stripslashes($_POST['ik_inv_st'])); //'success';  //Статус платежа (paymentStatus);
            $ik_currency_exch  = trim(stripslashes($_POST['ik_cur']));  //'RUB';   //Валюта платежа (recipientCurrency);
            $userId            = $this->payment->isConfirm($ik_payment_amount, $ik_payment_id, $ik_payment_state, $ik_currency_exch);
            if (isset($userId)) {
                $this->payment->updateStatus($userId);
                $email = $this->payment->getEmail($userId);
                $this->mailer->test($email);
            }
        }
    }

}
