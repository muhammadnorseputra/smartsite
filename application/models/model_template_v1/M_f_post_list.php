<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_f_post_list extends CI_Model
{
    public function get_namakategori($id)
    {
        $this->db->select('nama_kategori');
        $this->db->from('t_kategori');
        $this->db->where('id_kategori', $id);
        $q = $this->db->get();
        $r = $q->row();

        return ucwords($r->nama_kategori);
    }
    public function idKategoriByNamaKategori($name)
    {
        $this->db->select('id_kategori');
        $q = $this->db->get_where('t_kategori', ['nama_kategori' => $name])->row();
        return $q->id_kategori;
    }
    public function get_all_kategori()
    {
        return $this->db->get_where('t_kategori', ['aktif' => 'Y']);
    }

    public function get_all_tag()
    {
        return $this->db->get('t_tags');
    }

    public function get_all_berita_by_tag($tags)
    {
        $this->db->select('*');
        $this->db->from('t_berita');
        $this->db->like('tags', $tags);
        $q = $this->db->get();

        return $q;
    }

    public function get_all_berita_by_kategori($id_kategori, $order, $limit, $start)
    {
        $this->db->select('b.*, k.nama_kategori');
        $this->db->from('t_berita AS b');
        $this->db->join('t_kategori as k', 'b.fid_kategori = k.id_kategori');
        $this->db->where('b.fid_kategori', $id_kategori);
        $this->db->order_by('id_berita', $order);
        $this->db->limit($limit, $start);
        $q = $this->db->get();

        return $q;
        // return $this->db->get_where('t_berita', ['fid_kategori' => $id_kategori]);
    }

    public function count_all_berita_by_kategori($id)
    {
        return $this->db->get_where('t_berita', ['fid_kategori' => $id])->num_rows();
    }
}

/* End of file M_f_post_list.php */
/* Location: ./application/models/model_template_v1/M_f_post_list.php */
