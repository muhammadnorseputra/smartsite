<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SkmIndex extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function index()
    {
        $data = [
            'title' => 'IKM - BKPPD Kab. Balangan',
            'content' => 'Frontend/skm/index'
        ];
        $this->load->view('Frontend/skm/layout/app', $data);
    }

    public function survei()
    {
        $card = $this->input->get('card');
        $title = 'Survei - BKPPD Kab. Balangan';
        if($card === 'asn_balangan'):
        $data = [
            'title' => $title,
            'content' => 'Frontend/skm/pages/survei_asn_balangan',
            'pertanyaan' => $this->skm->skm_pertanyaan(),
            'jenis_layanan' => $this->skm->skm_jenis_layanan(),
            'pendidikan' => $this->skm->skm_pendidikan(),
            'pekerjaan' => $this->skm->skm_pekerjaan(),
            'nomor' => generateRandomString(7)
        ];  
        elseif($card === 'non_asn_balangan'):
        $data = [
            'title' => $title,
            'content' => 'Frontend/skm/pages/survei_non_asn_balangan',
            'pertanyaan' => $this->skm->skm_pertanyaan(),
            'jenis_layanan' => $this->skm->skm_jenis_layanan(),
            'pendidikan' => $this->skm->skm_pendidikan(),
            'pekerjaan' => $this->skm->skm_pekerjaan(),
            'nomor' => generateRandomString(7)
        ];  
        else:
        $data = [
            'title' => $title,
            'content' => 'Frontend/skm/pages/survei',
        ];  
        endif;
        $this->load->view('Frontend/skm/layout/app', $data);
    }
}