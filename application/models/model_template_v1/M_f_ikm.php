<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_f_ikm extends CI_Model
{
	public function ikm_periode()
	{
		return $this->db->get('skm_periode');
	}
}