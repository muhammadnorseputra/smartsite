<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_beranda extends CI_Model
{
    public function get_identitas()
    {
        return $this->db->get('t_pengaturan')->row();
    }

    public function list_banner($jns_banner, $posisi)
    {
        $this->db->select('t_banner.*, ref_jns_banner.jenis');
        $this->db->from('t_banner');
        $this->db->join('ref_jns_banner', 't_banner.fid_jns_banner = ref_jns_banner.id_jns_banner');
        $this->db->where(['t_banner.publish' => 'Y',
                          'ref_jns_banner.jenis' => $jns_banner,
                          'ref_jns_banner.posisi' => $posisi, ]);
        $this->db->order_by('t_banner.id_banner', 'desc');
        $q = $this->db->get();

        return $q;
    }

    public function get_banner($jns_banner, $posisi)
    {
        $this->db->select('t_banner.*, ref_jns_banner.jenis');
        $this->db->from('t_banner');
        $this->db->join('ref_jns_banner', 't_banner.fid_jns_banner = ref_jns_banner.id_jns_banner');
        $this->db->where(['t_banner.publish' => 'Y',
                          'ref_jns_banner.jenis' => $jns_banner,
                          'ref_jns_banner.posisi' => $posisi, ]);
        $this->db->order_by('t_banner.id_banner', 'desc');
        $this->db->limit(1, 0);
        $this->db->group_by('t_banner.id_banner');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $b = $q->row();
            $data = [$b->path, $b->judul, $b->url, $b->upload_by, $b->gambar, encrypt_url($b->id_banner)];
            return $data;
        }
    }

    public function get_menu()
    {
        $this->db->select('menu.id_menu, menu.nama_menu, menu.link, menu.color, menu.fid_icon');
        $this->db->from('t_menu AS menu');
        $this->db->where('menu.aktif', 'Y');
        $this->db->where('menu.sts', 'FRONTEND');
        $this->db->order_by('menu.order', 'asc');
        $q = $this->db->get();

        return $q->result();
    }

    public function get_submenu($id_menu)
    {
        $this->db->select('submenu.idsub, submenu.nama_sub, submenu.link_sub, submenu.fid_idsub');
        $this->db->from('t_submenu AS submenu');
        $this->db->join('t_menu AS menu', 'submenu.idmain = menu.id_menu', 'left');
        $this->db->where('submenu.aktif', 'Y');
        $this->db->where('submenu.idmain', $id_menu);
        $this->db->where('fid_idsub', NULL);
        $this->db->order_by('submenu.order', 'asc');
        $q = $this->db->get();

        return $q->result();
    }

    public function parent_submenu($idsub) {
        $this->db->select('idsub, fid_idsub');
        $this->db->from('t_submenu');
        $this->db->where('fid_idsub !=', NULL);
        $this->db->where('fid_idsub', $idsub);
        $q = $this->db->get();
        return $q;
    }

    public function sub_submenu($idsub) {
        $this->db->select('nama_sub, link_sub, idsub');
        $this->db->from('t_submenu');
        $this->db->where('fid_idsub', $idsub);
        $this->db->where('aktif', 'Y');
        $this->db->order_by('order', 'asc');
        $q = $this->db->get();
        return $q->result();
    }

    public function get_submenu_jml($id_menu)
    {
        return $this->db->get_where('t_submenu', ['idmain' => $id_menu])->num_rows();
    }

    public function get_informasi_terbaru()
    {
        return $this->db->get_where('t_info', ['publish' => 'Y'])->result();
    }

    public function get_agenda_terbaru()
    {
        return $this->db->get('t_agenda', 6, 0)->result();
    }

    public function get_kategori_listing()
    {
        $this->db->where('aktif', 'Y');

        return $this->db->get('t_kategori', 8, 0)->result();
    }

    public function count_kategori_berita($id_kategori)
    {
        $q = $this->db->get_where('t_berita', ['fid_kategori' => $id_kategori]);

        return $q->num_rows();
    }

    public function berita_terakhir()
    {
        return $this->db->order_by('id_berita', 'desc')->get_where('t_berita', ['publish' => '1'], 1, 0)->row();
    }

    public function berita_pilihan()
    {
        return $this->db->order_by('id_berita', 'RANDOM')->get_where('t_berita', ['pilihan' => 'Y'], 1, 0)->row();
    }

    public function berita_selanjutnya($id)
    {
        return $this->db->order_by('id_berita')->get_where('t_berita', ['id_berita !=' => $id ], 2, 0);
    }

    public function berita_by_kategori($limit, $offset)
    {
        $this->db->select('b.judul, b.path, b.created_by, k.nama_kategori');
        $this->db->from('t_berita AS b');
        $this->db->join('t_kategori AS k', 'b.fid_kategori = k.id_kategori', 'left');
        $this->db->where('b.publish', '1');
        $this->db->where('k.aktif', 'Y');
        $this->db->order_by('b.id_berita', 'desc');
        $this->db->order_by('k.id_kategori', 'desc');
        $this->db->limit($limit, $offset);
        $q = $this->db->get();

        return $q->result();
    }

    public function berita_populer()
    {
        $this->db->where('views !=', '0');
        $this->db->order_by('views', 'desc');
        $q = $this->db->get('t_berita', 6, 0);
        return $q->result();
    }

    public function get_all_berita($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('t_berita');
        $this->db->order_by('id_berita', 'DESC');
        $this->db->where('publish', '1');
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;
    }

    public function get_listing_album()
    {
        $this->db->order_by('id_album_foto', 'desc');

        return $this->db->get('t_album_foto', 4, 0)->result();
    }

    public function get_photo_by_album($id_album_foto, $limit, $batas)
    {
        $this->db->select('album_foto.id_album_foto, foto.judul, foto.upload_by, foto.created_at, foto.gambar_blob, foto.path, foto.gambar');
        $this->db->from('t_foto AS foto');
        $this->db->join('t_album_foto AS album_foto', 'foto.fid_album_foto = album_foto.id_album_foto', 'left');
        $this->db->where('foto.publish', 'Y');
        $this->db->where('foto.fid_album_foto', $id_album_foto);
        $this->db->order_by('album_foto.id_album_foto', 'asc');
        $this->db->limit($limit, $batas);
        $q = $this->db->get();

        return $q->result();
    }

    public function get_lastvideo()
    {
        $this->db->select('v.fid_album_video, v.judul, v.link_youtube, v.poster, v.tgl_publish, av.judul as judul_album');
        $this->db->from('t_video AS v');
        $this->db->join('t_album_video AS av', 'v.fid_album_video = av.id_album_video', 'left');
        $this->db->where('v.publish', 'Y');
        $this->db->where('v.link_youtube !=', '#');
        $this->db->where('v.link_youtube !=', '');
        $this->db->order_by('v.id_video', 'desc');
        $this->db->limit(5, 0);
        $q = $this->db->get();

        return $q->result();
    }

    public function share_detail($id)
    {
        return $this->db->get_where('t_berita', ['id_berita' => $id])->row();
    }

    public function share_count_saved($tbl, $whr, $post)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $post);

        return;
    }

    public function bookmarksave($tbl, $post){
        return $this->db->insert($tbl, $post);
    }

    public function bookmarkupdate($tbl, $id, $post)
    {
        $this->db->where($id);
        $this->db->update($tbl, $post);
        return true;
    }

    public function get_status_bookmark($id_user, $id_berita)
    {
        $this->db->select('id_berita_save, save');
        $this->db->from('t_berita_save');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $r = $q->row();
            return $r->save;
        }
    }

    public function get_id_berita_save($id_user, $id_berita)
    {
        $this->db->select('id_berita_save');
        $this->db->from('t_berita_save');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            $r = $q->row();
            return $r->id_berita_save;
        } 
    }
    public function cek_id_berita_save($id_user, $id_berita)
    {
        $this->db->select('id_berita_save');
        $this->db->from('t_berita_save');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        return $q;
    }

    public function get_id_berita_like($id_user, $id_berita)
    {
        $this->db->select('id_berita_like');
        $this->db->from('t_berita_like');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $r = $q->row();
            return $r->id_berita_like;
        }
    }

    public function cek_id_berita_like($id_user, $id_berita)
    {
        $this->db->select('id_berita_like');
        $this->db->from('t_berita_like');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        return $q;
    }
    public function likesave($tbl, $post)
    {
        return $this->db->insert($tbl, $post);
    }
    public function likedelete($tbl, $id)
    {
        $this->db->where($id);
        $this->db->delete($tbl);
        return true;
    }
    public function update_count_like($tbl, $id, $post)
    {
        $this->db->where($id);
        $this->db->update($tbl, $post);
        return true;
    }
    public function get_status_like($id_user, $id_berita)
    {
        $this->db->select('id_berita_like');
        $this->db->from('t_berita_like');
        $this->db->where(array('fid_users_portal' => $id_user, 'fid_berita' => $id_berita));
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return true;
        }
    }
}

/* End of file M_f_identitas.php */
/* Location: ./application/models/M_f_identitas.php */
