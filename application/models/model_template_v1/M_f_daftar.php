<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_f_daftar extends CI_Model {
                        
public function check_email($email){
    $this->db->select('email');
    $q = $this->db->get_where('t_users_portal', ['email' => $email])->row();
    return !empty($q->email);                                
}
                        
public function send_akun($tbl, $data) {
	return $this->db->insert($tbl, $data);
}                         
                        
}
                        
/* End of file model_template_v1/M_f_daftar.php */
    
                        