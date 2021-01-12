<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_f_users extends CI_Model
{   
    public function get_userportal_byid($id) 
    {
        $this->db->select('*');
        $q = $this->db->get_where('t_users_portal', ['id_user_portal' => $id]);
        if ($q->num_rows() > 0):
            $profile = $q->row();
        else :
            $profile = 'not found';
        endif;
        return $profile;
    }
    public function get_namalengkap($username)
    {
        $this->db->select('nama_lengkap');
        $q = $this->db->get('t_users');
        if($q->num_rows() > 0):
            $r = $q->row();
            $fullname = $r->nama_lengkap;
        else:
            $fullname = 'not found';
        endif;
        return $fullname;
    }
    
    public function get_userportal_namalengkap($id)
    {
        $this->db->select('nama_lengkap');
        $this->db->where('id_user_portal', $id);
        $q = $this->db->get('t_users_portal');
        if ($q->num_rows() > 0) :
            $r = $q->row();
            $fullname = $r->nama_lengkap;
        else :
            $fullname = 'not found';
        endif;
        return $fullname;
    }

    public function get_userportal_namapanggilan($id)
    {
        $this->db->select('nama_panggilan');
        $q = $this->db->get_where('t_users_portal', ['id_user_portal' => $id]);
        if ($q->num_rows() > 0) :
            $lastname = $q->row();
        else :
            $lastname = 'not found';
        endif;
        return $lastname;
    }

    public function get_gravatar($uesrname)
    {
        $this->db->select('gravatar');
        $q = $this->db->get('t_users');
        if ($q->num_rows() > 0) :
            $r = $q->row();
            $photo = $r->gravatar;
        else :
            $photo = 'not found';
        endif;
        return $photo;
    }

    public function verify_email($e) 
    {
        $this->db->where('nohp', $e);
        $this->db->update('t_users_portal', ['email_verifikasi' => 'Y']);
        return true;
    }

    public function status_verify($email) {
        $this->db->select('email_verifikasi');
        $q = $this->db->get_where('t_users_portal', ['email' => $email])->row();
        return $q->email_verifikasi;
    }

    public function check_verify($e) 
    {
        $this->db->select('email_verifikasi, nama_lengkap');
        $q = $this->db->get_where('t_users_portal', ['nohp' => $e]);
        return $q->row();
    }

    public function detail_user($email) {
        $this->db->select('*');
        $q = $this->db->get_where('t_users_portal', ['email' => $email]);
        if ($q->num_rows() > 0) :
            $profile = $q->row();
        else :
            $profile = 'not found';
        endif;
        return $profile;
    }

    public function cek_login($tbl, $whr)
    {
        return $this->db->get_where($tbl, $whr);
    }

    public function status_online($tbl, $whr, $data)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
    }

    public function upload_photo($tbl, $whr, $data)
    {   
        $this->db->where($whr);
        $this->db->update($tbl, $data);
        return true;
    }

    public function update_profile($tbl, $data, $whr)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
        return true;
    }

    var $table = 't_berita_like AS b'; //nama tabel dari database
    var $column_order = array('a.id_berita'); 
    var $column_search = array('a.judul');
    var $order = array('a.id_berita' => 'desc'); 

    private function _get_datatables_query($id)
    {
        $this->db->select('c.*, b.*, a.*');
        $this->db->from($this->table);
        $this->db->join('t_berita AS a', 'b.fid_berita = a.id_berita');
        $this->db->join('t_users_portal AS c', 'a.created_by = c.id_user_portal');
        $this->db->where('b.fid_users_portal', $id);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($id)
    {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($id)
    {
        $this->db->select('b.*, a.*');
        $this->db->from($this->table);
        $this->db->join('t_berita AS a', 'b.fid_berita = a.id_berita');
        $this->db->where('b.fid_users_portal', $id);
        return $this->db->count_all_results();
    }

    public function get_halaman_byid($id)
    {
        return $this->db->get_where('t_halaman', ['fid_users_portal' => $id]);
    }
}

/* End of file M_f_users.php */
/* Location: ./application/models/model_template_v1/M_f_users.php */
