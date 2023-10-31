<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_telegram extends CI_Controller {

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
		$data['telegram_group'] = $this->m_data->data_telegroup()->result();
		$data['division'] 		= $this->m_data->getdivision();
		$data['location'] 		= $this->m_data->getlocation();
		$this->load->view('core/group_telegram', $data);
	}

	public function add()
	{
		$this->m_security->usersec();
		$telegroup = array (
			'groupid' 								=> $this->input->post('groupid'),
			'group_name' 							=> $this->input->post('group_name'),
			'id_div' 								=> $this->input->post('id_div'),
			'id_loc' 								=> $this->input->post('id_loc'),
		);
		$this->db->insert('telegram_group', $telegroup);
		$this->session->set_flashdata('add', '
					DATA BERHASIL DITAMBAH');
		redirect('core/group_telegram','refresh');
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_group = $this->input->post('id_group');
		$telegroup = array (
			'groupid' 								=> $this->input->post('groupid'),
			'group_name' 							=> $this->input->post('group_name'),
			'id_div' 								=> $this->input->post('id_div'),
			'id_loc' 								=> $this->input->post('id_loc'),
		);
		$this->db->where('id_group', $id_group);
		$this->db->update('telegram_group', $telegroup);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/group_telegram','refresh');
	}
}
