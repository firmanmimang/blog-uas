<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_M_front_end extends CI_Model 
{
// BAGIAN TABLE USER
	public function get_profile(){
		$this->db->select('name_user, nim, email, photo, jurusan, fakultas');
		$this->db->from('user');

		return $this->db->get()->row_array();
	}
// AKHIR TABLE USER

// BAGIAN TABLE ARTICLE
	public function get_all_contents(){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->order_by('article.id', 'desc');

		return $this->db->get()->result_array();
	}

	public function get_latest_content(){
		$this->db->select('article.*, theme.name_theme');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->limit(1);
		$this->db->order_by('article.id', 'desc');

		return $this->db->get()->row_array();
	}

	public function get_content_by_id($id){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->where('article.id', $id);
		$this->db->order_by('article.id', 'desc');

		return $this->db->get()->row_array();
	}

	public function get_all_contents_by_category($id_theme){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->where('article.id_theme', $id_theme);
		$this->db->order_by('article.id', 'desc');

		return $this->db->get()->result_array();
	}

	public function fetch_all_contents_by_title($title){
		$this->db->select('article.*, theme.name_theme, user.username, user.name_user');
		$this->db->from('article');
		$this->db->join('theme', 'theme.id = article.id_theme', 'left');
		$this->db->join('user', 'user.id = article.id_user', 'left');
		$this->db->like('article.title', $title);
		$this->db->order_by('article.id', 'desc');

		return $this->db->get()->result_array();
	}
// AKHIR TABLE ARTICLE

// BAGIAN TABLE CATEGORY
	public function get_all_category(){
		return $this->db->get('theme')->result_array();
	}
// AKHIR TABLE CATEGORY
}