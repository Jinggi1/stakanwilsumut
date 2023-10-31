<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {


	public function userlogin($username,$password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('user');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$sess = array('id_user'				=> $row->id_user,
							  'email' 				=> $row->email,
							  'username'			=> $row->username,
							  'name'				=> $row->name,
							  'level'				=> $row->level,
							  'id_div'				=> $row->id_div,
							  'id_loc'				=> $row->id_loc,
							  'user_status'			=> $row->user_status,
							  'password'			=> $row->password,

					          );
				$this->session->set_userdata($sess);
				if($row->user_status == '1')
				{
					redirect('core/home');
				}else
				{
					$this->session->set_flashdata('msg', '
					<div class="alert alert-warning">
                    	<h4>Login Gagal</h4>
                    	<p>Akun anda tidak aktif, hubungi administrator!</p>
                	</div>
					');
					redirect('login', 'refresh');
				}
				
			}
		} else
		{
			$this->session->set_flashdata('msg', '
			<div class="alert alert-danger">
                    <h4>Login Gagal</h4>
                    <p>Username atau Password salah!</p>
                </div>
			');
			redirect('login','refresh');
		}
		
	}

	public function klienlogin($username,$password)
	{
		$this->db->where('username_klien', $username);
		$this->db->where('password_klien', $password);
		$query = $this->db->get('klien');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$sess = array('id_klien'			=> $row->id_klien,
							  'email_klien' 		=> $row->email_klien,
							  'username_klien'		=> $row->username_klien,
							  'telp_klien'			=> $row->telp_klien,
							  'nama_klien'			=> $row->nama_klien,
							  'dept_klien'			=> $row->dept_klien,
							  'location_klien'		=> $row->location_klien,
							  'status_klien'		=> $row->status_klien,
							  'password_klien'		=> $row->password_klien,

					          );
				$this->session->set_userdata($sess);
				if($row->status_klien == '1')
				{
					redirect('client/dashboard');
				}else
				{
					$this->session->set_flashdata('msg', '
					<div class="alert alert-warning">
                    	<h4>Login Gagal</h4>
                    	<p>Akun anda tidak aktif, hubungi administrator!</p>
                	</div>
					');
					redirect('login_client', 'refresh');
				}
				
			}
		} else
		{
			$this->session->set_flashdata('msg', '
			<div class="alert alert-danger">
                    <h4>Login Gagal</h4>
                    <p>Username atau Password salah!</p>
                </div>
			');
			redirect('login_client','refresh');
		}
		
	}

	
}

