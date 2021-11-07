<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_M_admin extends CI_Model 
{
// BAGIAN DASHBOARD
	public function get_category_total(){
		return $this->db->get('theme')->num_rows();
	}

	public function get_content_total(){
		return $this->db->get('article')->num_rows();
	}
// AKHIR DASHBOARD

// BAGIAN PROFILE
	public function get_profile($username){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $username);

		return $this->db->get()->row_array();
	}

	public function edit_profile($data){
		$this->db->where('id', $data['id']);
		$this->db->update('user', $data);
	}

	public function get_profile_photo($username){
		$this->db->select('photo');
		return $this->db->get_where('user', ['username' => $username])->row_array();
	}
// AKHIR PROFILE

// BAGIAN KATEGORY
	public function get_all_category(){
		return $this->db->get('theme')->result_array();
	}

	public function add_category($data){
		$this->db->insert('theme', $data);
	}

	public function edit_category($data){
		$this->db->where('id', $data['id']);
		$this->db->update('theme', ['name_theme' => $data['name_theme']]);
	}

	public function delete_category($data){
		$this->db->delete('theme', $data);
	}
// AKHIR KATEGORY

// BAGIAN ARTICLE CONTENT
	public function get_all_contents(){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->order_by('article.id', 'asc');

		return $this->db->get()->result_array();
	}

	public function get_all_contents_by_id($id){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->where('article.id', $id);
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->order_by('article.id', 'asc');

		return $this->db->get()->row_array();
	}

	public function add_content($data){
		$this->db->insert('article', $data);
	}

	public function edit_content($data){
		$this->db->where('id', $data['id']);
		$this->db->update('article', $data);

		$this->db->where('id', $data['id']);
		$this->db->update('article', $data);		
	}

	public function delete_content($data){
		$this->db->delete('article', $data);
	}

	public function get_image_content($id){
		$this->db->select('image');
		return $this->db->get_where('article', ['id' => $id])->row_array();
	}

	public function delete_content_image($data){
		$this->db->where('id', $data['id']);
		$this->db->update('article', $data);
	}
// AKHIR CONTENT
}