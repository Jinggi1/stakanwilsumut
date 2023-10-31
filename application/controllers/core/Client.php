<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

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
		$data['klien'] = $this->m_data->data_klien()->result();
		$data['department'] = $this->m_data->getdepartment();
		$data['location'] = $this->m_data->getlocation();
		$this->load->view('core/klien', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$this->load->model('m_data');
		$emailsetup_klien =  $this->m_data->dataemail();
		$password_klien = $this->input->post('password_klien');
		$penerima_klien = $this->input->post('email_klien');
		$nama_klien = $this->input->post('nama_klien');
		$username_klien = $this->input->post('username_klien');
		$login = base_url();
		$klien = array (
			'nama_klien' 								=> $this->input->post('nama_klien'),
			'email_klien' 							    => $this->input->post('email_klien'),
			'username_klien' 							=> $this->input->post('username_klien'),
			'telp_klien' 							    => $this->input->post('telp_klien'),
			'dept_klien' 							    => $this->input->post('id_dept'),
			'location_klien' 							=> $this->input->post('id_loc'),
			'password_klien' 							=> md5($password_klien)
		);
		$this->db->insert('klien', $klien);

		// Konfigurasi email
		$this->load->library('email');
    	$config = array();
    	$config['charset'] = 'utf-8';
    	$config['useragent'] = 'Codeigniter';
    	$config['protocol']= "smtp";
    	$config['mailtype']= "html";
    	$config['smtp_host']= $emailsetup_klien->smtp_host;//pengaturan smtp
    	$config['smtp_port']= $emailsetup_klien->smtp_port;
    	$config['smtp_timeout']= "400";
    	$config['smtp_user']= $emailsetup_klien->email; // isi dengan email kamu
    	$config['smtp_pass']= $emailsetup_klien->pass; // isi dengan password kamu
    	$config['crlf']="\r\n"; 
    	$config['newline']="\r\n"; 
    	$config['wordwrap'] = TRUE;
    	// //memanggil library email dan set konfigurasi untuk pengiriman email
    	// $this->email->initialize($config);
    	// //konfigurasi pengiriman
    	// $this->email->from($config['smtp_user']);
    	// $this->email->to($penerima_klien);
    	// $this->email->subject("Registrasi Helpdesk Berhasil");
    	// $this->email->message("Halo ".$nama_klien."<br>Anda telah terdaftar di helpdesk blucoppia.<br>Berikut adalah detail login anda:<br><br>username: ".$username_klien."<br>password: ".$password_klien."<br><br>Anda dapat melakukan login di link ini<br>".$login."<br><br>Terima kasih.<br>Administrator");
    	// if($this->email->send())
    	// {
		// 	$this->session->set_flashdata('add', '
		// 			DATA BERHASIL DITAMBAHKAN');
		// 	redirect('core/client','refresh');
    	// }else
    	// {
       	// 	echo "Berhasil melakukan registrasi, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		// }
		$this->session->set_flashdata('add', '
		DATA BERHASIL DITAMBAHKAN');
		redirect('core/client','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_klien = $this->input->post('id_klien');
		$klien = array (
			'nama_klien' 						=> $this->input->post('nama_klien'),
			'email_klien' 						=> $this->input->post('email_klien'),
			'username_klien' 					=> $this->input->post('username_klien'),
			'telp_klien' 						=> $this->input->post('telp_klien'),
			'dept_klien' 						=> $this->input->post('id_dept'),
			'location_klien' 					=> $this->input->post('id_loc'),
		);
		$this->db->where('id_klien', $id_klien);
		$this->db->update('klien', $klien);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/client','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_klien 	= $this->input->post('id_klien');

		$status_klien = array (
				'status_klien'				=> $this->input->post('status_klien')
			);
		$this->db->where('id_klien', $id_klien);
		$this->db->update('klien', $status_klien);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/client','refresh');
	}

	public function reset()
	{
		$this->m_security->usersec();
		$this->load->model('m_data');
		$emailsetup =  $this->m_data->dataemail();
		$password = $this->input->post('password_klien');
		$penerima = $this->input->post('email_klien');
		$name = $this->input->post('nama_klien');
		$id_klien 	= $this->input->post('id_klien');
		$login = base_url();
		$klien_status = array (
			'password_klien'				=> md5($password)
		);
	$this->db->where('id_klien', $id_klien);
	$this->db->update('klien', $klien_status);

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
		// 	redirect('core/client','refresh');
    	// }else
    	// {
       	// 	echo "Berhasil melakukan registrasi, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		// }
		$this->session->set_flashdata('edit', '
		DATA BERHASIL DIUBAH');
		redirect('core/client','refresh');
	}
}
