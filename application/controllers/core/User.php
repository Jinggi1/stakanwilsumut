<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->m_security->usersec();
		$this->load->model('m_data');
		$data['user'] = $this->m_data->data_user()->result();
		$data['division'] = $this->m_data->getdivision();
		$data['location'] = $this->m_data->getlocation();
		$this->load->view('core/user', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$this->load->model('m_data');
		$emailsetup =  $this->m_data->dataemail();
		$password = $this->input->post('password');
		$penerima = $this->input->post('email');
		$name = $this->input->post('name');
		$username = $this->input->post('username');
		$login = base_url('login');
		$user = array (
			'name' 								=> $this->input->post('name'),
			'email' 							=> $this->input->post('email'),
			'username' 							=> $this->input->post('username'),
			'phone' 							=> $this->input->post('phone'),
			'id_div' 							=> $this->input->post('id_div'),
			'id_loc' 							=> $this->input->post('id_loc'),
			'level' 							=> $this->input->post('level'),
			'password' 							=> md5($password)
		);
		$this->db->insert('user', $user);

		// Konfigurasi email
		$this->load->library('email');
    	$config = array();
    	$config['charset'] = 'utf-8';
    	$config['useragent'] = 'Codeigniter';
    	$config['protocol']= "smtp";
    	$config['mailtype']= "html";
    	$config['smtp_host']= $emailsetup->smtp_host;//pengaturan smtp
    	$config['smtp_port']= $emailsetup->smtp_port;
    	$config['smtp_timeout']= "400";
    	$config['smtp_user']= $emailsetup->email; // isi dengan email kamu
    	$config['smtp_pass']= $emailsetup->pass; // isi dengan password kamu
    	$config['crlf']="\r\n"; 
    	$config['newline']="\r\n"; 
    	$config['wordwrap'] = TRUE;
    	// //memanggil library email dan set konfigurasi untuk pengiriman email
    	// $this->email->initialize($config);
    	// //konfigurasi pengiriman
    	// $this->email->from($config['smtp_user']);
    	// $this->email->to($penerima);
    	// $this->email->subject("Registrasi Helpdesk Berhasil");
    	// $this->email->message("Halo ".$name."<br>Anda telah terdaftar di helpdesk blucoppia.<br>Berikut adalah detail login anda:<br><br>username: ".$username."<br>password: ".$password."<br><br>Anda dapat melakukan login di link ini<br>".$login."<br><br>Terima kasih.<br>Administrator");
    	// if($this->email->send())
    	// {
		// 	$this->session->set_flashdata('add', '
		// 			DATA BERHASIL DITAMBAHKAN');
		// 	redirect('core/user','refresh');
    	// }else
    	// {
       	// 	echo "Berhasil melakukan registrasi, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		//}
		$this->session->set_flashdata('add', '
		DATA BERHASIL DITAMBAHKAN');
		redirect('core/user','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_user = $this->input->post('id_user');
		$user = array (
			'name' 								=> $this->input->post('name'),
			'email' 							=> $this->input->post('email'),
			'username' 							=> $this->input->post('username'),
			'phone' 							=> $this->input->post('phone'),
			'id_div' 							=> $this->input->post('id_div'),
			'id_loc' 							=> $this->input->post('id_loc'),
			'level' 							=> $this->input->post('level')
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $user);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/user','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_user 	= $this->input->post('id_user');

		$user_status = array (
				'user_status'				=> $this->input->post('user_status')
			);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $user_status);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/user','refresh');
	}

	public function reset()
	{
		$this->m_security->usersec();
		$this->load->model('m_data');
		$emailsetup =  $this->m_data->dataemail();
		$password = $this->input->post('password');
		$penerima = $this->input->post('email');
		$name = $this->input->post('name');
		$id_user 	= $this->input->post('id_user');
		$login = base_url('login');
		$user_status = array (
			'password'				=> md5($password)
		);
	$this->db->where('id_user', $id_user);
	$this->db->update('user', $user_status);

		// Konfigurasi email
		$this->load->library('email');
    	$config = array();
    	$config['charset'] = 'utf-8';
    	$config['useragent'] = 'Codeigniter';
    	$config['protocol']= "smtp";
    	$config['mailtype']= "html";
    	$config['smtp_host']= $emailsetup->smtp_host;//pengaturan smtp
    	$config['smtp_port']= $emailsetup->smtp_port;
    	$config['smtp_timeout']= "400";
    	$config['smtp_user']= $emailsetup->email; // isi dengan email kamu
    	$config['smtp_pass']= $emailsetup->pass; // isi dengan password kamu
    	$config['crlf']="\r\n"; 
    	$config['newline']="\r\n"; 
    	$config['wordwrap'] = TRUE;
    	// //memanggil library email dan set konfigurasi untuk pengiriman email
    	// $this->email->initialize($config);
    	// //konfigurasi pengiriman
    	// $this->email->from($config['smtp_user']);
    	// $this->email->to($penerima);
    	// $this->email->subject("Reset Password Berhasil");
    	// $this->email->message("Halo ".$name."<br>Password anda telah direset.<br>Berikut adalah password baru anda:<br><br>password: ".$password."<br><br>Anda dapat melakukan login di link ini<br>".$login."<br><br>Terima kasih.<br>Administrator");
    	// if($this->email->send())
    	// {
		// 	$this->session->set_flashdata('edit', '
		// 			DATA BERHASIL DIUBAH');
		// 	redirect('core/user','refresh');
    	// }else
    	// {
       	// 	echo "Berhasil melakukan registrasi, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		// }
		$this->session->set_flashdata('edit', '
		DATA BERHASIL DIUBAH');
		redirect('core/user','refresh');
	}
}
