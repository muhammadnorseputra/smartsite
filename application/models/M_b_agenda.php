<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_b_agenda extends CI_Model {
  public function count_all_agenda() {
    return $this->db->select('*')->from('t_agenda')->count_all_results();
  }
}
