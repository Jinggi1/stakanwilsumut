<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data extends CI_Model {

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

	/** MODEL DATA Location */
	public function data_location()
	{
		
		$location = $this->db->get('location') ; 
		return $location;
	}
	/** END MODEL DATA Location */

	/** MODEL DATA DEPARTEMEN */
	public function data_department()
	{
		
		$department = $this->db->get('department') ; 
		return $department;
	}
	/** MODEL DATA DEPARTEMEN */

	/** MODEL DATA Division */
	public function data_division()
	{
		
		$division = $this->db->get('division') ; 
		return $division;
	}

	/** MODEL DATA Category */
	public function data_category()
	{
		$this->db->get('category'); //mengambil semua data dari tabel 
    	$this->db->join('division', 'division.id_div = category.id_div', 'left'); //menyatukan tabel division menggunakan primary
		$category = $this->db->get_where('category') ; 
		return $category;
	}
	/** END MODEL DATA Category */
	
	/** MODEL FOR OPTION DIVISION */
	public function getdivision()
	{
		$query = $this->db->query('SELECT * FROM division WHERE div_status=1');
		return $query->result();

	}
	/** END MODEL FOR OPTION DIVISION */

	

	/** MODEL DATA EMAIL */
	public function getemail()
	{
		$query = $this->db->query('SELECT * FROM email');
		return $query->result();

	}
	/** END MODEL FOR DATA EMAIL */

	public function dataemail()
	{
		$query = $this->db->get('email');
		return $query->row();
	}

	public function databot()
	{
		$bot_telegram = $this->db->get('telegram_bot');
		return $bot_telegram->row();
	}

	/** MODEL FOR OPTION DIVISION */
	public function getlocation()
	{
		$query = $this->db->query('SELECT * FROM location WHERE loc_Status=1');
		return $query->result();

	}
	/** END MODEL FOR OPTION DIVISION */

	/** MODEL FOR OPTION DIVISION */
	public function getdepartment()
	{
		$query = $this->db->query('SELECT * FROM department WHERE dept_Status=1');
		return $query->result();

	}
	/** END MODEL FOR OPTION DIVISION */

	/** MODEL FOR OPTION TELEGRAM GROUP */
	public function gettelegroup()
	{
		$query = $this->db->query('SELECT * FROM telegram_group');
		return $query->result();

	}
	/** END MODEL FOR OPTION TELEGRAM GROUP */

	

	/** MODEL DATA telegroup */
	public function data_telegroup()
	{
		$this->db->get('telegram_group'); //mengambil semua data dari tabel 
    	$this->db->join('division', 'division.id_div = telegram_group.id_div', 'left'); //menyatukan tabel division menggunakan primary
		$this->db->join('location', 'location.id_loc = telegram_group.id_loc', 'left'); //menyatukan tabel location menggunakan primary
		$telegram_group = $this->db->get_where('telegram_group') ; 
		return $telegram_group;
	}
	/** END MODEL DATA telegroup */

	/** MODEL DATA telebot */
	public function data_telebot()
	{
		$this->db->get('telegram_bot'); //mengambil semua data dari tabel 
    	$this->db->join('telegram_group', 'telegram_group.id_group = telegram_bot.id_group', 'left'); //menyatukan tabel division menggunakan primary
		$telegram_bot = $this->db->get_where('telegram_bot') ; 
		return $telegram_bot;
	}
	/** END MODEL DATA telebot */

	/** MODEL DATA User */
	public function data_user()
	{
		$this->db->get('user'); //mengambil semua data dari tabel 
    	$this->db->join('division', 'division.id_div = user.id_div', 'left'); //menyatukan tabel division menggunakan primary
		$this->db->join('location', 'location.id_loc = user.id_loc', 'left'); //menyatukan tabel location menggunakan primary
		$user = $this->db->get_where('user') ; 
		return $user;
	}
	/** END MODEL DATA user */

	/** MODEL DATA User */
	public function data_klien()
	{
		$this->db->get('klien'); //mengambil semua data dari tabel 
    	$this->db->join('department', 'department.id_dept = klien.dept_klien', 'left'); //menyatukan tabel division menggunakan primary
		$this->db->join('location', 'location.id_loc = klien.location_klien', 'left'); //menyatukan tabel location menggunakan primary
		$klien = $this->db->get_where('klien') ; 
		return $klien;
	}
	/** END MODEL DATA user */

	public function datacat($id_div){
		$query = $this->db->query("SELECT * FROM category WHERE id_div='".$id_div."' ORDER BY category ASC");
		return $query->result();

	}

	public function getdiv($searchTerm = "")
    {        
        $this->db->select('id_div, div_name');
        $this->db->where("div_name like '%" . $searchTerm . "%' ");
		$this->db->where("div_status=1");
        $this->db->order_by('id_div', 'asc');
        $fetched_records = $this->db->get('division');
        $datadiv = $fetched_records->result_array();
 
        $data = array();
        foreach ($datadiv as $div) {
            $data[] = array("id" => $div['id_div'], "text" => $div['div_name']);
        }
        return $data;
    }
	
	public function getcat($id_div, $searchTerm = "")
    {        
        $this->db->select('id_category, category_name');
        $this->db->where('id_div', $id_div);
        $this->db->where("category_name like '%" . $searchTerm . "%' ");
		$this->db->where("cat_status=1");    
        $this->db->order_by('id_category', 'asc');
        $fetched_records = $this->db->get('category');
        $datacat = $fetched_records->result_array();
 
        $data = array();
        foreach ($datacat as $cat) {
            $data[] = array("id" => $cat['id_category'], "text" => $cat['category_name']);
        }
        return $data;
    }

	//** REPORT TICKET */
	public function allticket()
	{
		$akses = $this->session->userdata('level');
		$location = $this->session->userdata('id_loc');
		$division = $this->session->userdata('id_div');

		if ($akses=='1'){
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$ticket = $this->db->get_where('ticket') ; 
			return $ticket;
		}else{
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('ticket.id_loc',$location);
			$this->db->where('ticket.id_div',$division);
			$ticket = $this->db->get_where('ticket') ; 
			return $ticket;
		}
	}

		//** PROSES TICKET */
	public function openticket()
	{
		$akses = $this->session->userdata('level');
		$location = $this->session->userdata('id_loc');
		$division = $this->session->userdata('id_div');

		if ($akses=='1'){
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','1');
			$openticket = $this->db->get_where('ticket') ; 
			return $openticket;
		}else{
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','1');
			$this->db->where('ticket.id_loc',$location);
			$this->db->where('ticket.id_div',$division);
			$openticket = $this->db->get_where('ticket') ; 
			return $openticket;
		}
	}

	public function progressticket()
	{
		$akses = $this->session->userdata('level');
		$location = $this->session->userdata('id_loc');
		$division = $this->session->userdata('id_div');

		if ($akses=='1'){
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','2');
			$progressticket = $this->db->get_where('ticket') ; 
			return $progressticket;
		}else{
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','2');
			$this->db->where('ticket.id_loc',$location);
			$this->db->where('ticket.id_div',$division);
			$progressticket = $this->db->get_where('ticket') ; 
			return $progressticket;
		}
	}

	public function finishticket()
	{
		$akses = $this->session->userdata('level');
		$location = $this->session->userdata('id_loc');
		$division = $this->session->userdata('id_div');

		if ($akses=='1'){
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','3');
			$finishticket = $this->db->get_where('ticket') ; 
			return $finishticket;
		}else{
			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('status','3');
			$this->db->where('ticket.id_loc',$location);
			$this->db->where('ticket.id_div',$division);
			$finishticket = $this->db->get_where('ticket') ; 
			return $finishticket;
		}
	}

	/** UNTUK SETUP TICKET */
	public function ambildivision($iddivision)
	{
		return $this->db->get_where('division', array('id_div'=>$iddivision));

	}

	public function ambillocation($idlocation)
	{
		return $this->db->get_where('location', array('id_loc'=>$idlocation));

	}

	public function ambildepartment($iddepartment)
	{
		return $this->db->get_where('department', array('id_dept'=>$iddepartment));

	}

	public function ambilgrouptele($iddivision,$idlocation)
	{
		return $this->db->get_where('telegram_group', array('id_div'=>$iddivision, 'id_loc'=>$idlocation));

	}

	public function ambiluser($id_user)
	{
		return $this->db->get_where('user', array('id_user'=>$id_user));

	}


	public function klienticket()
	{
		$id_klien = $this->session->userdata('id_klien');

			$this->db->get('ticket');
			$this->db->join('user', 'user.id_user = ticket.id_user', 'left');
			$this->db->join('department', 'department.id_dept = ticket.id_dept', 'left');
			$this->db->join('klien', 'klien.id_klien = ticket.id_klien', 'left');
			$this->db->join('category', 'category.id_category = ticket.id_cat', 'left');
			$this->db->join('division', 'division.id_div = ticket.id_div', 'left'); //menyatukan tabel division menggunakan primary
			$this->db->join('location', 'location.id_loc = ticket.id_loc', 'left'); //menyatukan tabel location menggunakan primary
			$this->db->where('ticket.id_klien', $id_klien);
			$klienticket = $this->db->get_where('ticket') ; 
			return $klienticket;
		
	}
}
