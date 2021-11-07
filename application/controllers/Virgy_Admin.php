<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Virgy_Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('virgy_m_admin');
	}

// DASHBOARD
	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['total_category'] = $this->virgy_m_admin->get_category_total();
		$data['total_content'] = $this->virgy_m_admin->get_content_total();
		$data['isi'] = 'back-end/virgy_v_dashboard';

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
	}
// AKHIR DASHBOARD

// BAGIAN PROFILE
	public function profile()
	{
		$data['title'] = 'Profile ';
		$data['profile'] = $this->virgy_m_admin->get_profile($this->session->userdata('username'));
		$data['isi'] = 'back-end/virgy_v_profile';

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
	}

	public function editProfile($username){
		// CEK USERNAME
		$user=$this->db->get_where('user', ['username' => $username])->row_array();
		// VERIFIKASI PROFILE BENAR TIDAK
		($user['username'] != $this->session->userdata('username'))
			? redirect('virgy_admin/profile')
			: null;
		if ($user) {
			$usernameBaru = htmlspecialchars($this->input->post('username', true));
			$emailBaru = htmlspecialchars($this->input->post('email', true));
			if ($user['username'] == $usernameBaru || $user['email'] == $emailBaru) {
				goto cekUsername;
			}
			$this->form_validation->set_rules('name_user', 'Nama User', 'required', array('required' => '%s Harus Diisi!'));
			$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|is_unique[user.email]', array(
				'required' => '%s Harus Diisi!',
				'valid_email' => '%s Belum Valid',
				'is_unique' => '%s Sudah Terdaftar'
			));
			$this->form_validation->set_rules('nim', 'NIM', 'trim|required|min_length[11]|max_length[11]', array(
				'required' => '%s Harus Diisi!',
				'min_length' => '%s Minimal 11 Karakter',
				'max_length' => '%s Maximal 11 Karakter',
			));
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]', array(
				'required' => '%s Harus Diisi!',
				'is_unique' => '%s Sudah Terdaftar'
			));
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array('required' => '%s Harus Diisi!'));
			$this->form_validation->set_rules('fakultas', 'Fakultas', 'required', array('required' => '%s Harus Diisi!'));

			if ($this->form_validation->run() == FALSE) {
				$data['title'] = 'Edit Profile';
				$data['profile'] = $this->virgy_m_admin->get_profile($username);
				$data['isi'] = 'back-end/virgy_v_profile_edit';

				$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
			}
		}

		cekUsername:
		$this->form_validation->set_rules('name_user', 'Nama User', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('nim', 'NIM', 'trim|required|min_length[11]|max_length[11]', array(
			'required' => '%s Harus Diisi!',
			'min_length' => '%s Minimal 11 Karakter',
			'max_length' => '%s Maximal 11 Karakter',
		));
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('fakultas', 'Fakultas', 'required', array('required' => '%s Harus Diisi!'));
	
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/img_user/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			// CEK USER TIDAK GANTI FOTO
			if ($_FILES['photo']['error'] == 4 ) {
				goto b;
			};
			$ekstensi = explode('.', $_FILES['photo']['name']);
			$newName = time() .'_'. $this->session->userdata('username');
			$config['file_name'] = $newName.'_profile.'.end($ekstensi);
			
			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('photo')) {
				$data = array(
					'title' =>'Edit Profile',
					'profile' => $this->virgy_m_admin->get_profile($username),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'back-end/virgy_v_profile_edit',
				);
						
				if ($this->upload->data('file_name') == "") {
					goto a;
				} 
				
				$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus foto
				$photo = $this->virgy_m_admin->get_profile($username);
				if ($photo['photo'] != "") {
					unlink('./assets/img/img_user/'.$photo['photo']);
				}
				// end hapus gambar
				// ketika ganti gambar
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/img/img_user/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id' => $photo['id'],
					'name_user'=> htmlspecialchars($this->input->post('name_user', true)),
					'nim' => htmlspecialchars($this->input->post('nim', true)),
					'email'=> htmlspecialchars($this->input->post('email', true)),
					'username'=> htmlspecialchars($this->input->post('username', true)),
					'jurusan'=> htmlspecialchars($this->input->post('jurusan', true)),
					'fakultas'=> htmlspecialchars($this->input->post('fakultas', true)),
					'photo' => $upload_data['uploads']['file_name'],
				);

				$this->virgy_m_admin->edit_profile($data);
				// set session user
				$this->session->set_userdata('username', $data['username']);
				$this->session->set_userdata('name_user', $data['name_user']);
				$this->session->set_userdata('photo', $data['photo']);
				//set notif pesan
				$this->session->set_flashdata('pesan', 'Profile Berhasil Diedit!');
				redirect('virgy_admin/profile');
			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'id' => $user['id'],
					'name_user'=> htmlspecialchars($this->input->post('name_user', true)),
					'nim' => htmlspecialchars($this->input->post('nim', true)),
					'email'=> htmlspecialchars($this->input->post('email', true)),
					'username'=> htmlspecialchars($this->input->post('username', true)),
					'jurusan'=> htmlspecialchars($this->input->post('jurusan', true)),
					'fakultas'=> htmlspecialchars($this->input->post('fakultas', true)),
				);

				$this->virgy_m_admin->edit_profile($data);
				// set session user
				$this->session->set_userdata('username', $data['username']);
				$this->session->set_userdata('name_user', $data['name_user']);
				//set notif pesan
				$this->session->set_flashdata('pesan', 'Profile Berhasil Diedit!');
				redirect('virgy_admin/profile');
			}
			
		}
		$data['title'] = 'Edit Profile';
		$data['profile'] = $this->virgy_m_admin->get_profile($username);
		$data['isi'] = 'back-end/virgy_v_profile_edit';

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
	}

	public function editPassword(){
		checkLagi:
		// GET DATA
		$data['profile'] = $this->virgy_m_admin->get_profile($this->session->userdata('username'));

		$this->form_validation->set_rules('password_sekarang', 'Password Lama', 'required|trim|callback_check_password_lama', array(
			'required' => '%s Harus Diisi!'
		));
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[6]|matches[ulangi_password]|callback_check_password_baru', array(
			'required' => '%s Harus Diisi!',
			'min_length' => '%s Minimal 6 Karakter',
			'matches' => '%s Tidak Sama Dengan Retype Password'
		));
		$this->form_validation->set_rules('ulangi_password', 'Retype Password', 'required|trim|matches[password_baru]', array(
			'required' => '%s Harus Diisi!',
			'matches' => '%s Tidak Sama Dengan Password Baru'
		));

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Change Password';
			$data['isi'] = 'back-end/virgy_v_profile_change_password';

			$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
		} else{
			$password_baru = $this->input->post('password_baru');
			$password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

			$this->db->set('password', $password_hash);
			$this->db->where('username', $this->session->userdata('username'));
			$this->db->update('user');

			$this->session->set_flashdata('pesan', 'Password Berhasil Diubah!');
			redirect('virgy_admin/profile');
		}
	}

	// CALLBACK FUNGSI UTK VALIDATION ERROR INPUT PASSWORD LAMA
	function check_password_lama($post_string){
		$data['profile'] = $this->virgy_m_admin->get_profile($this->session->userdata('username'));
		
		if (!password_verify($post_string, $data['profile']['password']) && !empty($post_string)) 
		{
			$this->form_validation->set_message('check_password_lama', 'Password Lama Salah!');

			return FALSE;
		} else{
			return TRUE;
		}
	}

	// CALLBACK FUNGSI UTK VALIDATION ERROR INPUT PASSWORD BARU
	function check_password_baru($post_string){
		$data['profile'] = $this->virgy_m_admin->get_profile($this->session->userdata('username'));
		
		if (password_verify($post_string, $data['profile']['password'])) {
			$this->form_validation->set_message('check_password_baru', 'Password Sama Dengan Password Lama!');

			return FALSE;
		} 
		else{
			return TRUE;
		}
	}
// AKHIR PROFILE

// BAGIAN KATEGORI
	public function category()
	{
		$data = [
			'title' => 'Article Categories',
			'category' => $this->virgy_m_admin->get_all_category(),
			'isi' => 'back-end/virgy_v_category'
		];

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);		
	}

	public function add_category()
	{
		$data = [
			'name_theme' => $this->input->post('name_category')
		];

		$this->virgy_m_admin->add_category($data);
		$this->session->set_flashdata('pesan', 'Article Category Add Success!');
		redirect('virgy_admin/category');
	}

	public function edit_category($id)
	{
		$data = [
			'id' => $id,
			'name_theme' => $this->input->post('name_category')
		];

		$this->virgy_m_admin->edit_category($data);
		$this->session->set_flashdata('pesan', 'Article Category Edit Success!');
		redirect('virgy_admin/category');
	}

	public function delete_category($id)
	{
		$data = [
			'id' => $id
		];

		$this->virgy_m_admin->delete_category($data);
		$this->session->set_flashdata('pesan', 'Article Category Delete Success!');
		redirect('virgy_admin/category');
	}
// AKHIR KATEGORI

// BAGIAN ARTICLE CONTENT
	public function articleContent()
	{
		$data = [
			'title' => 'Article Contents',
			'contents' => $this->virgy_m_admin->get_all_contents(),
			'isi' => 'back-end/virgy_v_article_content'
		];

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
	}

	public function addContent(){
		// AMBIL ID USER
		$user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('id_category', 'Kategori', 'required|callback_check_category', array('required' => '%s Harus Diisi!'));
		
		$this->form_validation->set_rules('content', 'Content', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/img_content';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			// SKIP UPLOAD IMAGE
			if ($_FILES['image']['error'] == 4 ) {
				goto b;
			};

			// ambil nama ketagori
			$kategori = $this->db->get_where('theme', ['id' => htmlspecialchars($this->input->post('id_category', true))])->row_array();
			$ekstensi = explode('.', $_FILES['image']['name']);
			$newName = time() .'_'.$this->session->userdata('username');

			$config['file_name'] = $kategori['name_theme'].'_'.$newName.'_'.current($ekstensi).'.'.end($ekstensi);

			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {

				$data = array(
					'title' =>'Making Content',
					'category' => $this->virgy_m_admin->get_all_category(),
					'error_upload' => $this->upload->display_errors(),
					'isi' => 'back-end/virgy_v_article_content_add',
				);

				if ($this->upload->data('file_name') == "") {
					goto a;
				}
			
				$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
						
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/img/img_content/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'title'=>htmlspecialchars($this->input->post('title', true)),
					'id_theme'=>htmlspecialchars($this->input->post('id_category',true)),
					'id_user' => $user['id'],
					'content'=>htmlspecialchars($this->input->post('content', true)),
					'image' => $upload_data['uploads']['file_name'],
					'date_created' => time()
				);

				$this->virgy_m_admin->add_content($data);
				$this->session->set_flashdata('pesan', 'Content Berhasil Dibuat!');
				redirect('virgy_admin/articlecontent');
			} else{
				a:
				// TANPA UPLOAD IMAGE
				$data = array(
					'title'=>htmlspecialchars($this->input->post('title', true)),
					'id_theme'=>htmlspecialchars($this->input->post('id_category',true)),
					'id_user' => $user['id'],
					'content'=>htmlspecialchars($this->input->post('content', true)),
					'date_created' => time()
				);

				$this->virgy_m_admin->add_content($data);
				$this->session->set_flashdata('pesan', 'Content Berhasil Dibuat!');
				redirect('virgy_admin/articlecontent');
			}
		}
		$data['title'] = 'Making Content';
		$data['isi'] = 'back-end/virgy_v_article_content_add';
		$data['category'] = $this->virgy_m_admin->get_all_category();

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);
	}

	public function editContent($id)
	{
		$this->form_validation->set_rules('title', 'Judul', 'required', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('id_category', 'Kategori', 'required|callback_check_category', array('required' => '%s Harus Diisi!'));
		$this->form_validation->set_rules('content', 'Content', 'required', array('required' => '%s Harus Diisi!'));
		
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/img_content';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']     = '4000'; //dlm kilobyte

			// SKIP UPLOAD IMAGE
			if ($_FILES['image']['error'] == 4 ) {
				goto b;
			};

			// ambil nama ketagori
			$kategori = $this->db->get_where('theme', ['id' => htmlspecialchars($this->input->post('id_category', true))])->row_array();
			$ekstensi = explode('.', $_FILES['image']['name']);
			$newName = time() .'_'.$this->session->userdata('username');

			$config['file_name'] = $kategori['name_theme'].'_'.$newName.'_'.current($ekstensi).'.'.end($ekstensi);

			b:
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {

				$data = array(
					'title' =>'Edit Content',
					'category' => $this->virgy_m_admin->get_all_category(),
					'error_upload' => $this->upload->display_errors(),
					'article' => $this->virgy_m_admin->get_all_contents_by_id($id),
					'isi' => 'back-end/virgy_v_article_content_edit',
				);

				if ($this->upload->data('file_name') == "") {
					goto a;
				}
				$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);

			} elseif($this->upload->data('is_image') == 1){
				// hapus gambar
				$article = $this->virgy_m_admin->get_image_content($id);
				if ($article['image'] != "") {
					unlink('./assets/img/img_content/'.$article['image']);
				}
				// end hapus gambar
				// ketika ganti gambar
				$upload_data = ['uploads' => $this->upload->data()];
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/img/img_content/'.$upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);

				$data = array(
					'id' => $id,
					'title'=>htmlspecialchars($this->input->post('title', true)),
					'id_theme'=>htmlspecialchars($this->input->post('id_category',true)),
					'content'=>htmlspecialchars($this->input->post('content', true)),
					'image' => $upload_data['uploads']['file_name']
				);

				$this->virgy_m_admin->edit_content($data);
				$this->session->set_flashdata('pesan', 'Content Berhasil Diedit!');
				redirect('virgy_admin/articlecontent');

			} else{
				a:
				// ketika tanpa ganti gambar
				$data = array(
					'id' => $id,
					'title'=>htmlspecialchars($this->input->post('title', true)),
					'id_theme'=>htmlspecialchars($this->input->post('id_category',true)),
					'content'=>htmlspecialchars($this->input->post('content', true)),
				);

				$this->virgy_m_admin->edit_content($data);
				$this->session->set_flashdata('pesan', 'Content Berhasil Diedit!');
				redirect('virgy_admin/articlecontent');
			}
			
		}
		$data = array(
			'title' =>'Edit Content',
			'category' => $this->virgy_m_admin->get_all_category(),
			'article' => $this->virgy_m_admin->get_all_contents_by_id($id),
			'isi' => 'back-end/virgy_v_article_content_edit',
		);

		$this->load->view('layout/virgy_v_wrapper_backend', $data, FALSE);

	}

	// CALLBACK FUNGSI UTK VALIDATION ERROR INPUT KATEGORI
	function check_category($post_string){
		if (is_null($post_string)) {
			$this->form_validation->set_message('check_category', 'Kategori Harus Diisi!');
			return FALSE;
		} else{
			return TRUE;
		}
	}

	public function delete_content($id)
	{
		$data = [
			'id' => $id
		];

		// hapus gambar
		$article = $this->virgy_m_admin->get_image_content($id);
		if ($article['image'] != "") {
			unlink('./assets/img/img_content/'.$article['image']);
		}
		// end hapus gambar

		$this->virgy_m_admin->delete_content($data);
		$this->session->set_flashdata('pesan', 'Article Content Delete Success!');
		redirect('virgy_admin/articlecontent');
	}

	public function delete_content_image($id)
	{
		$data = [
			'id' => $id,
			'image' => null
		];

		// hapus gambar
		$article = $this->virgy_m_admin->get_image_content($id);
		if ($article['image'] != "") {
			unlink('./assets/img/img_content/'.$article['image']);
		}
		// end hapus gambar

		$this->virgy_m_admin->delete_content_image($data);
		redirect('virgy_admin/editcontent/'.$data['id']);
	}
}