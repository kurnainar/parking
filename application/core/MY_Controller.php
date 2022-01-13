<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');
	
class MY_Controller extends CI_Controller{

	protected $log_id 		= '';
	protected $log_user 	= '';
	protected $log_name		= '';
	protected $response 	= [];
	protected $fragment 	= [];
	protected $slotMobil	= 50;
	protected $slotMotor	= 50;
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		if ($this->hasLogin()) {
			$this->log_id 	= $this->session->userdata(SESS)->log_id;
			$this->log_user = $this->session->userdata(SESS)->log_user;
			$this->log_name = $this->session->userdata(SESS)->log_name;
			$this->fragment['log_name'] = $this->log_name;
			$this->fragment['menu_header'] = $this->sitemodel->get_header_menu();
			$this->fragment['menu_child'] = $this->sitemodel->get_child_menu();
		}
	}
	
	function hasLogin() {
		return $this->session->userdata(SESS);
	}

	function compress_image($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);

		return true;
	}
}