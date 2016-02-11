<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Embded extends CI_Controller {

	function index($video_name) {
		if ($video_name != 'empty') {
			  $this->load->helper(array('form', 'url', 'file'));
			$video = $this->db->select()->from('video_uploads')->where('filename', $video_name)->get()->row();
			if(empty($video)) {
				show_404();
			}
			$path = "/uploads/" . $video->filename.$video->ext;
			
			$data = array(
				'video' => $path,
			);
			$this->load->view('embded.php', $data);
		} else {
			show_404();
		}
	}
}