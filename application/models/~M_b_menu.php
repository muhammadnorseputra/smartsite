<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_menu extends CI_Model {
    public function get_search($kata)
    {
        $this->db->select('m.*, lm.nama_label, lm.aktif AS aktif_label')
                 ->from('t_menu AS m')
                 ->join('ref_labelmenu AS lm', 'm.fid_label = lm.id_label')
                 ->like('nama_menu', $kata)
				 ->order_by('lm.nama_label desc, m.order asc');
        $mod = $this->db->get();
        $row = '';
		if(count($mod) > 0){
			$no = 1+$this->uri->segment(5);
			foreach ($mod->result() as $m) {
            if($m->sts == 'BACKEND'){
                $sts = "<b class='text-danger'><em class='material-icons'>flip_to_back</em></b>";
            }else{
                $sts = "<b class='text-success'><em class='material-icons'>flip_to_front</em></b>";
            }

            if($m->aktif == 'Y'){
                $color = '<em class="material-icons col-black">visibility</em>';
            }else{
                $color = '<em class="material-icons col-grey">visibility_off</em>';
            }
			
			$row .= '<tr>
						<td>
                            <input type="checkbox" id="md_checkbox_'.$m->id_menu.'" class="multipel_selected_hapus filled-in chk-col-red" value="'.$m->id_menu.'">
                            <label for="md_checkbox_'.$m->id_menu.'"></label>
						</td>
						<td class="text-center font-bold">'.$no.'</td>
						<td>'.$m->order.'</td>
						<td class="font-bold text-info">'.ucwords($m->nama_label).'</td>
						<td><i class="material-icons">'.strtolower($m->fid_icon).'</i></td>
						<td class="font-bold">'.ucwords($m->nama_menu).'</td>
						<td><a href="'.site_url($m->link).'" title="'.ucwords($m->nama_menu).'">'.$m->link.'</a></td>
						<td>'.$sts.'</td>
						<td class="text-center">
							'.$color.'
						<td class="text-center">
						<a data-toggle="tooltip" data-placement="top" title="hapus" class="btn-link bg-red m-r-5 waves-effect waves-circle waves-float" onclick="hapus('.$m->id_menu.')">
							<i class="glyphicon glyphicon-trash"></i>
						</a>
												
						<a data-toggle="tooltip" data-placement="top" title="Edit" class="waves-effect waves-circle waves-float" onclick="editmenu('.$m->id_menu.')">
							<i class="glyphicon glyphicon-pencil"></i>
						</a>						
						</td>
					 </tr>';
			$no++;
			}
		}
        
        return $row;    
    }

    public function listmenu($limit, $start)
    {
        $this->db->select('m.*, lm.nama_label, lm.aktif AS aktif_label')
                 ->from('t_menu AS m')
                 ->join('ref_labelmenu AS lm', 'm.fid_label = lm.id_label', 'left')
				 ->limit($limit, $start)
				 ->order_by('lm.nama_label desc, m.order asc');
        $mod = $this->db->get()->result();
        // var_dump();
        // die;
        $row = '';
        $opt_module= '';
        $x = 0;
        foreach($this->module->get_module_list() as $list) {
            if($list->id_module == $mod[$x]->fid_module ) {
                $selected = 'selected';
            } else {
                $selected = '0';
            }
            $opt_module .=  "<option value='".$list->id_module."' ".$selected.">".$list->nama_module."</option>";
        $x++;
        }

		if(count($mod) > 0){
			$no = 1;
			foreach ($mod as $m) {
			if($m->sts == 'BACKEND'){
				$sts = "<b class='text-danger'><em class='material-icons'>flip_to_back</em></b>";
			}else{
				$sts = "<b class='text-success'><em class='material-icons'>flip_to_front</em></b>";
			}

			if($m->aktif == 'Y'){
                $color = '<em class="material-icons col-black">visibility</em>';
            }else{
                $color = '<em class="material-icons col-grey">visibility_off</em>';
            }
            
			$row .= '<tr>
						<td>
                            <input type="checkbox" id="md_checkbox_'.$m->id_menu.'" class="multipel_selected_hapus filled-in chk-col-red" value="'.$m->id_menu.'">
                            <label for="md_checkbox_'.$m->id_menu.'"></label>
						</td>
						<td class="text-center font-bold">'.$no.'</td>
						<td>'.$m->order.'</td>
						<td class="font-bold text-info">'.ucwords($m->nama_label).'</td>
						<td><i class="material-icons">'.strtolower($m->fid_icon).'</i></td>
						<td class="font-bold">'.ucwords($m->nama_menu).'</td>
						<td><a href="'.site_url($m->link).'" title="'.ucwords($m->nama_menu).'">'.$m->link.'</a></td>
                        <td>'.$sts.'</td>
                        <td>
                        <select name="module" class="form-control">
                            '. 
                                $opt_module
                            .'
                        </select>
                        </td>
						<td class="text-center">
							'.$color.'
						</td>
						<td class="text-center">
						<a data-toggle="tooltip" data-placement="bottom" title="HAPUS" class="btn-danger m-r-5 waves-effect waves-circle waves-float" onclick="hapus('.$m->id_menu.')">
							<i class="glyphicon glyphicon-trash"></i>
						</a>
												
						<a data-toggle="tooltip" data-placement="bottom" title="EDIT" class="btn-link  waves-effect waves-circle waves-float" onclick="editmenu('.$m->id_menu.')">
							<i class="glyphicon glyphicon-pencil"></i>
						</a>						
						</td>
					 </tr>';
			$no++;
			}
		}else{
			$row .= '<tr><td colspan="9" class="font-center">Data Kosong</td></tr>';
        }
        
        return $row;

	}
	public function get_menu_where_id($id) {
		return $this->db->where('id_menu', $id)->get('t_menu');
	}
    public function updatemenu($tbl,$whr,$data)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
    }	
    public function count_all()
    {
        return $this->db->get('t_menu')->num_rows();
    }
    public function listlabel()
    {
        return $this->db->order_by('order', 'asc')->get('ref_labelmenu');
    }
    
    public function get_labelmenu($tbl, $search)
    {
        if(isset($search)) {
            $res = $this->db->like('nama_label', $search)->get_where($tbl, array('aktif' => 'Y'));
        } else {
            $res = $this->db->order_by('id_label', 'desc')->get_where($tbl, array('aktif' => 'Y'));
        }

        return $res;
    }

    public function get_labelmenu_where_id($id)
    {
        return $this->db->where('id_label', $id)->get('ref_labelmenu');
    }
    public function get_icon($tbl, $search)
    {
        if(isset($search)) {
            $res = $this->db->like('id_icon', $search)->get($tbl);
        } else {
            $res = $this->db->order_by('id_icon', 'desc')->get($tbl);
        }

        return $res;
    }   

    public function getIcon()
    {
        return $this->db->order_by('id_icon','desc')->get('ref_icon');
    } 

    public function CariIcon($icon)
    {
        return $this->db->like('id_icon', $icon)->get('ref_icon');
    }  

    public function insert_icon($value)
    {
        return $this->db->insert('ref_icon', $value);
    }

    public function insert_label($value)
    {
        return $this->db->insert('ref_labelmenu', $value);
    }    

    public function insertmenu($tbl,$data)
    {
        return $this->db->insert($tbl, $data);
    }  

    public function updatelabel($tbl,$whr,$data)
    {
        $this->db->where($whr);
        $this->db->update($tbl, $data);
    }

    public function hapus($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    } 

    public function hapuslistlabel($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }    
    public function multipel_hapus($id)
    {
        $this->db->where('id_menu', $id);
        $this->db->delete('t_menu');
    }     
    public function _get_id_module() {
        return $this->db->select('fid_module')->from('t_menu')->result();
    }    
}