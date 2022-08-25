<?php defined('BASEPATH') or exit('No direct script access allowed');
class ErrorRequest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->load->view('errors/html/error_404', ['message' => 'Apa yang terjadi ?']);
    }
}