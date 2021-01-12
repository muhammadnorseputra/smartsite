<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_submenu extends CI_Model {
    
    public function get_mainmenu()
    {
        return $this->db->where('aktif','Y')->where('link','#')->get('t_menu');
    }
    public function count_all()
    {
        return $this->db->get('t_submenu')->num_rows();
    } 
    public function get_search($kata)
    {
        $this->db->select('s.*, m.nama_menu, md.token')
                 ->from('t_submenu as s')
                 ->join('t_menu as m', 's.idmain=m.id_menu')
                 ->join('t_module as md', 's.fid_module=md.id_module')
                 ->like('s.nama_sub', $kata)
                 ->or_like('m.nama_menu', $kata)
                 ->order_by('s.nama_sub', 'desc');
        $query = $this->db->get();
        $output = '';
        $no = 1;
        
        $user = $this->session->userdata('user_access');
        foreach($query->result() as $row)
        {
            if($row->aktif == 'Y')
            {
                $col = 'teal';
                $icon = '<em class="material-icons">hdr_strong</em>';
            }
            else
            {
                $col = 'grey';
                $icon = '<em class="material-icons">hdr_weak</em>';
            }
            $output .= '
                <tr>
                    <td>
                    <input type="checkbox" id="md_checkbox_'.$row->idsub.'" class="multipel_selected_hapus filled-in chk-col-grey" value="'.$row->idsub.'">
                    <label for="md_checkbox_'.$row->idsub.'"></label>
                    </td>
                    <td>'.$no.'</td>
                    <td>'.$row->order.'</td>
                    <td class="font-bold">'.strtoupper($row->nama_sub).'<br> <span class="col-grey">'.$row->nama_menu.'</span></td>
                    <td>'.$row->link_sub.'</td>
                    <td class="text-center col-'.$col.'">'.$icon.'</td>
                    <td>
                        <a data-toggle="tooltip" data-placement="top" title="hapus" class="col-red m-r-5 waves-effect waves-circle waves-float" onclick="hapus('.$row->idsub.')">
							<i class="glyphicon glyphicon-trash"></i>
						</a>
												
                        <a data-toggle="tooltip" data-placement="top" title="Edit" class="waves-effect waves-circle waves-float" onclick="edit('.$row->idsub.')">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </td>
                </tr>
            ';
        $no++;
        }

        return $output;        
    }
    public function fetch_data($limit, $start)
    {
        $this->db->select('s.*, m.nama_menu, md.token')
                 ->from('t_submenu as s')
                 ->join('t_menu as m', 's.idmain=m.id_menu')
                 ->join('t_module as md', 's.fid_module=md.id_module')
                 ->limit($limit, $start)
                 ->order_by('m.nama_menu asc, s.order asc');

        $query = $this->db->get();

        $output = '';
        $no = 1;
        $user = $this->session->userdata('user_access');
        foreach($query->result() as $row)
        {
            if($row->aktif == 'Y')
            {
                $col = 'grey';
                $icon = '<em class="material-icons col-teal">hdr_strong</em>';
            }
            else
            {
                $col = 'red';
                $icon = '<em class="material-icons col-grey">hdr_weak</em>';
            }
            $output .= '
                <tr>
                    <td>
                    <input type="checkbox" id="md_checkbox_'.$row->idsub.'" class="multipel_selected_hapus filled-in chk-col-grey" value="'.$row->idsub.'">
                    <label for="md_checkbox_'.$row->idsub.'"></label>
                    </td>
                    <td>'.$no.'</td>
                    <td>'.$row->order.'</td>
                    <td class="font-bold">'.strtoupper($row->nama_sub).'<br><span class="col-grey">'.$row->nama_menu.'</span></td>
                    <td>'.$row->link_sub.'</td>
                    <td class="text-center col-'.$col.'">'.$icon.'</td>
                    <td>
                        <a data-toggle="tooltip" data-placement="top" title="hapus" class="col-red m-r-5 waves-effect waves-circle waves-float" onclick="hapus('.$row->idsub.')">
							<i class="glyphicon glyphicon-trash"></i>
						</a>
												
                        <a data-toggle="tooltip" data-placement="top" title="Edit" class="waves-effect waves-circle waves-float" onclick="edit('.$row->idsub.')">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                    </td>
                </tr>
            ';
        $no++;
        }

        return $output;
    }
    
    public function get_submenu_where_id($id)
    {
        return $this->db->where('idsub', $id)->get('t_submenu');
    }
    
    public function updatesubmenu($tbl,$whr,$data)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
    }

    public function insert($tbl,$data)
    {
        $this->db->insert($tbl,$data);
    }

    public function multipel_hapus($id)
    {
        $this->db->where('idsub', $id);
        $this->db->delete('t_submenu');
    }

    public function hapus($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}