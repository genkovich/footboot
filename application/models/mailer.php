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
        $to    = $email;
        $title = 'Test';
        $all   = "http://$_SERVER[HTTP_HOST]/player/video/$db_tok->token";
        $e     = mail($to, $title, $all, 'From: footboot.org', " -fnoreply@footboot.org"); //'From: genkovich@mail.ru');// " -fnoreply@footboot.org");
        var_dump($e);
    }

}
