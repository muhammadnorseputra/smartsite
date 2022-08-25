<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_download extends CI_Model
{
	var $table = 't_download'; //nama tabel dari database
    var $column_order = array(null, 'judul', null, null, null); 
    var $column_search = array('judul');
    var $order = array('id_download' => 'desc'); 

    private function _get_datatables_query($key)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('publish', 'Y');
        if(!empty($key)):
        	$this->db->where_in('d_key', $key);
        endif;

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

    function get_datatables($key)
    {
        $this->_get_datatables_query($key);
        if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($key)
    {
        $this->_get_datatables_query($key);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($key)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('publish', 'Y');
        if(!empty($key)):
        	$this->db->where_in('d_key', $key);
        endif;
        return $this->db->count_all_results();
    }
    public function info_download($key)
    {
    	return $this->db->get_where('t_download', ['d_key' => $key])->row();
    }
    public function update_hits($count, $key)
    {
    	$this->db->where('d_key', $key);
    	$this->db->update('t_download', ['count' => $count+1]);
    }
}