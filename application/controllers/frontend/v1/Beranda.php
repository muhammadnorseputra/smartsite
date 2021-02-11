<?php defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_users', 'mf_users');
        $this->load->model('model_template_v1/M_f_post', 'post');
        $this->load->model('M_b_komentar', 'komentar');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('theme/maintenance_site'),'refresh');
        }
        // Cek session
        // if(!$this->session->userdata('email')) {
        //     redirect(base_url('frontend/v1/users/login'),'refresh');
        // }
    }

    public function index()
    {
        $data = [
                    'title' => "Beranda | Website resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan Tahun ".date('Y'),
                    'isi' => 'Frontend/v1/pages/home',
                    'mf_beranda' => $this->mf_beranda->get_identitas(),
                    'mf_menu' => $this->mf_beranda->get_menu(),
                    'mf_informasi_terbaru' => $this->mf_beranda->get_informasi_terbaru(),
                    'mf_berita_terakhir' => $this->mf_beranda->berita_terakhir(),
                    'mf_berita_pilihan' => $this->mf_beranda->berita_pilihan(),
                    'mf_berita_kategori_1' => $this->mf_beranda->berita_by_kategori(1, 1),
                    'mf_berita_kategori_2' => $this->mf_beranda->berita_by_kategori(2, 2),
                    'mf_album' => $this->mf_beranda->get_listing_album(),
                    'mf_lastvideo' => $this->mf_beranda->get_lastvideo(),
                    'mf_berita_populer' => $this->mf_beranda->berita_populer(),
                    'mf_kategori' => $this->mf_beranda->get_kategori_listing(),
                    'mf_agenda' => $this->mf_beranda->get_agenda_terbaru(),
                    'mf_banner' => $this->mf_beranda->list_banner('SLIDE', 'Web'),
                ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    }

    public function slider()
    {
        $data = [
            'mf_banner' => $this->mf_beranda->list_banner('SLIDE', 'Web'),
        ];
        $this->load->view('Frontend/v1/function/slider3', $data, false);
    }

    public function get_all_berita()
    {
        $output = '';
        $data = $this->mf_beranda->get_all_berita($this->input->post('limit'),$this->input->post('start'));
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $row) {
                if ($row->headline == '1') {
                    $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita, 0, 180); // ambil sebanyak 80 karakter
                    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
                } else {
                    $isi = $row->content;
                }
                $tags = $row->tags;
                $pecah = explode(',', $tags);
                if (count($pecah) > 0) {
                    $tag = '';
                    for ($i = 0; $i < count($pecah); ++$i) {
                        $tag .= '<a href="'.base_url('frontend/v1/post_list/tags?q='.url_title($pecah[$i])).'" class="btn btn-sm btn-outline-secondary mr-2 mb-2">#'.$pecah[$i].'</a>';
                    }
                }
                $pilihan = $row->pilihan == 'Y' ? '<span class="text-success small float-right" data-toggle="tooltip" title="Pilihan Editor"><i class="fas fa-check-circle"></i></span>' : '';

                $by = $row->created_by;
                if($by == 'admin') {
                    $link_profile_public = 'javascript:void(0);';
                    $namalengkap = $this->mf_users->get_namalengkap($by);
                    $namapanggilan = $by;
                    $gravatar = base_url('assets/images/users/'.$this->mf_users->get_gravatar($by));
                } else {
                    $link_profile_public = 
                    base_url("frontend/v1/users/profile/@".decrypt_url( $this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan)."/".encrypt_url($by));
                    $namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($by));
                    $namapanggilan = decrypt_url($this->mf_users->get_userportal_namapanggilan($by)->nama_panggilan);
                    $gravatar = 'data:image/jpeg;base64,'.base64_encode($this->mf_users->get_userportal_byid($by)->photo_pic).'';

                }

                $id = encrypt_url($row->id_berita);
                $postby = strtolower($namalengkap);
                $judul = strtolower($row->judul);
                $posturl = "post/detail/{$postby}/{$id}/".url_title($judul).'';
                
                $btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'btn-bookmark' : '';
                $status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'fas text-primary' : 'far';

                $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'btn-like' : '';
                $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'fas text-danger' : 'far';

                if(empty($row->img)):
                    $img = '<img class="card-img-top lazy border-light" style="border-radius:15px;" data-src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'"/>';
                else:
                    $img = '<img class="card-img-top lazy border-light" style="border-radius:15px;" data-src="'.base_url('files/file_berita/thumb/'.$row->img).'" alt="'.$row->img.'">';
                endif;
                $namakategori = $this->post->kategori_byid($row->fid_kategori);
                $post_list_url = base_url('frontend/v1/post_list/views/' . encrypt_url($row->fid_kategori) . '/' . url_title($namakategori) . '?order=desc');
// <a href="'.$post_list_url.'" class="btn btn-primary-old rounded float-right btn-sm px-3">'.$namakategori.'</a>
                $output .= '
                <div>
					<div class="card mb-4 border-0 shadow-sm bg-white">
					<div class="card-body p-4">
                        <button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="top" class="btn btn-lg btn-transparent border-0 rounded-0 mr-3 p-0 float-right '.$btn_bookmark.'" title="Simpan Postingan" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'. $status_bookmark.' fa-bookmark text-secondary"></i> </button>
                        <img data-src="'.$gravatar.'" alt="photo_pic" width="50" height="50" class="float-left mr-3 d-inline-block rounded lazy">
						<h5 class="card-title"><a href="'.$link_profile_public.'"> '.$namalengkap.'</a></h5>
                        <p class="card-text">
                            <span class="badge badge-default px-0 font-weight-normal text-muted">Posted by <b>'.ucwords($namapanggilan).'</b> &#8226; '.longdate_indo($row->tgl_posting).'</span>
                        </p>
					</div>
                        <div class="canvas p-3 position-relative">
                        <a href="'.$posturl.'" class="rippler rippler-img rippler-bs-info" title="'.$row->judul.'">
						  '.$img.'
                        </a>
                        </div>
					
					<div class="card-body py-0 px-4">
						<h3 class="card-title font-weight-bold"><a href="'.$posturl.'">'.$row->judul.'&nbsp;'.$pilihan.'</a></h3>
                        <p class="card-text font-weight-normal text-secondary">'.character_limiter($isi, 150).'</p>
                        <p><a href="#" class="btn btn-sm btn-warning mr-2 mb-2 text-white shadow">'.$namakategori.'</a>'.$tag. '</p>
					</div>
					<div class="card-footer bg-white p-2 border-0 d-flex justify-content-around"  style="border-bottom-left-radius:12px;border-bottom-right-radius:12px;">
					
                    <div class="w-100">
					<button type="button" data-toggle="tooltip" title="Dilihat" class="btn btn-transparent border-0 rounded p-2 w-100"><i class="far fa-eye mr-2"></i> '.$row->views. '</button>
                    </div>
                    <div class="w-100">
					<button type="button" data-toggle="tooltip" title="Komentar" class="btn btn-transparent border-0 rounded p-2 w-100 text-info"><i class="far fa-comment-alt mr-2"></i> '.$this->komentar->jml_komentarbyidberita($row->id_berita). '</button>
                    </div>
                    <div class="w-100">
                    <button type="button" data-toggle="tooltip" title="Bagikan juga postingan ini" id="btn-share" data-row-id="'.$row->id_berita. '" class="btn btn-transparent  border-0 rounded p-2 w-100 text-success"><i class="fas fa-share-alt mr-2"></i> <span class="share_count">'.$row->share_count. '</span></button>
                    </div>
                    <div class="w-100">
                    <button type="button" onclick="like_toggle(this)" data-toggle="tooltip" class="btn btn-transparent border-0 rounded p-2 w-100 text-danger'.$btn_like.'" title="Suka / Tidak suka" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'.$status_like.' fa-heart mr-2"></i> <span class="count_like">'.$row->like_count.'</span> </button>
                    </div>
					</div>
                    </div>
				</div>
				';
            }
        }
        echo json_encode(['html' => $output, 'status' => 'Oke']);
    }

    public function share_artikel($id)
    {
        return $this->load->view('Frontend/v1/function/share',
                                 ['detail' => $this->mf_beranda->share_detail($id),
                                  'mf_beranda' => $this->mf_beranda->get_identitas(), ]);
    }

    public function share_count_saved($id)
    {
        $count = $this->input->post('count');

        $whr = ['id_berita' => $id];
        $post = ['share_count' => $count];
        $this->mf_beranda->share_count_saved('t_berita', $whr, $post);
        echo json_encode('Success Share'.$id);
    }
    public function likes() 
    {
        $type = $_GET['type'];
        $id_user = $this->input->post('id_a');
        $id_berita = $this->input->post('id_b');
        $post = intval($this->input->post('likes'));

        $set_post = [
            'fid_users_portal' => $id_user,
            'fid_berita'    => $id_berita,
            'tgl_save'  => date('Y-m-d'),
        ];

        $check = $this->mf_beranda->cek_id_berita_like($id_user, $id_berita);
        if (($type == 'like') && ($check->num_rows() == 0)) {
            $db = $this->mf_beranda->likesave('t_berita_like', $set_post);
        } else {
            $id = $this->mf_beranda->get_id_berita_like($id_user, $id_berita);
            $db = $this->mf_beranda->likedelete('t_berita_like', ['id_berita_like' => $id]);
        }

        if ($db == true) {
            $valid = true;
            $this->mf_beranda->update_count_like('t_berita', ['id_berita' => $id_berita], ['like_count' => $post]);
        } else {
            $valid = false;
        }

        echo json_encode($valid);

    }
    public function bookmark()
    {
        $type = $_GET['type'];
        $id_user = $this->input->post('id_a');
        $id_berita = $this->input->post('id_b');
        $post = $this->input->post('post');

        $set_post = [
            'fid_users_portal' => $id_user,
            'fid_berita'    => $id_berita,
            'tgl_save'  => date('Y-m-d'),
            'save'  => $post,
        ];
        $check = $this->mf_beranda->cek_id_berita_save($id_user, $id_berita);
        if(($type == 'on') && ($check->num_rows() == 0)) {
            $db = $this->mf_beranda->bookmarksave('t_berita_save', $set_post);
        } else {
            $id = $this->mf_beranda->get_id_berita_save($id_user, $id_berita);
            $db = $this->mf_beranda->bookmarkupdate('t_berita_save', ['id_berita_save' => $id], ['save' => $post]);
        }

        if($db == true) {
            $valid = true;
        } else {
            $valid = false;
        }

        echo json_encode($valid);
    }

    public function f_login()
    {
        return $this->load->view('Frontend/v1/function/f_login');
    }
    public function f_menus()
    {
        return $this->load->view('Frontend/v1/function/f_menus');
    }    
}