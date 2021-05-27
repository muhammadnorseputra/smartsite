<?php defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_template_v1/M_f_users', 'mf_users');
        $this->load->model('model_template_v1/M_f_post', 'post');
        $this->load->model('model_template_v1/M_f_album', 'album');
        $this->load->model('M_b_komentar', 'komentar');
        //Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
        // Cek session
        // if(!$this->session->userdata('email')) {
        //     redirect(base_url('frontend/v1/users/login'),'refresh');
        // }
    }
    public function testing() {
        var_dump(getSiteOG("https://web.bkppd-balangankab.info/post/binainfo/bnNXNmJJZ3hnVG04bTVRTk5vbFJrQT09/ceremonial-penyerahan-penghargaan-bagi-aparatur-sipil-negara-berprestasiberkinerja-terbaik-di-lingkungan-pemerintah-kabupaten-balangan")); //note the incorrect url
    }
    public function index()
    {
        $id = $this->mf_beranda->get_identitas();
        $e = array(
          'general' => true, //description, keywords
          'og' => true,
          'twitter'=> true,
          'robot'=> true
        );
        $meta_tag = meta_tags($e, $title = '', $desc=$id->meta_desc,$imgUrl ='',$url = '',$keyWords=$id->meta_seo,$type='web,blog');
        $data = [
                    'title' => "Beranda &bull; Website Resmi Badan Kepegawaian Pendidikan dan Pelatihan Daerah Kabupaten Balangan",
                    'isi' => 'Frontend/v1/pages/home',
                    'mf_beranda' => $id,
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
                    'mf_poling_pertanyaan' => $this->mf_beranda->get_poling_a()->row(),
                    'mf_poling_jawaban' => $this->mf_beranda->get_poling_b(),
                    'mf_banner' => $this->mf_beranda->list_banner('SLIDE', 'Web'),
                    'meta' => $meta_tag
                ];
        $this->load->view('Frontend/v1/layout/wrapper', $data);
    }

    public function section($section)
    {
        $data = [
                    'mf_beranda' => $this->mf_beranda->get_identitas()
                ];
        $this->load->view('Frontend/v1/function/'.$section, $data);
    }

    public function get_all_berita()
    {
        $output = '';
        $data = $this->mf_beranda->get_all_berita($this->input->post('limit'),$this->input->post('start'));
        if ($data->num_rows() > 0) {
            $no=1;
            foreach ($data->result() as $row) {

                // Tags
                $tags = $row->tags;
                $pecah = explode(',', $tags);
                if (count($pecah) > 0) {
                    $tag = '';
                    for ($i = 0; $i < count($pecah); ++$i) {
                        $tag .= '<a href="'.base_url('tag/'.url_title($pecah[$i])).'" class="btn btn-sm btn-outline-light border-0 mr-1 mb-1">#'.$pecah[$i].'</a>';
                    }
                }

                // Berita pilihan tanda check warna hijau
                $pilihan = $row->pilihan == 'Y' ? '<span class="text-success small float-right" data-toggle="tooltip" title="Pilihan Editor"><i class="fas fa-check-circle"></i></span>' : '';

                // Profile akun yang posting
                $by = $row->created_by;
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

                // Post Link Detail
                $id = encrypt_url($row->id_berita);
                $postby = strtolower(url_title($namalengkap));
                $judul = strtolower($row->judul);
                $posturl = "post/{$postby}/{$id}/".url_title($judul).'';
                
                // Bookmark button
                $btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'btn-bookmark' : '';
                $status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'fas text-primary' : 'far';

                // Like button
                $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'btn-like' : '';
                $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'fas text-danger' : 'far';

                // Post Youtube
                if($row->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$row->content.'&key='.$key;
                    $yt     = api_client($url);
                    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                    $yt_desc = $yt['items'][0]['snippet']['description'];
                    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
                endif;

                // Headline
                if ($row->headline == '1') {
                    $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita, 0, 160); // ambil sebanyak 80 karakter
                    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
                } else {
                    $isi = $row->content;
                }

                // Content
                if($row->type === 'YOUTUBE'):
                    $content = word_limiter($yt_desc,20);
                else:
                    $content = $isi."...";
                endif;

                // Sumber
                if($row->type === 'YOUTUBE'):
                    $sumber = '<div class="text-muted py-2 small"><i class="fab fa-youtube mr-2"></i> <b>'.$yt_src.'</b></div>';
                endif;

                // Gambar
                if(!empty($row->img) && $row->type === 'BERITA'):
                    $img = '<img class="w-100 lazy rounded border-light" data-src="'.base_url('files/file_berita/thumb/'.$row->img).'" alt="'.$row->img.'">';
                elseif($row->type === 'YOUTUBE'):
                    $img = '<img class="w-100 lazy rounded border-light" data-src="'.$yt_thumb.'" alt="'.$row->judul.'">'.$sumber;
                else:
                    $img = '<img class="w-100 lazy rounded border-light" data-src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'"/>';
                endif;

                // Kategori
                $namakategori = $this->post->kategori_byid($row->fid_kategori);
                $post_list_url = base_url('kategori/' . encrypt_url($row->fid_kategori) . '/' . url_title($namakategori) . '?order=desc');
                
                $arr_color = ['btn-primary', 'btn-success', 'btn-info', 'btn-warning', 'btn-danger'];
                $rand = '';
                for($x=0; $x<count($arr_color);$x++):
                    $rand = $arr_color[$no];
                endfor;

                $output .= '
                <div>
					<div class="card mb-4 border bg-white shadow-sm">
					<div class="card-body px-2 mt-2">
                        <button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="top" class="btn btn-lg btn-transparent border-0 rounded-0 mr-3 p-0 float-right '.$btn_bookmark.'" title="Simpan Postingan" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'. $status_bookmark.' fa-bookmark text-secondary"></i> </button>
                        <img data-src="'.$gravatar.'" alt="photo_pic" width="50" height="50" class="float-left mr-3 d-inline-block rounded ml-3 lazy">
						<h5 class="card-title"><a href="'.$link_profile_public.'"> '.$namalengkap.'</a></h5>
                        <p class="card-text">
                            <span class="badge badge-default px-0 font-weight-normal text-muted">Posted by <b>'.ucwords($namapanggilan).'</b> &#8226; '.longdate_indo($row->tgl_posting).'</span>
                        </p>
					</div>

                    <div class="row">
                        <div class="canvas col-12 col-md-6">
                            <a href="'.$posturl.'" class="rippler rippler-img rippler-bs-info px-3 pl-md-4" title="'.$row->judul.'">
                              '.$img.'
                            </a>
                        </div>
                    
                        <div class="col-12 col-md-6">
                            <a href="'.$post_list_url.'" class="btn btn-sm rounded-pill text-white shadow-sm mt-2 mb-2 mt-md-0 mb-md-2 ml-3 ml-md-0 '.$rand.'">&bull; '.$namakategori.'</a>
                            <h4 class="font-weight-bold mx-3 mx-md-0"><a href="'.$posturl.'">'.word_limiter($row->judul, 6).'&nbsp;'.$pilihan.'</a></h4>
                            <p class="card-text font-weight-lighter text-muted my-4 mx-3 mx-md-0">'.$content.'</p>
                            <hr>
                            <p class="px-2 px-md-0">'.$tag. '</p>
                        </div>
                    </div>

					<div class="card-footer bg-transparent p-2 border-0 d-flex justify-content-start">
					
                    <div class="w-100">
					<button type="button" data-toggle="tooltip" title="Dilihat" class="btn btn-transparent border-0 rounded p-2 w-100 text-secondary"><i class="far fa-eye mr-2"></i> '.$row->views. '</button>
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
                $no++;
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
    public function yt_view_video($id) {
        return $this->load->view('Frontend/v1/function/yt_view_video', ['videoId' => $id]);
    }
}