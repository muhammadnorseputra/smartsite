<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class RssFeed extends CI_Controller {
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
          $data['feed_name'] = 'bkpsdm.balangankab.go.id'; // your website
          $data['encoding'] = 'utf-8'; // the encoding
          $data['feed_url'] = base_url('rss'); // the url to your feed
          $data['page_description'] = $profile->meta_desc; // some description
          $data['page_language'] = 'id-ID'; // the language
          $data['creator_email'] = 'bkppdbalangan@gmail.com'; // your email
          $data['creator_name'] = 'BKPSDM Balangan 2023'; // your email
          $data['posts'] = $this->posts->getPosts(null,$kategori);  
          $this->output->set_content_type('application/rss+xml');
          $this->load->view('Frontend/v1/rss', $data);
      }

      public function amp()
      {
          $kategori= isset($_GET['category']) ? $_GET['category'] : 0;
          $profile = $this->mf_beranda->get_identitas();
          $data['feed_name'] = 'bkpsdm.balangankab.go.id'; // your website
          $data['encoding'] = 'utf-8'; // the encoding
          $data['feed_url'] = base_url('rss_amp'); // the url to your feed
          $data['page_description'] = $profile->meta_desc; // some description
          $data['page_language'] = 'id-ID'; // the language
          $data['creator_email'] = 'bkppdbalangan@gmail.com'; // your email
          $data['creator_name'] = 'BKPSDM Balangan 2023'; // your email
          $data['posts'] = $this->posts->getPosts(null,$kategori);  
          $data['pages'] = $this->pages->pageAll();
          $this->output->set_content_type('application/rss+xml');
          $this->load->view('Frontend/v1/rss_amp', $data);
      }

      public function categorys()
      {
          $profile = $this->mf_beranda->get_identitas();
          $data['feed_name'] = 'POST CATEGORY'; // your website
          $data['encoding'] = 'utf-8'; // the encoding
          $data['feed_url'] = base_url('rss_categorys'); // the url to your feed
          $data['page_description'] = $profile->meta_desc; // some description
          $data['page_language'] = 'id-ID'; // the language
          $data['creator_email'] = 'bkppdbalangan@gmail.com'; // your email
          $data['creator_name'] = 'BKPSDM Balangan 2023'; // your email  
          $data['categorys'] = $this->categorys->getAll();
          $this->output->set_content_type('application/rss+xml');
          $this->load->view('Frontend/v1/rss_categorys', $data);
      }

      public function tags()
      {
          $profile = $this->mf_beranda->get_identitas();
          $data['feed_name'] = 'POST TAGS'; // your website
          $data['encoding'] = 'utf-8'; // the encoding
          $data['feed_url'] = base_url('rss_tags'); // the url to your feed
          $data['page_description'] = $profile->meta_desc; // some description
          $data['page_language'] = 'id-ID'; // the language
          $data['creator_email'] = 'bkppdbalangan@gmail.com'; // your email
          $data['creator_name'] = 'BKPSDM Balangan 2023'; // your email  
          $data['tags'] = $this->categorys->get_all_tag();
          $this->output->set_content_type('application/rss+xml');
          $this->load->view('Frontend/v1/rss_tags', $data);
      }
}
?>