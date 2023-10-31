<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends CI_Controller {

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
		$data['division'] = $this->m_data->data_division()->result();
		$this->load->view('core/division', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$division = array (
			'div_name' 				=> $this->input->post('div_name')
		);
		$this->db->insert('division', $division);
		$this->session->set_flashdata('add', '
					DATA BERHASIL DITAMBAHKAN');
		redirect('core/division','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_div 	= $this->input->post('id_div');
		$div_name 	= $this->input->post('div_name');

		$division = array (
				'div_name'				=> $this->input->post('div_name')
			);
		$this->db->where('id_div', $id_div);
		$this->db->update('division', $division);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/division','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_div 	= $this->input->post('id_div');

		$div_status = array (
				'div_status'				=> $this->input->post('div_status')
			);
		$this->db->where('id_div', $id_div);
		$this->db->update('division', $div_status);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/division','refresh');
	}
}
