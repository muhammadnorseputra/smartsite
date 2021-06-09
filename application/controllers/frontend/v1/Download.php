<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_template_v1/M_f_download','download');
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
			'title' => 'BKPPD &bull; Download',
			'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
			'isi'	=> 'Frontend/v1/pages/download/index',
		];

		$this->load->view('Frontend/v1/layout/wrapper', $data, FALSE);
	}
	public function openurl($key)
	{
		$file = $this->download->info_download($key);
		$count = $file->count;
		$this->download->update_hits($count, $key);
		redirect($file->link,'refresh');
	}
	public function d($key, $title)
	{
		$file = $this->download->info_download($key);
		if($file->type === '.PDF' || $file->type === '.pdf'):
		// jika file pdf, tampilkan previewnya
	    header('Content-type: application/pdf');
	    header('Content-Disposition: inline; filename='.ucwords($file->judul).'.pdf');
	    header('Content-Transfer-Encoding: binary');
	    header('Accept-Ranges: bytes');
	    echo $file->file_blob;
		else:
		// Automatis download tanpa preview
		header("Content-Disposition: attachment; filename=$file->file");
		echo $file->file_blob;
		endif;
		$count = $file->count;
		$this->download->update_hits($count, $key);
	}
	public function ajax_datatable()
	{
		$d_key = $this->input->post('key');
		$pecah = explode(",", $d_key);
		$key = !empty($d_key) ? $pecah : '';
		$list = $this->download->get_datatables($key);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $r):
			$no++;
			$keterangan = $r->keterangan !== '' ? $r->keterangan : '<span class="text-light">Tanpa Keterangan</span>';
			if($r->link !== ''):
				$btn = '<a href="'.base_url('go/'.$r->d_key).'" class="btn btn-info btn-icon-split" title="Open file" target="_blank">
						<span class="mr-2">
						  <i class="fas fa-external-link-alt"></i>
						</span>
						<span class="text">Open File</span>
					  </a>';
			else:
				$btn = '<a href="d/'.$r->d_key.'/'.url_title(strtolower($r->judul)).'" class="btn btn-success btn-icon-split" title="Download" target="_blank">
						<span class="mr-2">
						  <i class="fas fa-download"></i>
						</span>
						<span class="text">Download</span>
					  </a>';
			endif;
			$row = array();
			$row[] = $no;
			$row[] = $r->judul;
			$row[] = "<span class='text-muted small'>".$keterangan."</span>";
			$row[] = "<code>".$r->count."x</code>";
			$row[] = $r->ukuran !== null ? "<code>".byte_format($r->ukuran)."</code>" : '-';
			$row[] = $btn;
			$data[] = $row;
		endforeach;
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->download->count_all($key),
			"recordsFiltered" => $this->download->count_filtered($key),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}