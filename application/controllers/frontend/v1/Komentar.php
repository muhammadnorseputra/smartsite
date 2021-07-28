<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komentar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('model_template_v1/M_f_komentar', 'komentar');
		$this->load->model('model_template_v1/M_f_users', 'users'); 
        $this->load->model('model_template_v1/M_f_post', 'post');
		//Check maintenance website
        if(($this->session->userdata('status') == 'ONLINE') && ($this->mf_beranda->get_identitas()->status_maintenance == '1') || ($this->mf_beranda->get_identitas()->status_maintenance == '0')) {
            // redirect(base_url('frontend/v1/beranda'),'refresh');
        } else {
            redirect(base_url('under-construction'),'refresh');
        }
	}
	public function index()
	{
		
	}
	public function get_all_komentar()
	{
		$list = $this->komentar->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $k) {
			$active = $k->aktif === 'Y' ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">Unactive</span>';
			// Icon block
			$i = $k->aktif === 'Y' ? "<i class='far fa-eye'></i>" : "<i class='far fa-eye-slash'></i>";
			// Post link detail
			$namalengkap = decrypt_url($this->mf_users->get_userportal_namalengkap($k->fid_users_portal));
            $id = encrypt_url($k->id_berita);
            $postby = strtolower($namalengkap);
            $slug = $this->post->slugByIdBerita($k->fid_berita);
            $kategori = url_title(strtolower($this->post->kategori_byid($k->fid_kategori)));
            $posturl = base_url("p/".$kategori."/".$slug);

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = "<span class='small text-muted'>".$k->id_komentar."</span>";
			$row[] = decrypt_url($k->nama_lengkap)."<br> <span class='small text-muted'>".longdate_indo($k->tanggal)." (".substr($k->waktu,0,5)." Server)</span> <br> <span class='small text-muted'>Reply &bull; ".$this->komentar->user_reply($k->parent_id)."(<b>".$k->parent_id."</b>)</span>";
			$row[] = "<span class='small text-muted'>".$k->isi."</span>";
			$row[] = $active;
			$row[] = "<button type='button' id='balas-komentar' id_berita='".$k->id_berita."' id_user='".$this->session->userdata('user_portal_log')['id']."' id_parent='".$k->id_komentar."' title='Balas Komentar' class='btn btn-sm btn-info btn-circle'><i class='far fa-comment-alt'></i></button>
					 <a href='".$posturl."' type='button' id='post-detail' title='".$k->judul."' class='btn btn-sm btn-dark btn-circle'><i class='fas fa-newspaper'></i></a>
					 <button type='button' id='hapus-komentar' id_komentar='".$k->id_komentar."' title='Hapus' class='btn btn-sm btn-danger btn-circle'><i class='fas fa-trash'></i></button>
					 <button type='button' id='block-komentar' status='".$k->aktif."' id_komentar='".$k->id_komentar."' title='Unactive' class='btn btn-sm btn-light btn-circle'>".$i."</button>";
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->komentar->count_all(),
				"recordsFiltered" => $this->komentar->count_filtered(),
				"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}

	public function detail()
	{
		$d = $this->input->get();
		$id_berita = $d['id_b'];
		$id_parent = $d['id_p'];
		$id_user   = $d['id_u'];

		$db = $this->komentar->detail('t_komentar', $id_parent)->row();
		$data = [
			'judul' => $db->judul,
			'user'  => decrypt_url($db->nama_lengkap),
			'isi'   => $db->isi
		];
		echo json_encode($data);
	}

	public function reply()
	{
		$p = $this->input->post();
		$data = [
			'fid_berita' => $p['id_berita'],
			'parent_id'  => $p['id_parent'],
			'fid_users_portal' => $p['id_user'],
			'isi' => $p['isi'],
			'tanggal' => date('Y-m-d'),
			'waktu' => date('H:i:s'),
			'aktif' => 'Y'
		];
		$db = $this->komentar->reply_send('t_komentar', $data);
		if($db) {
			$msg = true;
		} else {
			$msg = false;
		}
		echo json_encode($msg);
	}

	public function block()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		if($status === 'N'):
			$data = ['aktif' => 'N'];
		else:
			$data = ['aktif' => 'Y'];
		endif;
		$db = $this->komentar->block('t_komentar', ['id_komentar' => $id], $data);
		if($db):
			$msg = true;
		else:
			$msg = false;
		endif;
		echo json_encode($msg);
	}

	public function hapus()
	{
		$id = $this->input->post('id');
		$cek_reply = $this->komentar->cek_reply($id);
		if($cek_reply > 1):
			$db = $this->komentar->hapus('t_komentar', ['parent_id' => $id], ['id_komentar' => $id]);
			if($db)
			{
				$msg = true;
			} else {
				$msg = false;
			}
		$json = json_encode($msg);
		else:
			$db = $this->komentar->hapus('t_komentar', ['parent_id' => null], ['id_komentar' => $id]);
			if($db)
			{
				$msg = true;
			} else {
				$msg = false;
			}
		$json = json_encode($msg);
		endif;

		echo $json;
	}
}