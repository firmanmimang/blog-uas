<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_Content extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function detail($id)
	{
		$data['title'] = 'Content';
		$data['content'] = $this->virgy_m_front_end->get_content_by_id($id);
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
		$data['isi'] = 'front-end/virgy_v_content';

		$this->load->view('layout/virgy_v_wrapper_frontend', $data, FALSE);
	}
}