<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_list extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_post_list', 'post_list');

        $this->load->library('pagination');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('theme/maintenance_site'),'refresh');
        }
    }

    public function views($id_kategori, $nama_kategori)
    {
        $order = ($_GET['order']) ? $_GET['order'] : 'desc';

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

        $data = [
            'title' => 'Berita: '.$this->post_list->get_namakategori(decrypt_url($id_kategori)),
            'isi' => 'Frontend/v1/pages/p_list',
            'uri_id' => decrypt_url($id_kategori),
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'kategoris' => $this->post_list->get_all_kategori(),
            'tags' => $this->post_list->get_all_tag(),
            'posts_by_kategori' => $this->post_list->get_all_berita_by_kategori(decrypt_url($id_kategori), $order, $config['per_page'], $data['start']),
            'pagination' => $this->pagination->create_links(),
            'total' => $this->post_list->count_all_berita_by_kategori($id_kategori),
        ];

        $this->load->view('Frontend/v1/layout/wrapper', $data, false);
    }

    public function tags($tag)
    {
        $data = [
            'title' => 'Label: '.url_title($tag),
            'isi' => 'Frontend/v1/pages/p_tags',
            'mf_beranda' => $this->mf_beranda->get_identitas(),
            'mf_menu' => $this->mf_beranda->get_menu(),
            'kategoris' => $this->post_list->get_all_kategori(),
            'tags' => $this->post_list->get_all_tag(),
            'posts_by_tag' => $this->post_list->get_all_berita_by_tag($tag),
        ];

        $this->load->view('Frontend/v1/layout/wrapper', $data, false);
    }
}

/* End of file Post_list.php */
/* Location: ./application/controllers/frontend/v1/Post_list.php */
