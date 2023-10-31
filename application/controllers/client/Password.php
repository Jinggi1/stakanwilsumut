<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

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
		$this->m_security->clientsec();
		$this->load->view('client/password');
	}

	public function change()
	{
		$this->m_security->clientsec();
		$id_klien 	= $this->input->post('id_klien');
		$oldpassword = $this->input->post('oldpassword');
		$newpassword = $this->input->post('newpassword');
		$datapassword = $this->input->post('datapassword');

		if($datapassword == md5($oldpassword)){
			$klien_status = array (
				'password_klien'				=> md5($newpassword)
			);
			$this->db->where('id_klien', $id_klien);
			$this->db->update('klien', $klien_status);
			$this->session->set_flashdata('msg', '
			<div class="alert alert-warning">
				<h4>Login Gagal</h4>
				<p>Password berhasil dirubah, silakan login kembali!</p>
			</div>
			');
			redirect('login_client', 'refresh');
		}else{
			$this->session->set_flashdata('error', '
					PASSWORD ANDA SALAH!');
			redirect('client/password','refresh');
		}


		
	}
}
