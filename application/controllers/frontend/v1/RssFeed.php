<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class RssFeed extends CI_Controller {
      public function __construct()
      {
        parent::__construct();
        $this->load->helper('xml');
        $this->load->helper('text');
        $this->load->model('model_template_v1/M_f_post', 'posts');
      }

      public function index()
      {
          $kategori= isset($_GET['category']) ? $_GET['category'] : 0;
          $profile = $this->mf_beranda->get_identitas();
          $data['feed_name'] = 'bkppd-balangankab.info'; // your website
          $data['encoding'] = 'utf-8'; // the encoding
          $data['feed_url'] = base_url('rss'); // the url to your feed
          $data['page_description'] = $profile->meta_desc; // some description
          $data['page_language'] = 'id-ID'; // the language
          $data['creator_email'] = 'muhammadnorseputra@gmail.com'; // your email
          $data['creator_name'] = 'BKPPD Balangan'; // your email
          $data['posts'] = $this->posts->getPosts(12,$kategori);  
          $this->output->set_content_type('application/rss+xml');
          $this->load->view('Frontend/v1/rss', $data);
      }
}
?>