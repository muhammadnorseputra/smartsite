<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_b_icons extends CI_Model
{
    public function search($kataicon)
    {
        return $this->db->select('*')->from('ref_icon')->like('nama_icon', $kataicon)->get();
    }

    public function insert_icon($value)
    {
        return $this->db->insert('ref_icon', $value);
    }

    public function geticon()
    {
        return $this->db->order_by('id_icon', 'desc')->get('ref_icon');
    }

    public function proses_update_icon($tbl, $post, $whr)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $post);

        return true;
    }

    public function proses_hapus_icon($tbl, $whr)
    {
        $this->db->where($whr);
        $this->db->delete($tbl);

        return true;
    }
}
