<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_f_post extends CI_Model {
    
    // set table
    protected $table = 't_berita';
    //set column field database for datatable orderable
    protected $column_order = array('id_berita', null, 'judul'); 
    //set column field database for datatable searchable 
    protected $column_search = array('judul'); 
    // default order 
    protected $order = array('id_berita' => 'desc'); 
    
    private function _get_datatables_query($idAkun)
    {
         
        $this->db->from($this->table);
        $this->db->where('created_by', $idAkun);

        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($idAkun)
    {
        $this->_get_datatables_query($idAkun);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($idAkun)
    {
        $this->_get_datatables_query($idAkun);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($idAkun)
    {
        $this->db->from($this->table);
        $this->db->where('created_by', $idAkun);
        return $this->db->count_all_results();
    }
    // -------------------------------- end-datatable --------------------------//
    public function photo_terkait($id,$limit=null)
    {
        $this->db->limit($limit);
        return $this->db->get_where('t_berita_photo', ['fid_berita' => $id]);
    }
    public function getImageTerkaitThumb($id_berita, $sort)
    {
        $this->db->where('fid_berita', $id_berita);
        $this->db->limit(1);
        $this->db->order_by('id_berita_photo', $sort);
        $q = $this->db->get('t_berita_photo');
        if($q->num_rows() > 0) {
            $r = $q->row();
            return img_blob($r->photo);
        }
        return null;
    }
    public function doDeletePhotoTerkait($tbl,$whr)
    {
        $this->db->where($whr);
        return $this->db->delete($tbl);
    }
    public function slugByIdBerita($id)
    {
        $this->db->select('slug');
        $q = $this->db->get_where('t_berita', ['id_berita' => $id])->row();
        return $q->slug;
    }
    public function detailIdBySlug($slug)
    {
        $this->db->select('id_berita');
        $q = $this->db->get_where('t_berita', ['slug' => $slug])->row();
        return $q->id_berita;
    }
	public function detail($id) {
		return $this->db->get_where('t_berita', ['id_berita' => $id]);
    }

    public function getJudulById($id)
    {
        $this->db->select('judul');
        $this->db->from('t_berita');
        $this->db->where('id_berita', $id);
        $db = $this->db->get();
        if ($db->num_rows() > 0) {
            $r = $db->row();
            $result = $r->judul;
        } else {
            $result = 'Judul is null';
        }
        return $result;
    }
    public function getIdByJudul($judul){
        $this->db->select('id_berita');
        $this->db->from('t_berita');
        $this->db->where('judul', $judul);
        $db = $this->db->get();
        if($db->num_rows() > 0)
        {
            $r = $db->row();
            $result = $r->id_berita;
        } else {
            $result = 'ID NULL';
        }   
        return $result;
    }
    public function getIdByJudulAndType($judul, $type){
        $this->db->select('id_berita');
        $this->db->from('t_berita');
        $this->db->where('judul', $judul);
        $this->db->where('type', $type);
        $db = $this->db->get();
        if($db->num_rows() > 0)
        {
            $r = $db->row();
            $result = $r->id_berita;
        } else {
            $result = 'ID NULL';
        }   
        return $result;
    }

    public function getDetailByUrl($url){
        $this->db->select('id_berita, views, type');
        $this->db->from('t_berita');
        $this->db->where('content', $url);
        $db = $this->db->get();
        if($db->num_rows() > 0)
        {
            $r = $db->row();
            $result = $r;
        } else {
            $result = "";
        }
        return $result;
    }

    public function doInsertJudulBaru($tbl, $data)
    {
        return $this->db->insert($tbl, $data);
    }
    
    public function doUpdatePhoto($tbl, $whr, $data)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
        return true;
    }

    public function doInsertPhotoTerkait($tbl, $data)
    {
        return $this->db->insert($tbl, $data);
    }

    public function doUpdatePost($tbl, $id, $data)
    {
        $this->db->where('id_berita', $id);
        $this->db->update($tbl, $data);
        return true;
    }

    public function deletePost($tbl, $id)
    {
        $this->db->where('id_berita', $id);
        $this->db->delete($tbl);
        return true;
    }

	public function get_all_post_by_user($limit, $start, $user)
    {
        $this->db->select('*');
        $this->db->from('t_berita');
        $this->db->order_by('id_berita', 'DESC');
        $this->db->where('created_by', $user);
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;
    }

    public function update_count_post($id, $count) {
        $this->db->where('id_berita', $id);
        $this->db->update('t_berita', ['views' => $count]);
    }

    public function send_komentar($tbl, $data)
    {
        return $this->db->insert($tbl, $data);
    }

    public function jml_komentar_by_id_berita($id)
    {
        $this->db->select('id_komentar');
        $this->db->from('t_komentar');
        $this->db->where('fid_berita', $id);
        $q = $this->db->get();
        return $q->num_rows();

    }
    public function displayKomentar($tbl, $whr)
    {
        $this->db->select('*');
        $this->db->from($tbl);
        $this->db->order_by('id_komentar', 'DESC');
        $this->db->where($whr);
        $q = $this->db->get();
        return $q;
    }

    public function jml_replay_komentar($parentId) 
    {
        $this->db->select('id_komentar, parent_id');
        $this->db->from('t_komentar');
        $this->db->where('parent_id !=', NULL);
        $this->db->where('parent_id', $parentId);
        $q = $this->db->get();
        return $q->num_rows();
    }

    public function user_replay_komentar($parentId) 
    {
        $this->db->select('k.*, u.nama_lengkap, u.photo_pic');
        $this->db->from('t_komentar AS k');
        $this->db->join('t_users_portal AS u', 'k.fid_users_portal = u.id_user_portal', 'left');
        $this->db->where('k.parent_id', $parentId);
        $this->db->order_by('k.parent_id', 'asc');
        $q = $this->db->get();
        return $q->result();
    }

    public function kategori_byid($id) 
    {
        $q = $this->db->get_where('t_kategori', ['id_kategori' => $id])->row();
        return $q->nama_kategori;
    }

    public function deleteComment($tbl, $whr)
    {
        $this->db->where($whr);
        return $this->db->delete($tbl);
    }

    public function disukai($id) 
    {
        $this->db->select('b.img_blob, b.img, b.path, b.judul, b.id_berita, b.created_by, b.slug');
        $this->db->from('t_berita_like AS a');
        $this->db->join('t_berita AS b', 'a.fid_berita = b.id_berita');
        $this->db->join('t_users_portal AS c', 'b.created_by = c.id_user_portal');
        $this->db->where('a.fid_users_portal', $id);
        $q = $this->db->get();
        return $q;
    }

    public function disimpan($id) 
    {
        $this->db->select('b.judul, b.id_berita, b.created_by, b.slug');
        $this->db->from('t_berita_save AS a');
        $this->db->join('t_berita AS b', 'a.fid_berita = b.id_berita');
        $this->db->join('t_users_portal AS c', 'b.created_by = c.id_user_portal');
        $this->db->where('a.save', 'on');
        $this->db->where('a.fid_users_portal', $id);
        $q = $this->db->get();
        return $q;
    }

    public function fetch_data_search($query) {
          $this->db->select("*");
          $this->db->from("t_berita");
          $this->db->where('publish', '1');
          if($query != '')
          {
           $this->db->like('judul', $query);
          }
          $this->db->order_by('id_berita', 'DESC');
          $q = $this->db->get();
          return $q;
    }

    public function getFileNameById($id) {
        $this->db->select('img');
        $this->db->from('t_berita');
        $this->db->where('id_berita', $id);
        $q = $this->db->get()->row();
        return $q->img;
    }

    // get all postings
    function getPosts($limit=null, $kategori)
    {
        $this->db->select('*');
        $this->db->from('t_berita');
        $this->db->where('type', 'BERITA');
        $this->db->where('publish', '1');
        if(!empty($kategori)) {
            $this->db->where('fid_kategori', $kategori);
        }
        $this->db->order_by('id_berita', 'desc');
        if($limit != null) {
            $this->db->limit($limit);
        }
        $q= $this->db->get();
        return $q;
    }
    public function get_kategori()
    {
        $this->db->where('aktif', 'Y');
        return $this->db->get('t_kategori')->result();
    }

    public function postList($start, $limit)
    {
        return $this->db->order_by('id_berita', 'desc')->get_where('t_berita', ['publish' => '1'], $limit, $start);
    }
    public function postListByCategory($start, $limit)
    {
        return $this->db->order_by('id_kategori', 'desc')->join('t_berita', 't_berita.fid_kategori=t_kategori.id_kategori')->group_by('id_kategori')->get_where('t_kategori', ['aktif' => 'Y'], $limit, $start);        
    }
    public function postListByCategoryId($start,$limit,$categoryId)
    {
        return $this->db->order_by('id_berita', 'desc')->get_where('t_berita', ['publish' => '1', 'fid_kategori' => $categoryId], $limit, $start);   
    }
    public function postCategoryByTitle($slug)
    {
        return $this->db->select('id_kategori')->get_where('t_kategori', ['nama_kategori' => $slug]);
    }
}

/* End of file M_f_post.php */
/* Location: ./application/models/model_template_v1/M_f_post.php */