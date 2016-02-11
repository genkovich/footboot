<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of player
 *
 * @author genkovich
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Player extends CI_Controller {

    function video($token) {
        if (isset($token) ) {
            $db_tok = $this->db->select('token')->from('game')->order_by('id', 'desc')->limit(1)->get()->row();
            //var_dump($db_tok);
           // var_dump($token);
            if ($token == $db_tok->token) {
                $this->load->view('rmtp_player');
              // $this->load->view('player');
            } else {
                echo 'No access - Link has expired';
            }
        }
    } 
    function rmtp (){
        $this->load->view('iframe');
    }

}
