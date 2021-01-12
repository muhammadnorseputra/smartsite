<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('image_upload')) {
  function image_upload($url,$image_path)
  {
  
     $ci =& get_instance();
  
     $config['upload_path'] = $image_path;
     $config['allowed_types'] = 'gif|jpg|png|jpeg';
     $config['max_size'] = 1024;
     $config['max_width'] = 1600;
     $config['max_height'] = 1600;
     $config['maintain_ratio'] = TRUE;
     $config['remove_spaces'] = TRUE;
  
     $ci->load->library('upload', $config);
     $ci->upload->initialize($config);
  
     if (!$ci->upload->do_upload('image_upload')) {
        $error = array('error' => $ci->upload->display_errors());
     
        $ci->session->set_flashdata('error', $error['error']);
        redirect($url, 'refresh');
     
     } else {
        $image = $ci->upload->data();
        return $config['upload_path'] . $image['file_name'];
     }
  
     return FALSE;
  
  }

}

/** 
* Load Helper @ $this->load->helper('file_upload')
* Tambahkan Fungsi image_upload($url, $path)
* ###################################
* $url :
* if ($this->agent->is_referral()) {
*      $refer = $this->agent->referrer();
* }
* ###################################
* ###################################
* $path : Lokasi upload file
* ###################################
*
*/