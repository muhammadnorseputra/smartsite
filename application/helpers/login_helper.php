<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('_is_logged_in')) {
  function _is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $status   = $CI->session->userdata('status');
    $iduser   = $CI->session->userdata('userkey');
		$username = $CI->session->userdata('user');
    $code     = str_shuffle($CI->session->userdata('user_access'));
		
    $data = array(      
			'status' => 'OFFLINE',
			'user_access' => $code
		);

    $where = array(
			'username' => $username,
			'id_user' => $iduser
    );

    if ((!isset($username)) && ($status != 'ONLINE')) { 
      $CI->session->unset_userdata($username);		
		  $CI->session->sess_destroy();
      // update status user OFFLINE
      $CI->db->where($where);
      $CI->db->update('t_users', $data);
      redirect(base_url("login"));
    }
    return;
  }
}
?>