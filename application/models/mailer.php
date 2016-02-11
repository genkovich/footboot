<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailer
 *
 * @author genkovich
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer extends CI_Model {

    function test($email) {
        $db_tok = $this->db->select('token')->from('game')->order_by('id', 'desc')->limit(1)->get()->row();
        $to	= $email;
        $title	= 'Your link has been activated.';
        $all	= "Please see your link below: \n\n"
                . "http://austa751.pw/player/video/$db_tok->token \n\n\n"
                . "In case you have any questions contact us on info@footboot.org \n"
                . "Sincerely yours,"
                . "footboot.org";
        $title = 'Your link has been activated.';
	$headers = "From: info@footboot.org\r\n";
//	$headers .= "Return-Path: info@footboot.org\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain, charset=utf-8; format=flowed\r\n";
        $e     = mail($to, $title, $all, $headers, '-finfo@footboot.org');//,  " -fnoreply@footboot.org");// 'From: genkovich@mail.ru');//, " -fnoreply@footboot.org"); //'From: genkovich@mail.ru');// " -fnoreply@footboot.org");
       // $e     = mail($to, $title, $all, 'From: genkovich@mail.ru');
        return $e;
    }

}
