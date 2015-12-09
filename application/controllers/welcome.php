<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->view('welcome_message');
    }

    public function name() {
        //Формируем JSON
        $request_data = array('jsonrpc' => '2.0',
            'method'  => 'sms.GetInbound',
            'params'  => ['integration', 'xSwTWpr3SV'],
            'id'      => 'jsonrpc',);
        $json         = json_encode($request_data);

//Настраиваем cURL
        $ch = curl_init('http://sms.logikan.com/json/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Получаем данные
        $response = curl_exec($ch);
        $response = json_decode($response);
        $messages = json_decode($response->result);
        $message['2019-12-01 12:23:30'] = 'DAAD';
        $message['2015-12-11 11:06:30'] = 'NENEN';
        $number   = '79850693023';
        foreach ($messages as $dump){
            if($dump->fields->phonenumber == $number){
                $date_tmp = explode("T", $dump->fields->date_sms);
                $time_tmp = explode("Z", $date_tmp[1]);
                $date_time = $date_tmp[0]." ".$time_tmp[0];
                $message[$date_time] = $dump->fields->message;
            }
        }
        ksort($message);
        var_dump($message);


    }

    function name1() {

        $method   = 'sms.Send';
        $login    = 'integration';
        $password = 'xSwTWpr3SV';
        $number   = '79032739500';
        $text     = 'Vi priglasheni na sobesedovanie DATE v TIME na vakansiu VACANCY v kompaniu COMPANY po adresu: SCHEMA. Tel. 84993720838';

        $request_data = array(
            'jsonrpc' => '2.0',
            'method'  => $method,
            'params'  => [$login, $password, $number, $text, 0, 1],
            'id'      => 'jsonrpc',);
            $json        = json_encode($request_data);

//Настраиваем cURL
        $ch = curl_init('http://sms.logikan.com/json/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Получаем данные
        $response = curl_exec($ch);
        $response = json_decode($response);
        var_dump($response);
        if (isset($response->result->Id)){
		$result = $response->result->Id;
	} else {
		$result = 'Error';
	}

    // var_dump($response);
	$datetime = date("Y-m-d H:i:s");
        $tmp_date = "20.10.2015";

	$q = "INSERT INTO smsinf (date, date_sobes, number, text, result ) VALUES ('$datetime', '$tmp_date', '$number', '$text', '$result')";
	echo $q;
//$res = mysql_query($q);

    }







}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */