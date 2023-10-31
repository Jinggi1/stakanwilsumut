<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot_telegram extends CI_Controller {

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
		$data['telegram_bot'] 			= $this->m_data->data_telebot()->result();
		$data['telegram_group'] 		= $this->m_data->gettelegroup();
		$this->load->view('core/bot_telegram', $data);
	}

	public function edit()
	{
		$this->m_security->usersec();
		$id_bot = $this->input->post('id_bot');
		$telebot = array (
			'bot_token' 						=> $this->input->post('bot_token'),
			'bot_name' 							=> $this->input->post('bot_name')
		);
		$this->db->where('id_bot', $id_bot);
		$this->db->update('telegram_bot', $telebot);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('core/bot_telegram','refresh');
	}
}
