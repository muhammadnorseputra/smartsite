<?php defined('BASEPATH') or exit('No direct script access allowed');

class Errors extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_post', 'posts');
		$this->site = $this->mf_beranda->get_identitas();
	}

	public function error_404()
	{
		$data = [
			'page' => 'error_404',
			'canonical' => base_url('404'),
			'title' => '404 Page Not Found',
			'content' => 'Frontend/amp/errors/error_404'
		];
		$this->load->view('Frontend/amp/layout/index', $data);
	}
}