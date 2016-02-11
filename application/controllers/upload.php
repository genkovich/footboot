<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    public function index() {
        $this->load->view('admin/upload', array('error' => ''));
    }

    public function do_upload() {

        $upload_path_url = base_url() . 'uploads/';
        $config['upload_path'] = FCPATH . 'uploads/';
        //$config['allowed_types'] = "jpg|jpeg|png|gif|flv|mp4|wmv|doc|docx|xsl|xslx|ppt|pptx|zip|rar|tar|mp3|avi";
        $config['allowed_types'] = "flv|mp4|wmv|avi|mov|qt|mpe|mpg|mpeg";
        $config['max_size']='999999999';
            $config['max_width']='200000000';
            $config['max_height']='1000000000000';
            $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
//            $error = array('error' => $this->upload->display_errors());
  //          $this->load->view('upload', $error);
            
            //Load the list of existing files in the upload directory
            $existingFiles = $this->db->select()->from('video_uploads')->get()->result_array();
            //var_dump($existingFiles); die;
            //$existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as  $info) {
             // if($fileName!='thumbs'){//Skip over thumbs directory
                //set the data for the json array   
                $fileName = $info['filename'].$info['ext'];
                $foundFiles[$f]['name'] = $info['title'];
                $foundFiles[$f]['size'] = $info['size'] * 1024;
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                //$foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                $foundFiles[$f]['embed'] = '<iframe width="560" height="325" src="http://footboot.org/embed/'.$info['filename'].'" frameborder="0" allowfullscreen></iframe>';
                $foundFiles[$f]['deleteUrl'] = base_url() . 'index.php/upload/deleteImage/' . $fileName;
                $foundFiles[$f]['deleteType'] = 'DELETE';
                $foundFiles[$f]['error'] = null;

                $f++;
              }
           // }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
        } else {
            $data = $this->upload->data();


            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $video_data = array(
            'title'    => $data['orig_name'],
            'filename'    => $data['raw_name'],
            'ext'     => $data['file_ext'],
            'size' => $data['file_size'],
       );

        $this->db->insert('video_uploads', $video_data);
            
        
            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['orig_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            //$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->embed = '<iframe width="560" height="325" src="http://footboot.org/embed/'.$data['raw_name'].'" frameborder="0" allowfullscreen></iframe>';
            $info->deleteUrl = base_url() . 'index.php/upload/deleteImage/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if (IS_AJAX) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
                $this->load->view('upload/upload_success', $file_data);
            }
        }
    }

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $path_file = FCPATH . 'uploads/' . $file;
        $success = unlink($path_file);
        $ext = pathinfo($path_file, PATHINFO_EXTENSION);

        $filename = basename($path_file, ".".$ext); // $file is set to "home"
        $success = $this->db->delete('video_uploads', array('filename' => $filename));
    
        //info to see if it is doing what it is supposed to
    $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/' . $file;
        $info->file = is_file(FCPATH . 'uploads/' . $file);

        if (IS_AJAX) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
            
            $file_data['delete_data'] = $file;
            $this->load->view('admin/delete_success', $file_data);
        }
    }

}