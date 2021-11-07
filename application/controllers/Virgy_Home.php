<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Home';
		$data['content_search'] = $this->virgy_m_front_end->fetch_all_contents_by_title($this->input->post('keyword'));
		if($this->input->post('keyword')){
			if (count($data['content_search'])>0) {
				$data['isi'] = 'front-end/virgy_search_result';

				$this->load->view('layout/virgy_v_wrapper_frontend', $data, FALSE);
			}
		}
		if(!empty($this->input->post('keyword'))){
			$this->session->set_flashdata('flash', 'maaf data yang anda cari kosong... ');
		}
		$data['content_latest'] = $this->virgy_m_front_end->get_latest_content();
		$data['contents'] = $this->virgy_m_front_end->get_all_contents();
		$data['isi'] = 'front-end/virgy_v_home';

		$this->load->view('layout/virgy_v_wrapper_frontend', $data, FALSE);
	}
}