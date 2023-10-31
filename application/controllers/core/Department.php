<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

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
		$data['department'] = $this->m_data->data_department()->result();
		$this->load->view('core/department', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$department = array (
			'dept_name' 				=> $this->input->post('dept_name')
		);
		$this->db->insert('department', $department);
		$this->session->set_flashdata('add', '
					DATA BERHASIL DITAMBAHKAN');
		redirect('core/department','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_dept 	= $this->input->post('id_dept');
		$dept_name 	= $this->input->post('dept_name');

		$department = array (
				'dept_name'				=> $this->input->post('dept_name')
			);
		$this->db->where('id_dept', $id_dept);
		$this->db->update('department', $department);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/department','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_dept 	= $this->input->post('id_dept');

		$dept_status = array (
				'dept_status'				=> $this->input->post('dept_status')
			);
		$this->db->where('id_dept', $id_dept);
		$this->db->update('department', $dept_status);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/department','refresh');
	}
}
