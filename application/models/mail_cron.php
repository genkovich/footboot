<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail_cron extends CI_Model {

	public function gogo($email){
		$mail = new PHPMailer;
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'mail.your-server.de';                       // Specify main and backup server
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'no-reply@matchday.biz';                   // SMTP username
		$mail->Password = '11zRyyWMel79g2fO';               // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		$mail->Port = 25;                                    //Set the SMTP port number - 587 for authenticated TLS
		$mail->setFrom('no-reply@matchday.biz', 'Matchday');     //Set who the message is to be sent from
		$mail->addAddress($email);  // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->CharSet = 'UTF-8';
		 $text = "Информация по инциденту 22.01.2016";
		$text =  iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
		$mail->Subject = $text;
		$mail->Body    = "Уважаемые пользователи ресурса matchday.biz! <br/><br/>
		
		Без всякого предупреждения нас отключили от хостинга. Хостер (немецкая компания hetzner.de) обнаружил перегрузку сервера, связанную с многочисленными запросами, идущими на наш сайт со стороннего адреса и отключил нас, отказавшись далее разбираться до понедельника.
		Наши специалисты диагностировали проблему и выяснили, что запросы идут с пула IP адресов ТОГО ЖЕ хостера – то есть, от него самого, что свидетельствует о том, что у хостера просто некорректно налажена работа самого хостинга.
		Техподдержка с нами отказалась работать после 18-00 пятницы немецкого времени, и сайт matchday.biz будет теперь гарантировано лежать до середины дня понедельника, 25 января.
		(желающие прочитать про очень похожий случай с этим же хостером могут сделать это тут).<br/><br/>
		
		Независимо от того, чем закончится эта история, мы будем менять хостера, но локальная задача – включить сайт, чем мы и будем заниматься, увы, теперь только в понедельник.
		Мы очень извиняемся за неудобства, причиненные этой историей, которая полностью находится вне нашего контроля.<br/><br/>
		
		Подкаст по итогам 23го тура будет записан авторами в воскресение и будет опубликован, как только сайт станет доступным.
		Ни бетмен-лайв, ни фэнтэзи-лайв в23м туре провести не представляется возможным.<br/>
		В бетмене все ставки будут засчитаны.<br/><br/>
		
		О доступности сайта мы немедленно вас проинформируем, в том числе и на сайте arsenal-blog.com.<br/><br/>
		
		
		Администрация  matchday.biz";
		 
		if(!$mail->send()) {
			return false;
		}
		 
		return true;
	}

	function put_mails() {
		
		$handle = @fopen(FCPATH ."/application/libraries/emails.txt", "r");
		if ($handle) {
			while (($buffer = fgets($handle, 4096)) !== false) {
    			$data = array(
    				'email' => $buffer,
    				'status' => 0,
    			);
        		$this->db->insert('email_cron', $data);
    		}
    		if (!feof($handle)) {
       			 echo "Error: unexpected fgets() fail\n";
    		}
   		 fclose($handle);
		}

	}

	function get_mails($count) {
		
		 $emails = $this->db->select('email')->from('email_cron')->where('status', 0)->limit($count)->get()->result_array();
		 return $emails;
	}
	function update_status($email) {
		$this->db->where('email', $email);
		$this->db->update('email_cron', array('status' => 1));
	}
}