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
            $lastname = 'admin';
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

    public function cek_login($tbl, $whr, $nohp)
    {
        return $this->db->where($whr)->where($nohp)->get($tbl);
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

    public function getsubmenu() {
        $this->db->select('a.idsub, a.nama_sub, a.link_sub');
        $this->db->from('t_submenu AS a');
        $this->db->join('t_menu AS b', 'a.idmain = b.id_menu');
        $this->db->where('b.sts', 'FRONTEND');
        // $this->db->where('a.aktif', 'Y');
        $q = $this->db->get();
        return $q;
    }

    public function getlinkbyid($id) {
        $this->db->select('link_sub');
        $this->db->from('t_submenu');
        $this->db->where('idsub', $id);
        $q = $this->db->get();
        return $q;
    }

    public function getjudulhalamanbytoken($token) {
        $this->db->select('title');
        $this->db->from('t_halaman');
        $this->db->where('token_halaman', $token);
        $q = $this->db->get();
        return $q;
    }

    public function updatelinkhalaman($tbl, $post, $whr) {
        $this->db->where($whr);
        $this->db->update($tbl, $post);
        return true;
    }

    public function getuserportalbyemail($mail) {
        $this->db->select('id_user_portal, email, nama_lengkap, nohp, online, token_verifikasi');
        $this->db->from('t_users_portal');
        $this->db->where('email', $mail);
        $q = $this->db->get();
        return $q;
    }

    public function do_reset_password($tbl, $data, $whr) {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
        return true;
    }
    public function hapus_akun($tbl, $whr) {
        $this->db->where($whr);
        $this->db->delete($tbl);
        return true;
    }
    
    public function get_mainmenu()
    {
        return $this->db->where('aktif','Y')->where('sts','FRONTEND')->where('link','#')->get('t_menu');
    }

    public function karegori_saran() 
    {
        $this->db->select('kategori');
        $this->db->from('public_saran');
        $q = $this->db->get();
        return $q;
    }

    public function update_token($tbl, $data, $whr)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
        return true;
    }

    public function userlist()
    {
        $this->db->select('photo_pic,nama_lengkap,nama_panggilan,role,id_user_portal,online,tanggal_bergabung');
        return $this->db->get('t_users_portal');
    }

    public function userpopuler()
    {
        $this->db->select('u.id_user_portal, u.nama_lengkap, u.photo_pic');
        $this->db->from('t_users_portal AS u');
        $this->db->join('t_berita AS b', 'b.created_by = u.id_user_portal');
        $this->db->group_by('u.id_user_portal');
        $q = $this->db->get();
        return $q;
    }

    public function total_berita_by_user($id)
    {
        return $this->db->get_where('t_berita', ['created_by' => $id]);
    }
    public function total_comment_by_user($id)
    {
        return $this->db->get_where('t_komentar', ['fid_users_portal' => $id]);
    }
    public function total_statis_by_user($id)
    {
        return $this->db->get_where('t_halaman', ['fid_users_portal' => $id]);
    }
    var $table_userportal = 't_users_portal'; //nama tabel dari database
    var $column_order_userportal = array('id_user_portal', null); 
    var $column_search_userportal = array('nama_lengkap','nama_panggilan');
    var $order_userportal = array('id_user_portal' => 'desc'); 

    private function _get_datatables_query_userlist()
    {
        $this->db->select('*');
        $this->db->from($this->table_userportal);
        $i = 0;

        foreach ($this->column_search_userportal as $item) // looping awal
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

                if (count($this->column_search_userportal) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_userportal[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_userportal)) {
            $order = $this->order_userportal;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_userlist()
    {
        $this->_get_datatables_query_userlist();
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_userlist()
    {
        $this->_get_datatables_query_userlist();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_userlist()
    {
        $this->db->select('*');
        $this->db->from($this->table_userportal);
        return $this->db->count_all_results();
    }

  public function cari_kata($word) 
  {
    // return $this->db->like('word', $word)->get('t_badwords');
    $this->db->select('word');
    $this->db->from('t_badwords');
    $this->db->where('word', $word);
    $q = $this->db->get();
    return $q;
  }

}

/* End of file M_f_users.php */
/* Location: ./application/models/model_template_v1/M_f_users.php */
