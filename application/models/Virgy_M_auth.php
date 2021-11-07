<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_M_auth extends CI_Model {

	public function login($usernameoremail){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $usernameoremail);
		$this->db->or_where(['email' => $usernameoremail]);

		return $this->db->get()->row_array();
	}
}