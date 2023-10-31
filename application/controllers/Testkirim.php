<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testkirim extends CI_Controller {

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
        $secret_token = "5769285071:AAHirDKk4ewueo819aEU0c4zEVcs2mhWNQ8";
        $telegram_id = "-641907062";
        $message_text = "
Dear Team,
Ada ticket baru, berikut detailnya:

*No Ticket:* TICK/1/2/2121
*Nama:* Januar
*Lokasi:* RPHU PWK
*Departmen:* PRODUKSI
*Masalah:* printer error tidak bisdsa jdsakdsbnadmsa dsal;dnsamcnska hfdjhfdjfhdjbcdj djakldsbakfb.

Untuk team terkait, dimohon segera menyelesaikan ticket tersebut.";

		$url = "https://api.telegram.org/bot" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
    }

}
