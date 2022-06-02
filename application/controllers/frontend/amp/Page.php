<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	function __construct()
	{
		parent::__construct();	
        $this->load->model('model_template_v1/M_f_post', 'posts');
        $this->load->model('model_template_v1/M_f_users', 'users'); 
        $this->load->model('model_template_v1/M_f_halaman', 'pages');
		$this->site = $this->mf_beranda->get_identitas();
	}
	public function index()
	{
		$data = [
			'page' => 'home',
			'canonical' => base_url('beranda'),
			'title' => $this->site->site_title,
			'content' => 'Frontend/amp/page/index',
			'pageAll' => $this->pages->pageAll(),
			'keywords' => $this->site->meta_seo,
			'description' => $this->site->meta_desc
		];
		$this->load->view('Frontend/amp/layout/index', $data);
	}
	public function detail($slug)
	{

		$token_halaman = $this->pages->tokenHalamanBySlug($slug);
	    if(intval($token_halaman) == '') {
	      return redirect(base_url('amp/404'));
	    }
	    $title = $this->pages->get_namahalaman($token_halaman).' - BKPPD Balangan';
	    $slug = $this->pages->get_slug_halaman($token_halaman);
	    $detail = $this->pages->get_detail_halaman($token_halaman);
	    $keywords = str_replace('-',',',url_title(strtolower($title)));
	    $description = $this->security->xss_clean(word_limiter(strip_tags($detail->row()->content,100)));
	    // Data
	    $data = [
	      'page' => 'page_detail',
	      'canonical' => base_url("page/{$slug}"),
	      'title' => $title,
	      'slug' => $slug,
	      'keywords' => $keywords,
	      'description' => $description,
	      'content'  => 'Frontend/amp/page/detail',
	      'uri_token_halaman' => $token_halaman,
	      'detail' => $detail
	    ];

	    $this->pages->diakses('t_halaman',$token_halaman, $this->pages->get_viewshalaman($token_halaman));
	    $this->load->view('Frontend/amp/layout/index', $data);
	}
}