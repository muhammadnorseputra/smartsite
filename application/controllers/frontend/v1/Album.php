<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_album', 'album');
	}
	public function detail($id)
	{
		$id_album = decrypt_url($id);
		$data = [
			'title' => 'album | '.url_title($this->album->judul_album_by_id($id_album), '-', true),
			'photos' => $this->album->photos($id_album),
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/album_detail',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
}