<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SkmProses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('skm');
    }

    public function index()
    {
        $post = $this->input->post();
        $token_verify = '@270599bkppd_balangan_'.date('dmYH');
        $token = decrypt_url($post['token_']);
        if(!empty($token) && ($token === $token_verify)):
            $msg = ['msg' => 'Token Valid', 'status' => true, 'redirectTo' => base_url('finish/'.encrypt_url($post['nomor']))];
        else:
            $msg = ['msg' => 'Invalid Token', 'status' => false];
        endif;
        echo json_encode($msg);
    }

    public function selesai($nomor)
    {
        $no = decrypt_url($nomor);
        $cek_nomor = $this->skm->ceknomor($no)->num_rows();
        $data = [
            'title' => 'Finish - Survei telah selesai.',
            'content' => 'Frontend/skm/pages/survei_selesai',
            'nomor' => $nomor
        ];  

        if(!empty($nomor)):
            $this->load->view('Frontend/skm/layout/app', $data);
        else:
            exit(redirect(base_url('survei?msg=NotFound'),'refresh'));
        endif;

    }

}