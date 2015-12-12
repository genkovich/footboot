<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author genkovich
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adm extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getGame() {
        $query = $this->db->from('game')
                ->order_by('id', 'desc')
                ->limit('1')
                ->get()
                ->row();
        return $query;
    }

    function save($team1, $team2, $price, $show) {
        $bool = filter_var($show, FILTER_VALIDATE_BOOLEAN);
        $data = array(
            'team1'  => $team1,
            'team2' => $team2,
            'price'  => $price,
            'show' => $bool,
        );
       $max_id  = $this->db->select_max('id')->from('game')->get()->row_array();
       if ($this->db->where('id', $max_id['id'] )->update('game', $data)) {
           return true;
       }
    }

}
