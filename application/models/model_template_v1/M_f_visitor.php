<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_visitor extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->table = 'public_visitor';
        $this->fk_table = 'public_visitor_source';
    }
    public function visitor_view()
    {
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        
        $pengunjunghariini  = $this->db->query("SELECT * FROM public_visitor WHERE date='".$date."' GROUP BY ip")->num_rows(); // Hitung jumlah pengunjung
        $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM public_visitor")->row(); 
        $totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0; // hitung total pengunjung
        $bataswaktu = time() - 400;
        $pengunjungonline  = $this->db->query("SELECT * FROM public_visitor WHERE online > '".$bataswaktu."'")->num_rows(); // hitung pengunjung online
  
        $data = ['jml_hariini' => $pengunjunghariini, 'jml_total_pengunjung' => $totalpengunjung, 'jml_online' => $pengunjungonline];
        return $data;
    }

    public function visitor_source()
    {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = date("H:i:s"); // Time
        $hits = 1;
        $url = curPageURL();
        $query = $this->db->get_where($this->fk_table, ['ip' => $ip, 'date' => $date, 'url' => $url]);
        $query_row = $query->num_rows();
        $row = isset($query_row) ? ($query_row) : 0;
        if($row === 0) {
            $data_insert = ['ip' => $ip, 'url' => $url, 'hits' => $hits, 'date' => $date, 'time' => $waktu];
            $this->db->insert($this->fk_table, $data_insert);
        } else {
            $hits_count = $query->row()->hits;
            $data_where = ['ip' => $ip, 'date' => $date, 'url' => $url];
            $data_update = ['hits' => $hits_count+1];
            $this->db->where($data_where);
            $this->db->update($this->fk_table, $data_update);
        }
    }

    public function visitor_count() {
        $ip    = $this->input->ip_address(); // Mendapatkan IP user
        $date  = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu = time(); //
        $timeinsert = date("Y-m-d H:i:s");
        $browser = $this->agent->browser();
        $browser_version = $this->agent->version();
        $os = $this->agent->platform();
        $hits = 1;

        // Cek berdasarkan IP, apakah user sudah pernah mengakses hari ini
        $s_query = $this->db->query("SELECT * FROM public_visitor WHERE ip='".$ip."' AND date='".$date."'");
        $s = $s_query->num_rows();
        $ss = isset($s)?($s):0;
        // Kalau belum ada, simpan data user tersebut ke database
        if($ss == 0){
        $this->db->query("INSERT INTO public_visitor(ip,browser, browser_version, os, date, hits, online, time) VALUES('".$ip."','".$browser."','".$browser_version."','".$os."','".$date."','".$hits."','".$waktu."','".$timeinsert."')");
        } 
        // Jika sudah ada, update
        else{
        $hits_count = $s_query->row()->hits;
        $this->db->query("UPDATE public_visitor SET hits='".($hits_count+1)."', online='".$waktu."' WHERE ip='".$ip."' AND date='".$date."'");
        }
    }
}