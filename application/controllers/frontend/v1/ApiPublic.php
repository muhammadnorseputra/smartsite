<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class ApiPublic extends RestController {

	public function __construct()
	{
		parent::__construct();
		//Check maintenance website
        $this->load->model('model_template_v1/M_f_post', 'post');
        $this->load->model('model_template_v1/M_f_users', 'mf_users');
        $this->load->model('M_b_komentar', 'komentar');
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}

	public function article_get()
	{
		$filter = [
			'start'=> 0, 'limit' => 3, 'type'=>null, 'sort'=>null
		];
		$data = $this->mf_beranda->get_all_berita($filter['limit'],$filter['start'],$filter['type'],$filter['sort']);
		if ($data->num_rows() > 0):
			$row = $data->result();
			foreach($row as $r):
				$by = $r->created_by;
                if($by == 'admin') {
                    $link_profile_public = 'javascript:void(0);';
                    $namalengkap = $this->mf_users->get_namalengkap($by);
                    $namapanggilan = $by;
                } else {
                    $link_profile_public = 
                    base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                }

				// Post Data Youtube
                if($r->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$r->content.'&key='.$key;
                    $yt     = api_client($url);
                    $img = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                endif;

                if($r->type === 'LINK'):
                    $url = $r->content;
                    $linker = getSiteOG($url);
                    $img = $linker['image'];
                endif;

                if($r->type === 'BERITA'):
                	$img = base_url('files/file_berita/'.$r->img);
                endif;

                // Post Link Detail
                if($r->type === 'YOUTUBE' || $r->type === 'BERITA'):
                    $id = encrypt_url($r->id_berita);
                    $postby = strtolower(url_title($namalengkap));
                    $judul = strtolower($r->judul);
                    $posturl = base_url("post/{$postby}/{$id}/".url_title($judul).'');
                else:
                    $posturl = base_url('leave?go='.encrypt_url($r->content));
                endif;

				$datas = [
					'id_article' => $r->id_berita,
					'jdl_article' => $r->judul,
					'isi_article' => word_limiter($r->content, 25), 
					'img_article' => $img,
					'url_article' => $posturl,
					'tgl_posting_article' => longdate_indo($r->tgl_posting),
					'jml_comments_article' => $this->komentar->jml_komentarbyidberita($r->id_berita),
					'user_posting' => [
						'user_nama' => $namapanggilan,
						'user_link' => $link_profile_public
					]
				];

				$rs[] = $datas;
			endforeach;
			$json = $rs;
        	return $this->response( $json, 200 );
		else:
			return $this->response( [
	                'status' => false,
	                'message' => 'No article were found'
	            ], 404 );
		endif;
	}

}