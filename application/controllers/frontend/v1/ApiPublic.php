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
                    $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
                } else {
                    $link_profile_public = 
                    base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                    $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';
                }

				// Post Data Youtube
                if($r->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$r->content.'&key='.$key;
                    $yt     = api_client($url);
                    $img = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                    $yt_desc = $yt['items'][0]['snippet']['description'];
                    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
                endif;

                if($r->type === 'LINK'):
                    $url = $r->content;
                    $linker = getSiteOG($url);
                    $img = $linker['image'];
                endif;

                if($r->type === 'SLIDE'):
                    $limit_photo = 1;
                    $photo_terkait = $this->post->photo_terkait($r->id_berita, $limit_photo)->row();
                    $img = img_blob($photo_terkait->photo);
                endif;

                if($r->type === 'BERITA'):
                    if(empty($r->img)):
                        $img = base_url('assets/images/noimage.gif');
                    else:
                	   $img = base_url('files/file_berita/'.$r->img);
                    endif;
                endif;

                // Content
                if($r->type === 'YOUTUBE'):
                    $content = word_limiter($yt_desc,25);
                    $by = $yt_src;
                elseif($r->type === 'LINK'):
                    $content = word_limiter($linker['description'],25);
                    $domain = parse_url($r->content, PHP_URL_HOST);
                    $by = $domain;
                else:
                    $content = word_limiter($r->content, 25);
                    $by=ucwords($namalengkap);
                endif;

                // Post Link Detail
                if($r->type === 'YOUTUBE' || $r->type === 'BERITA'):
                    $id = encrypt_url($r->id_berita);
                    $postby = strtolower(url_title($namalengkap));
                    $slug = strtolower($r->slug);
                    $posturl = base_url("blog/{$slug}");
                else:
                    $posturl = base_url('leave?go='.encrypt_url($r->content));
                endif;

				$datas = [
					'id_article' => $r->id_berita,
					'jdl_article' => $r->judul,
					'slug_article' => url_title(strtolower($r->judul)),
					'isi_article' => $content, 
					'img_article' => $img,
					'url_article' => $posturl,
					'tgl_posting_article' => longdate_indo($r->tgl_posting),
					'jml_comments_article' => $this->komentar->jml_komentarbyidberita($r->id_berita),
					'user_posting' => [
						'user_nama' => $by,
                        'user_image' => blob_filename($gravatar),
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
    public function silka_jsonp_get()
    {
        $url = 'http://silka.bkppd-balangankab.info';
        $type = ['asn','pns','nonpns','pensiun'];
        $asn = api_client($url.'/api/get_grap/'.$type[0]);
        $pns = api_client($url.'/api/get_grap/'.$type[1]);
        $nonpns = api_client($url.'/api/get_grap/'.$type[2]);
        $pensiun = api_client($url.'/api/get_grap/'.$type[3]);

        $data = [
            'jml_asn' => nominal($asn),
            'jml_pns' => nominal($pns),
            'jml_nonpns' => nominal($nonpns),
            'jml_pensiun' => nominal($pensiun)
        ];
        return $this->response( $data, 200 );
        // $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        // @file_put_contents('statistik-pegawai.json', $jsonfile);
    }
    public function gpr_get()
    {
        $filter = [
            'start'=> 0, 'limit' => 8, 'type'=>null, 'sort'=>null
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
                    $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
                } else {
                    $link_profile_public = 
                    base_url("user/".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                    $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';
                }

                // Post Data Youtube
                if($r->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$r->content.'&key='.$key;
                    $yt     = api_client($url);
                    $img = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                    $yt_desc = $yt['items'][0]['snippet']['description'];
                    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
                endif;

                if($r->type === 'LINK'):
                    $url = $r->content;
                    $linker = getSiteOG($url);
                    $img = $linker['image'];
                endif;

                if($r->type === 'BERITA'):
                    if(empty($r->img)):
                        $img = base_url('assets/images/noimage.gif');
                    else:
                       $img = base_url('files/file_berita/'.$r->img);
                    endif;
                endif;

                // Content
                if($r->type === 'YOUTUBE'):
                    $content = word_limiter($yt_desc,25);
                    $by = $yt_src;
                elseif($r->type === 'LINK'):
                    $content = word_limiter($linker['description'],25);
                    $domain = parse_url($r->content, PHP_URL_HOST);
                    $by = $domain;
                else:
                    $content = word_limiter($r->content, 25);
                    $by=ucwords($namalengkap);
                endif;

                // Post Link Detail
                if($r->type === 'YOUTUBE' || $r->type === 'BERITA'):
                    $id = encrypt_url($r->id_berita);
                    $postby = strtolower(url_title($namalengkap));
                    $slug = strtolower($r->slug);
                    $posturl = base_url("blog/{$slug}");
                else:
                    $posturl = base_url('leave?go='.encrypt_url($r->content));
                endif;

                $datas = [
                    'id_article' => $r->id_berita,
                    'jdl_article' => $r->judul,
                    'slug_article' => url_title(strtolower($r->judul)),
                    // 'isi_article' => $content, 
                    'img_article' => $img,
                    'url_article' => $posturl,
                    'tgl_posting_article' => longdate_indo($r->tgl_posting),
                    // 'jml_comments_article' => $this->komentar->jml_komentarbyidberita($r->id_berita),
                    'user_posting' => [
                        'user_nama' => $by,
                        // 'user_image' => blob_filename($gravatar),
                        // 'user_link' => $link_profile_public
                    ]
                ];

                $rs[] = $datas;
            endforeach;
            $json = $rs;
            // $jsonfile = json_encode($json, JSON_PRETTY_PRINT);
            // @file_put_contents('gpr.json', $jsonfile);
            return $this->response( $json, 200 );
            
        else:
            return $this->response( [
                    'status' => false,
                    'message' => 'No article were found'
                ], 404 );
        endif;
    }
}