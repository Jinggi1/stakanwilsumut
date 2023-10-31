<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

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
		$this->m_security->globalsec();
		$this->load->model('m_data');
		$data['openticket'] = $this->m_data->openticket()->result();
		$data['progressticket'] = $this->m_data->progressticket()->result();
		$data['finishticket'] = $this->m_data->finishticket()->result();
		$this->load->view('core/ticket', $data);
	}

	public function execution()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->m_security->globalsec();
		$this->load->model('m_data');
		$idlocation 	= $this->input->post('id_loc');
		$iddivision		= $this->input->post('id_div');
		$email		= $this->input->post('email');
		$id_user	= $this->input->post('id_user');
		$id_tic		= $this->input->post('id_tic');
		$nama_klien	= $this->input->post('nama_klien');
		$tic_no		= $this->input->post('tic_no');
		//$date = new DateTime(date('H:i:s'), new DateTimeZone('Asia/Jakarta'));
		$execution_time		= date('H:i:s');
		

		$ticket = array (
				'status'				=> $this->input->post('status'),
				'execution_time'				=> $execution_time,
				'id_user'				=> $id_user
			);
		

// 		/** AMBIL DATA BOT & EMAIL */
// 		$setupbot   = $this->m_data->databot();
// 		$location = $this->m_data->ambillocation($idlocation)->row_array();
// 		$division = $this->m_data->ambildivision($iddivision)->row_array();
// 		$user		  = $this->m_data->ambiluser($id_user)->row_array();
// 		$telegram_group = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();
// 		$data['location'] = $this->m_data->ambillocation($idlocation)->row_array();
// 		$data['division'] = $this->m_data->ambildivision($iddivision)->row_array();
// 		$data['user'] = $this->m_data->ambiluser($id_user)->row_array();
// 		$data['telegram_group'] = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();

// 		/** BOT TELEGRAM */
// 		$secret_token = $setupbot->bot_token;
//         $group_id = $telegram_group['groupid'];
//         $message_text = "
// Dear Team ".$division['div_name'].",

// Nomor Ticket *".$tic_no."* telah diambil oleh *".$user['name']."*.

// Terima Kasih";

// 		$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $group_id;
//         $url = $url . "&text=" . urlencode($message_text);
//         $ch = curl_init();
//         $optArray = array(
//                 CURLOPT_URL => $url,
//                 CURLOPT_RETURNTRANSFER => true
//         );
//         curl_setopt_array($ch, $optArray);
//         $result = curl_exec($ch);
//         curl_close($ch);

		$this->db->where('id_tic', $id_tic);
		$this->db->update('ticket', $ticket);
		$this->session->set_flashdata('edit', '
					TICKET TELAH DIAMBIL');
		redirect('core/ticket','refresh');
	}

	public function finish()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->m_security->globalsec();
		$this->load->model('m_data');
		$emailsetup =  $this->m_data->dataemail();
		$setupbot   = $this->m_data->databot();

		$idlocation = $this->input->post('id_loc');
		$iddivision	= $this->input->post('id_div');
		$penerima	= $this->input->post('email');
		$id_user	= $this->input->post('id_user');
		$id_tic		= $this->input->post('id_tic');
		$tic_no		= $this->input->post('tic_no');
		$tanggal	= date('y-m-d');
		$nama_klien	= $this->input->post('nama_klien');
		$message	= $this->input->post('message');
		$remakrs	= $this->input->post('remarks');
		$finish_time		= date('H:i:s');

		$ticket = array (
				'status'				=> $this->input->post('status'),
				'end_date'				=> $tanggal,
				'finish_time'				=> $finish_time,
				'remarks'				=> $this->input->post('remarks'),
				'id_user'				=> $id_user
			);
		$this->db->where('id_tic', $id_tic);
		$this->db->update('ticket', $ticket);
		
// 		/** AMBIL DATA BOT & EMAIL */
// 		$setupbot   = $this->m_data->databot();
// 		$location = $this->m_data->ambillocation($idlocation)->row_array();
// 		$division = $this->m_data->ambildivision($iddivision)->row_array();
// 		$user		  = $this->m_data->ambiluser($id_user)->row_array();
// 		$telegram_group = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();
// 		$data['location'] = $this->m_data->ambillocation($idlocation)->row_array();
// 		$data['division'] = $this->m_data->ambildivision($iddivision)->row_array();
// 		$data['user'] = $this->m_data->ambiluser($id_user)->row_array();
// 		$data['telegram_group'] = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();

// 		/** BOT TELEGRAM */
// 		$secret_token = $setupbot->bot_token;
//         $group_id = $telegram_group['groupid'];
//         $message_text = "
// Dear Team ".$division['div_name'].",

// Nomor Ticket *".$tic_no."* telah diselesaikan oleh *".$user['name']."*.

// Terima Kasih";

// 		$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $group_id;
//         $url = $url . "&text=" . urlencode($message_text);
//         $ch = curl_init();
//         $optArray = array(
//                 CURLOPT_URL => $url,
//                 CURLOPT_RETURNTRANSFER => true
//         );
//         curl_setopt_array($ch, $optArray);
//         $result = curl_exec($ch);
//         curl_close($ch);

		/** KONFIGURASI EMAIL */
		// $this->load->library('email');
    	// $config = array();
    	// $config['charset'] = 'utf-8';
    	// $config['useragent'] = 'Codeigniter';
    	// $config['protocol']= "smtp";
    	// $config['mailtype']= "html";
    	// $config['smtp_host']= $emailsetup->smtp_host;//pengaturan smtp
    	// $config['smtp_port']= $emailsetup->smtp_port;
    	// $config['smtp_timeout']= "400";
    	// $config['smtp_user']= $emailsetup->email; // isi dengan email kamu
    	// $config['smtp_pass']= $emailsetup->pass; // isi dengan password kamu
    	// $config['crlf']="\r\n"; 
    	// $config['newline']="\r\n"; 
    	// $config['wordwrap'] = TRUE;
    	// //memanggil library email dan set konfigurasi untuk pengiriman email
    	// $this->email->initialize($config);
    	// //konfigurasi pengiriman
    	// $this->email->from($config['smtp_user']);
    	// $this->email->to($penerima);
    	// $this->email->subject("LAPORAN HELPDESK TELAH DISELESAIKAN");
    	// $this->email->message
		// ("Halo ".$nama_klien."<br>
		// Ticket anda telah diselesaikan.
		// Berikut adalah detail laporan anda:<br><br>
		// No Ticket: ".$tic_no."<br>
		// Troubleshooter: ".$user['name']."<br>
		// Masalah: ".$message."<br><br>
		// <br><br><br>
		// Terima kasih.<br>
		// Administrator<br>
		// Blucoppia Helpdesk");
    	
		// if($this->email->send())
    	// {
		// 	$this->session->set_flashdata('edit', '
		// 			TICKET TELAH DISELESAIKAN');
		// 	redirect('core/ticket','refresh');
    	// }else
    	// {
       	// 	echo "Finish, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		// } 
		$this->session->set_flashdata('edit', '
		TICKET TELAH DISELESAIKAN');
		redirect('core/ticket','refresh');
	}
}
