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
        $url = base_url('beranda?id=123&media=id');
        $parse = parse_url($url, PHP_URL_SCHEME);
        var_dump(parse_str($_SERVER['QUERY_STRING'], $_GET));
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
        $meta_tag = meta_tags($e, $desc=$id->meta_desc,$imgUrl = base_url('assets/images/logo.png'),$url = base_url('beranda'),$keyWords=$id->meta_seo,$type='web');
        $data = [
                    'title' => "Homepage - BKPPD Balangan ". date('Y'),
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
                    'mf_banner_home' => $this->mf_beranda->list_banner('BANNER', 'Aside', 0, 5),
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

    function template_sumber($text, $icon) {
        $html = '<div class="btn-group btn-group-sm mb-2 ml-3 ml-md-0" role="group" aria-label="button">
                    <button type="button" class="btn btn-sm btn-light" disabled>'.$icon.'</button>
                    <button type="button" class="btn btn-sm btn-light"  disabled>'.$text.'</button>
                </div>';
        return $html;
    }

    function template_photo_terkait_sisa($total) {
        if($total>0):
        $html = '<div class="btn-group btn-group-sm mb-2 ml-3 ml-md-0" role="group" aria-label="button">
                            <button type="button" class="btn btn-sm btn-light" disabled><i class="fas fa-images"></i></button>
                            <button type="button" class="btn btn-sm btn-light"  disabled>+ '.$total.'</button>
                        </div>';
        else:
            $html = '';
        endif;
        return $html;
    }

    public function get_all_berita()
    {
        $limit = $this->input->post('limit');
        $start = $this->input->post('start');
        $type  = $this->input->post('type');
        $sort  = $this->input->post('sort');
        $output = '';
        $data = $this->mf_beranda->get_all_berita($limit,$start,$type,$sort);
        if ($data->num_rows() > 0) {
            $no=1;
            foreach ($data->result() as $row) {

                // Tags
                $tags = $row->tags;
                $pecah = explode(',', $tags);
                    $tag = '';
                    for ($i = 0; $i < count($pecah); $i++) {
                        if (count($pecah) > 0) {
                            $tag .= '<a href="'.base_url('tag/'.url_title($pecah[$i])).'" class="btn btn-sm btn-outline-light mr-1 mb-1">#'.$pecah[$i].'</a>';
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
                if($row->type === 'YOUTUBE' || $row->type === 'BERITA' || $row->type === 'SLIDE'):
                    $id = encrypt_url($row->id_berita);
                    $postby = strtolower(url_title($namalengkap));
                    $judul = strtolower($row->judul);
                    $posturl = "post/{$postby}/{$id}/".url_title($judul).'';
                elseif($row->type === 'LINK'):
                    $posturl = base_url('leave?go='.encrypt_url($row->content));
                endif;
                
                // Bookmark button
                $btn_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'btn-bookmark' : '';
                $status_bookmark = $this->mf_beranda->get_status_bookmark($this->session->userdata('user_portal_log')['id'], $row->id_berita) == 'on' ? 'fas text-primary' : 'far';

                // Like button
                $btn_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'btn-like' : '';
                $status_like = $this->mf_beranda->get_status_like($this->session->userdata('user_portal_log')['id'], $row->id_berita) == true ? 'fas text-danger' : 'far';

                // Post Data Youtube
                if($row->type === 'YOUTUBE'):
                    $key      = $this->config->item('YOUTUBE_KEY'); // TOKEN goole developer
                    $url      = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,statistics&id='.$row->content.'&key='.$key;
                    $yt     = api_client($url);
                    $yt_thumb = $yt['items'][0]['snippet']['thumbnails']['high']['url'];
                    $yt_desc = $yt['items'][0]['snippet']['description'];
                    $yt_src = $yt['items'][0]['snippet']['channelTitle'];
                endif;

                if($row->type === 'LINK'):
                    $url = $row->content;
                    $linker = getSiteOG($url);
                    // var_dump($linker);
                endif;

                // Headline
                if ($row->headline == '1') {
                    $isi_berita = strip_tags($row->content); // membuat paragraf pada isi berita dan mengabaikan tag html
                    $isi = substr($isi_berita, 0, 195); // ambil sebanyak 80 karakter
                    $isi = substr($isi_berita, 0, strrpos($isi, ' ')); // potong per spasi kalimat
                } else {
                    $isi = $row->content;
                }

                // Content
                if($row->type === 'YOUTUBE'):
                    $content = word_limiter($yt_desc,20);
                elseif($row->type === 'LINK'):
                    $content = word_limiter($linker['description'],15);
                else:
                    $content = $isi."...";
                endif;

                // Sumber
                if($row->type === 'YOUTUBE'):
                    $status_posted = '<abbr title="Repost adalah diposting ulang atau ditampilkan kembali, berdasarkan sumber tertentu.">Repost</abbr>';
                    $text = $yt_src;
                    $icon = '<i class="fab fa-youtube"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                elseif($row->type === 'LINK'):
                    $domain = parse_url($row->content, PHP_URL_HOST);
                    $status_posted = '<abbr title="Repost adalah diposting ulang atau ditampilkan kembali, berdasarkan sumber tertentu.">Repost</abbr>';
                    $text = $domain;
                    $icon = '<i class="fas fa-link"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                else:
                    $domain = parse_url(base_url(), PHP_URL_HOST);
                    $status_posted = 'Posted';
                    $text = $domain;
                    $icon = '<i class="fas fa-globe-asia"></i>';
                    $sumber = $this->template_sumber($text, $icon);
                endif;

                // Gambar
                if($row->type === 'BERITA'):
                    if(!empty($row->img)):
                        $img = '<img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="'.files('file_berita/'.$row->img).'" alt="'.$row->judul.'">';
                    elseif(!empty($row->img_blob)):
                        $img = '<img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="data:image/jpeg;base64,'.base64_encode( $row->img_blob ).'" alt="'.$row->judul.'"/>';
                    else:
                        $img = '<img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$row->judul.'">';
                    endif;
                elseif($row->type === 'YOUTUBE'):
                    $img = ' <div class="position-relative">
                        <img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="'.$yt_thumb.'" alt="'.$row->judul.'"> 
                        <div class="text-center position-absolute text-white w-100 h-100" style="left: 0;top: 40%;">
                            <i class="far fa-play-circle fa-4x bg-primary rounded-circle"></i>
                        </div>
                        </div>';
                elseif($row->type === 'LINK'):
                    $img = '<img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="'.$linker['image'].'" alt="'.$row->judul.'">';
                else:
                    $img = '<img style="height:260px; object-fit: cover;" class="w-100 lazy rounded border-light" data-src="'.base_url('assets/images/noimage.gif').'" alt="'.$row->judul.'">';
                endif;

                // gambar terkait
                $limit_photo = 4;
                $photo_terkait = $this->post->photo_terkait($row->id_berita, $limit_photo);
                $total_photo_terkait =  $this->post->photo_terkait($row->id_berita)->num_rows();
                $total_sisa = $total_photo_terkait - $photo_terkait->num_rows();
                $photo_terkait_sisa = $this->template_photo_terkait_sisa($total_sisa);
                $photo_t = '';
                if($photo_terkait->num_rows() > 0):
                    foreach($photo_terkait->result() as $p):
                        $photo_t .= '<li class="flex-grow-1 flex-shrink-1">
                                        <img class="lazy w-100" data-src="'.img_blob($p->photo).'" alt="'.$p->judul.'" style="object-fit: cover;height:140px;"/>
                                    </li>';
                    endforeach;
                endif;

                // Kategori
                $namakategori = $this->post->kategori_byid($row->fid_kategori);
                $post_list_url = base_url('kategori/' . encrypt_url($row->fid_kategori) . '/' . url_title($namakategori) . '?order=desc');
                
                $arr_color = ['text-primary', 'text-success', 'text-info', 'text-warning', 'text-danger', 'text-default', 'text-dark'];
                $rand = '';
                for($x=0; $x<count($arr_color);$x++):
                    $rand = $arr_color[$no];
                endfor;

                if($row->type === 'YOUTUBE' || $row->type === 'BERITA' || $row->type === 'LINK'):
                $content_body = '<div class="row">
                                    <div class="col-12 col-md-10 offset-md-2 pl-md-0">
                                        <div class="canvas pr-md-4 pl-md-0 pr-1 pl-1 mb-2">
                                        <a href="'.$posturl.'" class="rippler rippler-img rippler-bs-info" title="'.$row->judul.'">
                                          '.$img.'
                                        </a>
                                        </div>
                                        '.$sumber.'
                                        <div class="btn-group btn-group-sm mb-2 ml-3 ml-md-0" role="group" aria-label="button">
                                            <button type="button" class="btn btn-sm btn-light" disabled><i class="fas fa-tag"></i></button>
                                            <a href="'.$post_list_url.'" class="btn btn-sm btn-light '.$rand.'">'.$namakategori.'</a>
                                        </div>
                                        <div class="mx-3 mx-md-0 pr-md-4 mt-md-3">
                                            <h4 class="font-weight-bold"><a href="'.$posturl.'">'.word_limiter($row->judul, 8).'&nbsp;'.$pilihan.'</a></h4>
                                            <p class="card-text font-weight-lighter text-muted my-2">'.$content.'</p>
                                            <p class="text-secondary">'.$tag. '</p>
                                        </div>
                                    </div>
                                </div>';
                else:
                $content_body = '
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-2 pl-md-0">
                    <a href="'.$posturl.'" class="rippler rippler-img rippler-bs-info" title="'.$row->judul.'">
                        <ul class="d-flex flex-wrap list-unstyled rounded overflow-hidden border ml-3 mr-3 ml-md-0 mr-md-4">
                                '.$photo_t.'
                        </ul>
                            </a>
                        '.$photo_terkait_sisa.'
                        '.$sumber.'
                        <div class="btn-group btn-group-sm mb-2 ml-3 ml-md-0" role="group" aria-label="button">
                            <button type="button" class="btn btn-sm btn-light" disabled><i class="fas fa-tag"></i></button>
                            <a href="'.$post_list_url.'" class="btn btn-sm btn-light '.$rand.'">'.$namakategori.'</a>
                        </div>
                        
                        <div class="mx-3 mx-md-0 pr-md-4 mt-md-3">
                            <h4 class="font-weight-bold"><a href="'.$posturl.'">'.word_limiter($row->judul, 8).'&nbsp;'.$pilihan.'</a></h4>
                            <p class="card-text font-weight-lighter text-muted my-2">'.$content.'</p>
                            <p class="text-secondary">'.$tag. '</p>
                        </div>
                    </div>
                </div>
                ';
                endif;

                $output .= '
                <div>
					<div class="card border border-light bg-white mb-3 mb-md-0">
					<div class="card-body px-2">
                        <button type="button" onclick="bookmark_toggle(this)" data-toggle="tooltip" data-placement="top" class="btn btn-lg btn-transparent border-0 rounded-0 mr-3 p-0 float-right '.$btn_bookmark.'" title="Simpan Postingan" data-id-berita="' . $row->id_berita . '" data-id-user="' . $this->session->userdata('user_portal_log')['id'] . '"><i  class="'. $status_bookmark.' fa-bookmark text-secondary"></i> </button>
                        <img data-src="'.$gravatar.'" alt="Photo Userportal" width="55" height="55" class="float-left mr-3 d-inline-block rounded ml-3 lazy">
						<h6 class="card-title mb-0 pb-2"><a href="'.$link_profile_public.'"> '.$namalengkap.'</a></h6>
                        <p class="card-text">
                            <span class="px-0 font-weight-normal text-muted small">'.$status_posted.' by <b>'.ucwords($namapanggilan).'</b> &#8226; '.longdate_indo($row->tgl_posting).'</span>
                        </p>
					</div>
                    
                    '.$content_body.'

					<div class="card-footer bg-transparent p-2 border-top d-flex justify-content-start">
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
                <div class="devider-line d-none d-md-block"></div>
				';
                $no++;
            }
        }
        echo json_encode(['html' => $output, 'count' => $data->num_rows(), 'status' => 'Oke']);
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