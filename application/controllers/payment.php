<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    public $payment;
    public $mailer;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('mod_payment');
        $this->payment = new Mod_Payment;
        $this->load->model('mailer');
        $this->mailer  = new Mailer;
        $this->load->helper('url');
    }

    function index() {

    }

    function sendAgain($email){
        if ($email == $this->session->userdata('email')) {
           if($this->mailer->test($email)) {
               $this->session->set_userdata('time', now());
               $this->session->unset_userdata('email');
               header('Location: /payment/sucsess/');
           } else {
               header('Location: /payment/failed/');
           }
        } else {
            header('Location: /payment/failed/');
        }

    }

    function sucsess() {        
        $data['status']  = 'Оплата прошла успешно. Сообщение отправлено вам на email.';
        if ($this->payment->isSended($this->session->userdata('email'))) {
        $data['message'] = 'Если в течение 5 минут письмо вам не пришло, нажмите кнопку для повторной отправки <br/> <a href="/payment/sendAgain/'.$this->session->userdata('email').'"> <button class="button">Отправить</button></a> ';
        }
        $this->load->view('template_pay_status', $data);
    }

    function failed() {
        $data['status']  = 'Ваше сообщение не было отправлено';
        $data['message'] = 'Попробуйте произвести оплату еще раз.';
        $this->load->view('template_pay_status', $data);
    }

    public function buy() {
        $email = $_POST['email'];
        if ($this->payment->isSended($email) == false) {
            $form = $this->payment->buy($email);
            $this->session->set_userdata('email', $email);
            echo $form;
        } else {
             $this->session->set_userdata('email', $email);
            echo 'Вы уже подписаны, выслать ссылку еще раз? <br/> <a href="/payment/sendAgain/'.$this->session->userdata('email').'"> <button class="button">Выслать</button></a>';
        }
    }

    function status() {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        $price = $this->payment->checkCost();
        if ($this->payment->isInTable($email) == false) {
            if ($price == 0) {
                $this->payment->addEmail($email);
                if ($this->mailer->test($email)) {
                    echo "Сообщение успешно отправлено Вам на почту";
                }
            }
        } else {
            $this->session->set_userdata('email', $email);
            echo 'Вы уже подписаны, выслать ссылку еще раз? <br/> <a href="/payment/sendAgain/'.$this->session->userdata('email').'"> <button class="button">Выслать</button></a>';
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
            if (isset($_POST['ik_pm_no'])) {
                $ik_payment_amount = trim(stripslashes($_POST['ik_am'])); // 1;   //Сумма платежа (recipientAmount);
                $ik_payment_id     = trim(stripslashes($_POST['ik_pm_no']));   //242;     //Идентификатор платежа
                $ik_payment_state  = trim(stripslashes($_POST['ik_inv_st'])); //'success';  //Статус платежа (paymentStatus);
                $ik_currency_exch  = trim(stripslashes($_POST['ik_cur']));  //'RUB';   //Валюта платежа (recipientCurrency);
                $userId            = $this->payment->isConfirmIk($ik_payment_amount, $ik_payment_id, $ik_payment_state, $ik_currency_exch);
            }
            if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
                $m_key     = 'xxsd';
                $arHash    = array($_POST['m_operation_id'],
                    $_POST['m_operation_ps'],
                    $_POST['m_operation_date'],
                    $_POST['m_operation_pay_date'],
                    $_POST['m_shop'],
                    $_POST['m_orderid'],
                    $_POST['m_amount'],
                    $_POST['m_curr'],
                    $_POST['m_desc'],
                    $_POST['m_status'],
                    $m_key);
                $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
                if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {
                   $userId            = $this->payment->isConfirmPayeer($_POST['m_orderid']);

                }

            }
            if (isset($userId)) {
               $status1 = $this->payment->updateStatus($userId);


               if ($status1 == true) {
                $email = $this->payment->getEmail($userId);
                $this->mailer->test($email);
               }
            }
        }
    }

}
