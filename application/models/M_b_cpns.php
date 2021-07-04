<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_b_cpns extends CI_Model
{
    public $table = 'cpns_jadwaltes';
    public $select_colums = array('*');
    public $order_colums = array('nopeserta', 'nik', 'nama', 'lokasi_tes', 'tgl_tes', 'waktu_tes', 'ruangan_tes');
    public $column_search = array('nopeserta', 'nik', 'nama');

    public function datatable()
    {
        $this->db->select($this->select_colums);
        $this->db->from($this->table);

        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if (!empty($_POST['search']['value'])) { // if datatable send POST for search
            if ($i === 0) { // first loop
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            } else {
                $this->db->or_like($item, $_POST['search']['value']);
            }

                if (count($this->column_search) - 1 == $i) { //last loop
                    $this->db->group_end();
                } //close bracket
            }
            ++$i;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_colums[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('nopeserta', 'desc');
        }
    }

    public function fetch_datatable_jadwaltes()
    {
        $this->datatable();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function get_filtered_datatable_jadwaltes()
    {
        $this->datatable();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_datatable_jadwaltes()
    {
        if (!empty($_POST['search']['value'])) {
            $this->db->like('nopeserta', $_POST['search']['value']);
        }
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function insert_jadwaltes($data)
    {
        $this->db->insert_batch('cpns_jadwaltes', $data);

        return true;
    }

    public function doEmptyTable($tbl)
    {
        $this->db->empty_table($tbl);

        return true;
    }

    public $table2 = 'cpns_hasilverifikasi';
    public $select_colums2 = array('*');
    public $order_colums2 = array('nopeserta', 'nik', 'nama', 'jnskel', 'jabatan', 'pendidikan');
    public $column_search2 = array('nopeserta', 'nik', 'nama');

    public function datatable2()
    {
        $this->db->select($this->select_colums2);
        $this->db->from($this->table2);

        $i = 0;
        foreach ($this->column_search2 as $item) { // loop column
            if (!empty($_POST['search']['value'])) { // if datatable send POST for search
            if ($i === 0) { // first loop
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            } else {
                $this->db->or_like($item, $_POST['search']['value']);
            }

                if (count($this->column_search2) - 1 == $i) { //last loop
                    $this->db->group_end();
                } //close bracket
            }
            ++$i;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order_colums2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('nopeserta', 'desc');
        }
    }

    public function fetch_datatable_hasilverifikasi()
    {
        $this->datatable2();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function get_filtered_datatable_hasilverifikasi()
    {
        $this->datatable2();
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function get_all_datatable_hasilverifikasi()
    {
        if (!empty($_POST['search']['value'])) {
            $this->db->like('nopeserta', $_POST['search']['value']);
        }
        $this->db->select('*');
        $this->db->from($this->table2);
        $query = $this->db->count_all_results();

        return $query;
    }

    public function insert_hasilverifikasi($data)
    {
        $this->db->insert_batch('cpns_hasilverifikasi', $data);

        return true;
    }

    public function hasilverifikasi_byid($tbl, $id)
    {
        return $this->db->get_where($tbl, ['nik' => $id]);
    }

    public function hapus_hasilverifikasi_byid($tbl, $id)
    {
        $this->db->where($id);
        $this->db->delete($tbl);

        return true;
    }
}
