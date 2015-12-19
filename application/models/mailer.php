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
        $title = 'Your link has been activated.';
        $all   = "Please see you link below: \n\n"
                . "http://austa751.pw/player/video/$db_tok->token \n\n"
                . "In case you have any questions contact us on footbootorg@gmail.com \n\n"
                . "Sincerely yours, \n"
                . "footboot.org";
        $e     = mail($to, $title, $all, 'From: footboot.org',  " -fnoreply@footboot.org");// 'From: genkovich@mail.ru');//, " -fnoreply@footboot.org"); //'From: genkovich@mail.ru');// " -fnoreply@footboot.org");
       // $e     = mail($to, $title, $all, 'From: genkovich@mail.ru');
        return $e;
    }

}
