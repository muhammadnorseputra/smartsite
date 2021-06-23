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
        var_dump($post);
    }

}