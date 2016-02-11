<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron_test extends CI_Controller {

	function index() {
		$this->load->library('MY_PHPMailer');
		$this->load->helper("url");
		$this->load->model('mail_cron');
		$model_cron = new Mail_cron;
		$emails_array = $model_cron->get_mails(10);
		
		foreach ($emails_array as $emails) {
			foreach ($emails as $email) {
			$model_cron->gogo($email);
			$model_cron->update_status($email);
			}
			var_dump($email);
			
		}
		echo 'done';
	}

	function put_mails(){
		$this->load->model('mail_cron');
		$model_cron = new Mail_cron;
		$emails = $model_cron->put_mails();
	}
}