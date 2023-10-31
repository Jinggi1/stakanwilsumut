<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$data['category'] = $this->m_data->data_category()->result();
		$data['division'] = $this->m_data->getdivision();
		$this->load->view('core/category', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$category = array (
			'id_div' 						=> $this->input->post('id_div'),
			'category_name' 				=> $this->input->post('category_name'),
		);
		$this->db->insert('category', $category);
		$this->session->set_flashdata('add', '
					DATA BERHASIL DITAMBAHKAN');
		redirect('core/category','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_category 	= $this->input->post('id_category');
		$id_div 		= $this->input->post('id_div');
		$div_name 		= $this->input->post('div_name');

		$category = array (
				'category_name'				=> $this->input->post('category_name'),
				'id_div'					=> $this->input->post('id_div')
			);
		$this->db->where('id_category', $id_category);
		$this->db->update('category', $category);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/category','refresh');
	}

	public function activation()
	{
		$this->m_security->usersec();
		$id_category 	= $this->input->post('id_category');

		$cat_status = array (
				'cat_status'				=> $this->input->post('cat_status')
			);
		$this->db->where('id_category', $id_category);
		$this->db->update('category', $cat_status);
		$this->session->set_flashdata('activation', '
					AKTIVASI DATA BERHASIL DIUBAH');
		redirect('core/category','refresh');
	}	
}
