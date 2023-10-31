<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

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
		$data['email'] = $this->m_data->getemail();
		$this->load->view('core/email', $data);
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_email = $this->input->post('id_email');
		$email = array (
			'email' 								=> $this->input->post('email'),
			'pass' 									=> $this->input->post('pass'),
			'smtp_host' 							=> $this->input->post('smtp_host'),
			'smtp_port' 							=> $this->input->post('smtp_port')
		);
		$this->db->where('id_email', $id_email);
		$this->db->update('email', $email);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/email','refresh');
	}
}
