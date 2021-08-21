<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_post_list', 'post_list');
        $this->load->model('model_template_v1/M_f_post', 'post');

        $this->load->library('pagination');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
    }

    public function views($nama_kategori)
    {
        $id_kategori = $this->post_list->idKategoriByNamaKategori($nama_kategori);
        $order = isset($_GET['order']) ? $_GET['order'] : 'desc';

        //konfigurasi pagination
        $config['base_url'] = base_url('frontend/v1/post_list/views/'.$id_kategori.'/'.$nama_kategori.'?order='.$order);
        $config['total_rows'] = $this->post_list->count_all_berita_by_kategori($id_kategori);
        $config['per_page'] = 12;  //show record per halaman
        $config['uri_segment'] = isset($_GET['page']);  // uri parameter
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = round($choice);
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="text-center"><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['start'] = isset($_GET['page']) ? $_GET['page'] : 0;

        // Meta SEO
        $e = array(
          'general' => true, //description, keywords
          'og' => true,
          'twitter'=> true,
          'robot'=> true
        );
        $meta_tag = meta_tags($e, 
                                $title = "Kumpulan Berita - ".ucwords($nama_kategori), 
                                $desc= "Berikut ini kumpulan daftar berita dengan kategori {$nama_kategori} yang terbaru dan terupdate versi web bkppd balangan",
                                $imgUrl = '',
                                $url = curPageURL(), 
                                $keyWords= 'daftar berita, kumpulan berita, berita terbaru, berita balangan, kategori berita, label berita, berita update, berita balangan, habar balangan, info balangan', 
                                $type='website', 
                                $canonical=base_url("k/{$nama_kategori}"), 
                                $urlamp= base_url("amp/blog/{$nama_kategori}"));
        $data = [
            'title' => 'Kumpulan Berita - '.$this->post_list->get_namakategori($id_kategori),
            'isi' => 'Frontend/v1/pages/p_list',
            'uri_id' => $id_kategori,
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'kategoris' => $this->post_list->get_all_kategori(),
            'tags' => $this->post_list->get_all_tag(),
            'posts_by_kategori' => $this->post_list->get_all_berita_by_kategori($id_kategori, $order, $config['per_page'], $data['start']),
            'pagination' => $this->pagination->create_links(),
            'total' => $this->post_list->count_all_berita_by_kategori($id_kategori),
            'meta' => $meta_tag
        ];

        $this->load->view('Frontend/v1/layout/wrapper', $data, false);
    }

    public function tags($tag)
    {
        // Meta SEO
        $e = array(
          'general' => true, //description, keywords
          'og' => true,
          'twitter'=> true,
          'robot'=> true
        );
        $meta_tag = meta_tags($e, 
                                $title = "Kumpulan Berita Berlabel- ".ucwords($tag), 
                                $desc= "Berikut ini kumpulan daftar berita dengan label {$tag} yang terbaru dan terupdate versi web bkppd balangan",
                                $imgUrl = '',
                                $url = curPageURL(), 
                                $keyWords= 'daftar berita, kumpulan berita, berita terbaru, berita balangan, kategori berita, label berita, berita update, berita balangan, habar balangan, info balangan', 
                                $type='website', 
                                $canonical=curPageURL(), 
                                $urlamp= '');

        $data = [
            'title' => 'Kumpulan Berita Berlabel - '.url_title($tag),
            'isi' => 'Frontend/v1/pages/p_tags',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'kategoris' => $this->post_list->get_all_kategori(),
            'tags' => $this->post_list->get_all_tag(),
            'posts_by_tag' => $this->post_list->get_all_berita_by_tag($tag),
            'meta' => $meta_tag
        ];

        $this->load->view('Frontend/v1/layout/wrapper', $data, false);
    }
    
    public function render_html()
    {
        $url = $this->input->get('url');
        $data = getSiteOG($url);
        echo json_encode($data);
    }
}

/* End of file Post_list.php */
/* Location: ./application/controllers/frontend/v1/Post_list.php */
