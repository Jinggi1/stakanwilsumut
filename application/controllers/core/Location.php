<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

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
		$data['location'] = $this->m_data->data_location()->result();
		$this->load->view('core/location', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$location = array (
			'loc_name' 				=> $this->input->post('loc_name')
		);
		$this->db->insert('location', $location);
		$this->session->set_flashdata('add', '
					DATA BERHASIL DI INPUT');
		redirect('core/location','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_loc 	= $this->input->post('id_loc');
		$loc_name 	= $this->input->post('loc_name');

		$location = array (
				'loc_name'				=> $this->input->post('loc_name')
			);
		$this->db->where('id_loc', $id_loc);
		$this->db->update('location', $location);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/location','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_loc 	= $this->input->post('id_loc');

		$loc_status = array (
				'loc_status'				=> $this->input->post('loc_status')
			);
		$this->db->where('id_loc', $id_loc);
		$this->db->update('location', $loc_status);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/location','refresh');
	}
}
