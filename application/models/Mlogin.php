<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {

    public function cek_login($table,$where)
    {
       return $this->db->get_where($table,$where); 
    }

    public function update_session($where, $data)
    {
        $this->db->where($where);
	    $this->db->update('t_users', $data);
    }

    public function last_logon()
    {
        $datemin = date("Y-m-d 00:00:00", strtotime('now'));
        $datemax = date("Y-m-d 23:00:00", strtotime('now'));
        $q = $this->db->query("SELECT * FROM t_users WHERE sesi_logout > '".$datemin."' AND sesi_logout < '".$datemax."' ORDER BY sesi_logout");
        return $q;
    }
    public function get_user_info() {
        $user = $this->db->get('ref_access')->result();
        $col = array();
        foreach($user as $u) {
            $col['data'] = array('os' => $u->os, 'ip' => $u->ip);
        }
        return "<b>".$col['data']['ip']."</b> (".$col['data']['os'].")";
    }
    public function cekip($ip)
    {
        return $this->db->get_where('ref_access_logregistered', ['ip' => $ip])->num_rows();
    }
    public function insertip($data)
    {
        return $this->db->insert('ref_access_logregistered', $data);
    }
    public function updateip($data,$ip)
    {
        $this->db->where('ip', $ip);
        return $this->db->update('ref_access_logregistered', $data);
    }

}