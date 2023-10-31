<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->m_security->clientsec();
		$this->load->model('m_data');
		$data['klienticket'] 	= $this->m_data->klienticket()->result();
		$this->load->view('client/dashboard', $data);
	}

	public function feedback()
	{
		$this->m_security->clientsec();
		$id_tic 	= $this->input->post('id_tic');
		$from_klien = array (
				'from_klien'				=> $this->input->post('remark_klien')
			);
		$this->db->where('id_tic', $id_tic);
		$this->db->update('ticket', $from_klien);
		$this->session->set_flashdata('edit', '
					DATA BERHASIL DIUBAH');
		redirect('client/dashboard','refresh');
	}

	public function getdiv(){
		
			$this->load->model('m_data');
			$searchTerm = $this->input->post('searchTerm');
			$response   = $this->m_data->getdiv($searchTerm);
			echo json_encode($response);
		

	}

	public function getcat($id_div)
    {
		$this->load->model('m_data');
        $searchTerm = $this->input->post('searchTerm');
        $response   = $this->m_data->getcat($id_div, $searchTerm);
        echo json_encode($response);
    }

	public function create()
	{
		$this->load->model('m_data');

		/** UNTUK GENERATE NOMOR TIKET */
		$bulan 	  = date('m');
		$iddivision = $this->input->post('id_div');
		$idcategory = $this->input->post('id_cat');
		$idlocation = $this->input->post('id_loc');

		/** UNTUK KIRIM EMAIL */
		$name		= $this->input->post('nama_klien');
		$penerima	= $this->input->post('email_klien');
		$message	= $this->input->post('message');
		$iddepartment	= $this->input->post('id_dept');
		
		/** AMBIL DATA BOT & EMAIL */
		$setupbot   = $this->m_data->databot();
		$emailsetup =  $this->m_data->dataemail();
		$location = $this->m_data->ambillocation($idlocation)->row_array();
		$departmen = $this->m_data->ambildepartment($iddepartment)->row_array();
		$division = $this->m_data->ambildivision($iddivision)->row_array();
		$telegram_group = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();
		$data['location'] = $this->m_data->ambillocation($idlocation)->row_array();
		$data['division'] = $this->m_data->ambildivision($iddivision)->row_array();
		$data['department'] = $this->m_data->ambildepartment($iddepartment)->row_array();
		$data['telegram_group'] = $this->m_data->ambilgrouptele($iddivision,$idlocation)->row_array();


		/** GENERATE NOMOR TICKET */
		$this->db->select('RIGHT(ticket.tic_no,3) as tic_no', FALSE);
		$this->db->order_by('tic_no','DESC');    
		$this->db->limit(1);    
		$query = $this->db->get('ticket');
			if($query->num_rows() <> 0){      
				$data = $query->row();
				$kode = intval($data->tic_no) + 1; 
			}
			else{      
				$kode = 1;  
			}
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
		$kodetampil = "TICK".$bulan."".$idlocation."".$iddivision."".$idcategory."".$batas;

		/** INSERT DATABASE */
		$ticket = array (
			'id_klien' 							=> $this->input->post('id_klien'),
			'tic_email' 						=> $this->input->post('email_klien'),
			'tlp'								=> $this->input->post('telp_klien'),
			'id_div' 							=> $this->input->post('id_div'),
			'id_loc' 							=> $this->input->post('id_loc'),
			'id_dept' 							=> $this->input->post('id_dept'),
			'deskripsi' 						=> $this->input->post('message'),
			'tic_no' 							=> $kodetampil,
			'id_cat' 							=> $this->input->post('id_cat')
		);
		$this->db->insert('ticket', $ticket);

		/** BOT TELEGRAM */
		$secret_token = $setupbot->bot_token;
        $group_id = $telegram_group['groupid'];
        $message_text = "
Dear Team ".$division['div_name'].",
Ada ticket baru, berikut detailnya:

*No Ticket:* ".$kodetampil."
*Nama Klien:* ".$name."
*Lokasi:* ".$location['loc_name']."
*Departmen:* ".$departmen['dept_name']."
*Masalah:* ".$message."

Untuk team terkait, dimohon segera menyelesaikan ticket tersebut.";

		$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $group_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);


		/** KONFIGURASI EMAIL */
		$this->load->library('email');
    	$config = array();
    	$config['charset'] = 'utf-8';
    	$config['useragent'] = 'Codeigniter';
    	$config['protocol']= "smtp";
    	$config['mailtype']= "html";
    	$config['smtp_host']= $emailsetup->smtp_host;//pengaturan smtp
    	$config['smtp_port']= $emailsetup->smtp_port;
    	$config['smtp_timeout']= "400";
    	$config['smtp_user']= $emailsetup->email; // isi dengan email kamu
    	$config['smtp_pass']= $emailsetup->pass; // isi dengan password kamu
    	$config['crlf']="\r\n"; 
    	$config['newline']="\r\n"; 
    	$config['wordwrap'] = TRUE;
    	// //memanggil library email dan set konfigurasi untuk pengiriman email
    	// $this->email->initialize($config);
    	// //konfigurasi pengiriman
    	// $this->email->from($config['smtp_user']);
    	// $this->email->to($penerima);
    	// $this->email->subject("LAPORAN HELPDESK TELAH DITERIMA");
    	// $this->email->message
		// ("Halo ".$name."<br>
		// Terima kasih telah menghubungi kami.<br>
		// Laporan anda akan segera kami proses.<br>
		// Berikut adalah detail laporan anda:<br><br>
		// No Ticket: ".$kodetampil."<br>
		// Masalah: ".$message."<br><br>
		// Kami akan selalu update progress perbaikan melalui email ini.<br><br><br>
		// Terima kasih.<br>
		// Administrator<br>
		// Blucoppia Helpdesk");
    	
		// if($this->email->send())
    	// {
		// 	$this->session->set_flashdata('create', '
		// 			TICKET BERHASIL DIBUAT, CEK EMAIL ANDA');
		// 	redirect('client/dashboard','refresh');
    	// }else
    	// {
       	// 	echo "Berhasil melakukan registrasi, namu gagal mengirim verifikasi email";
		// 	echo '<br />';
        // 	echo $this->email->print_debugger();
   		// }
		$this->session->set_flashdata('create', '
		TICKET BERHASIL DIBUAT');
		redirect('client/dashboard','refresh');
		
	}
}
