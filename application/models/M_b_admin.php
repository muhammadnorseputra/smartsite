
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_admin extends CI_Model {

    public function getAccess($surename) {
        return $this->db->select('user_access')
                        ->from('t_users')
                        ->where('username', $surename)
                        ->get()->result();
    }

    public function getToken($link) {
        return $this->db->select('token')
                        ->from('t_menu')
                        ->where('link', $link)
                        ->get()->result();
                        
    }

    public function get_v_user($table, $whr)
    {
       return $this->db->get_where($table, $whr); 
    }

    public function listskin($table)
    {
       return $this->db->get($table); 
    }

    public function aktifskin($table,$act)
    {
       $q = $this->db->get_where($table, array('aktif' => $act))->row();
       return $q->color; 
    }
    
    public function aktifskinid($table,$act)
    {
       $q = $this->db->get_where($table, array('aktif' => $act))->row();
       return $q->idskin; 
    }

    public function updatepass($tbl,$whr,$val){
        $this->db->where($whr);
        $this->db->update($tbl,$val);
    }

    public function updateprofileuser($tbl,$whr,$val){
        $this->db->where($whr);
        $this->db->update($tbl,$val);
    }

    public function updateskin($whr,$data,$table){
        $this->db->where($whr);
        $this->db->update($table,$data);
    }
       
    public function updateskin_n($whr,$data,$table){
        $this->db->where($whr);
        $this->db->update($table,$data);
    }
    public function listlabel()
    {
        
        if($this->session->userdata('lvl') == 'USER') {
            $this->db->where('m.user_menu', 'Y');
        }
        
           $q = $this->db->select('m.*, l.nama_label, l.id_label, l.aktif')
                        ->from('ref_label_menu AS l')
                        ->join('t_menu AS m', 'm.fid_label = l.id_label', 'left')
                        ->where('l.aktif', 'Y')
                        ->order_by('l.order, m.order')
                        ->group_by('m.fid_label')
                        ->get();
    
        return $q;
    }

    public function listmenu_jml($label)
    {
        $q = $this->db->get_where('t_menu', array('fid_label' => $label, 'aktif' => 'Y'));
        return $q;
    }

    public function menu($label)
    {
        if($this->session->userdata('lvl') == 'USER') {
			
            $q = $this->db->select('m.*,mod.token')
						  ->from('t_menu AS m')
						  ->join('t_module AS mod', 'mod.id_module=m.fid_module', 'left')
						  ->where(array('m.fid_label' => $label, 'm.aktif' => 'Y', 'm.sts' => 'BACKEND', 'user_menu' => 'Y'))
						  ->order_by('order','asc')
						  ->get();
        } else {
            // $q = $this->db->order_by('order','asc')->get_where('t_menu', array('fid_label' => $label, 'aktif' => 'Y', 'sts' => 'BACKEND'));
            //$q = $this->db->select('m.*,mod.token')->from('t_menu AS m')->join('t_module AS mod', 'mod.id_module=m.fid_module', 'left')->where(array('m.fid_label' => $label, 'm.aktif' => 'Y', 'm.sts' => 'BACKEND'))->order_by('order','asc')->get();
			$q = $this->db->select('m.*,mod.token')
						  ->from('t_menu AS m')
						  ->join('t_module AS mod', 'mod.id_module=m.fid_module', 'left')
						  ->where(array('m.fid_label' => $label, 'm.aktif' => 'Y', 'm.sts' => 'BACKEND'))
						  ->order_by('order','asc')
						  ->get();
		}
        return $q->result();

    }
    public function submenu($primary)
    {
        $this->db->select('sub.*, md.token');
        $this->db->from('t_submenu AS sub');
        $this->db->join('t_module AS md', 'sub.fid_module = md.id_module');
        $this->db->where(array('sub.idmain' => $primary, 'sub.aktif' => 'Y'));
        $this->db->order_by('sub.order','asc');
        return $this->db->get();
    }

    public function count_all_data($tbl) {
        return $this->db->select('*')->from($tbl)->count_all_results();
    }
    
    public function getmoduleuser($user_access) {
        $this->db->select('fid_token');
        $this->db->from('t_users');
        $this->db->where('username', $user_access);
        $q = $this->db->get()->result();
        return $q;
    }
    public function getallmodule() {
        $this->db->select('token');
        $q  = $this->db->get('t_module')->result();
        return $q;
    }
    public function getmodule($nm) {
        $this->db->select('token');
        $this->db->from('t_module');
        $this->db->where('nama_module', $nm);
        $q = $this->db->get()->result();
        return $q[0]->token;
    }  
    public function getmodulebyid($id) {
        $this->db->select('token');
        $this->db->from('t_module');
        $this->db->where('id_module', $id);
        $q = $this->db->get()->result();
        return $q[0]->token;
    }  
    public function getmodulebycontroller($nama_controller) {
        $this->db->select('token');
        $this->db->from('t_module');
        $this->db->where('controller', $nama_controller);
        $q = $this->db->get()->row();
        return $q->token;
    }

    public function cekakses ($token, $ip) {
        $q = $this->db->get_where('ref_access_logregistered', ['token' => $token, 'ip' => $ip, 'block' => 'n']);
        $r = $q->result();
        if($q->num_rows() != 0) {
            if(($r[0]->token != $token) && ($r[0]->ip != $ip)) {
                $sts = false;
            } else {
                $sts = true;
            }
        } else {
            $sts = false;
        }
        return $sts;
    }
    public function getNamaAkses($token) {
        $q = $this->db->get_where('ref_access_logregistered', ['token' => $token, 'block' => 'n']);
        $r = $q->result();
        return $r[0]->name;
    }
}