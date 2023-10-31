<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_security extends CI_Model {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function usersec()
	{
		$akses = $this->session->userdata('level');
		if(empty($akses))
		{
			$this->session->sess_destroy();
			redirect('welcome','refresh');
		}
		else if ($akses == '2')
		{
			echo 'ANDA TIDAK MENDAPATKAN AKSES KE HALAMAN INI!!';
			redirect('core/home','refresh');
		}
	}

	public function globalsec()
	{
		$akses = $this->session->userdata('username');
		if(empty($akses))
		{
			$this->session->sess_destroy();
			echo 'ANDA TIDAK MENDAPATKAN AKSES KE HALAMAN INI!!';
			redirect('welcome','refresh');
		}
	}

	public function clientsec()
	{
		$akses = $this->session->userdata('username_klien');
		if(empty($akses))
		{
			$this->session->sess_destroy();
			echo 'ANDA TIDAK MENDAPATKAN AKSES KE HALAMAN INI!!';
			redirect('login_client','refresh');
		}
	}

	public function khususlogin()
	{
		$akses = $this->session->userdata('username');
		if($akses=$akses)
		{
			redirect('core/home','refresh');
		}
	}

}
