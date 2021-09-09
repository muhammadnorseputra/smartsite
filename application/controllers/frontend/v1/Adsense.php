<?php defined('BASEPATH') or exit('No direct script access allowed');

class Adsense extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Adsense Prop',
            'isi' => 'Frontend/v1/pages/adsense/index',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'mf_beranda' => $this->mf_beranda->get_identitas(),
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    }

    public function page($num, $date) 
    {
        $data = [
            'title' => decrypt_url($num).' - Adsense Prop',
            'isi' => 'Frontend/v1/pages/adsense/page',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'pagenum' => decrypt_url($num),
            'pagedate' => decrypt_url($date)
        ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);        
    }
}