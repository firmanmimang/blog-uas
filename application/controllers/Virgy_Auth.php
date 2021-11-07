<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_Auth extends CI_Controller 
{
	public function login()
	{
		// proteksi sudah login
		if($this->session->userdata('username')){
			redirect('virgy_admin');
		}

		$this->form_validation->set_rules('usernameoremail', 'Username / Email', 'required|trim', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('password', 'Password', 'required|trim', array(
			'required' => '%s Harus Diisi!'
		));

		if ($this->form_validation->run() == TRUE) {
			$usernameoremail = htmlspecialchars($this->input->post('usernameoremail'), TRUE);
			$password = htmlspecialchars($this->input->post('password'), TRUE);

			$this->admin_auth->login($usernameoremail, $password); //libraries
		}

		$data['title'] = 'Login';
		$this->load->view('back-end/auth/virgy_v_login', $data, FALSE);		
	}

	public function logout()
	{
		$this->admin_auth->logout(); //libraries
	}
}