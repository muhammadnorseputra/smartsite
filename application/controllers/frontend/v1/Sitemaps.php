<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemaps extends CI_Controller {
      public function __construct()
      {
        parent::__construct();
        $this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('model_template_v1/M_f_post', 'posts');
        $this->load->model('model_template_v1/M_f_halaman', 'pages');
        $this->load->model('model_template_v1/M_f_post_list', 'categorys');
      }

      public function index()
      {
        $kategori= isset($_GET['category']) ? $_GET['category'] : 0;
        $profile = $this->mf_beranda->get_identitas();
        $data = [
          'posts' => $this->posts->getPosts(null,$kategori),
          'pages' => $this->pages->pageAll(),
          'categorys' => $this->categorys->getAll(),
          'tags' => $this->categorys->get_all_tag()
        ];
        $this->output->set_content_type('application/rss+xml');
        $this->load->view('Frontend/v1/sitemaps', $data);
      }
}
