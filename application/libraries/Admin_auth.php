<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth
{
	protected $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->model('virgy_m_auth');
	}

	public function login($usernameoremail, $password)
	{
		// cek user di table
		$cek = $this->ci->virgy_m_auth->login($usernameoremail);
		
		if($cek){
			
			if (password_verify($password, $cek['password'])) {

				// ambil data pada field tabel
				// $id_user = $cek->id_user;
				$name_user= $cek['name_user'];
				$username = $cek['username'];
				$email = $cek['email'];
				$photo = $cek['photo'];

				// buat session
				// $this->ci->session->set_userdata('id_user', $id_user);
				$this->ci->session->set_userdata('username', $username);
				$this->ci->session->set_userdata('name_user', $name_user);
				$this->ci->session->set_userdata('email', $email);
				$this->ci->session->set_userdata('photo', $photo);
				redirect('virgy_admin');
			} else{
				// jika user tidak ada
				$this->ci->session->set_flashdata('error', 'Username/Email/Password Salah');
				redirect('virgy_auth/login');
			}

		} else{
			// jika user tidak ada
			$this->ci->session->set_flashdata('error', 'Akun Tidak Terdaftar');
			redirect('virgy_auth/login');
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('name_user');
		$this->ci->session->unset_userdata('email');
		$this->ci->session->unset_userdata('photo');

		$this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout!');
		redirect('virgy_auth/login');
	}

	public function proteksi_halaman()
	{
		$cek = $this->ci->virgy_m_auth->login($this->ci->session->userdata('username'));	
			
		if (!$cek) {
			$this->ci->session->unset_userdata('username');
			$this->ci->session->unset_userdata('name_user');
			$this->ci->session->unset_userdata('email');
			$this->ci->session->unset_userdata('photo');
			// $this->ci->session->set_flashdata('error', 'Anda Belum Login!');
			redirect('virgy_auth/login');
		} 
	}

}
