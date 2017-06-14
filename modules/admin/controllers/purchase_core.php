<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  Purchase Controller
 *
 * This class handles Purchase management related functionality
 *
 * @package		Admin
 * @subpackage	Purchase
 *  		 
 *  
 */

class Purchase_core extends CI_Controller {
	
	
	 
 		
		
	public function __construct()
	{
		parent::__construct();


		is_installed(); #defined in auth helper

		checksavedlogin(); #defined in auth helper

		if(!is_admin() && !is_agent())

		{

			if(count($_POST)<=0)

			$this->session->set_userdata('req_url',current_url());

			redirect(site_url('admin/index'));

		}



		}
	 
	public function index()
	{
		// $this->regdomain();
		// echo "Test purchagse core 2 ";
	
	}
	
	function regdomain()
	{
		
			// echo "Test purchagse core 3 "; //ng debug 
		/* 	
			if this is the current url that mean the user already made the login 
			 and we are here to check the payment of the purchase so we will rdirect
			 to the admin dashboard after we check if its admin 
		
		 */
		$this->session->set_userdata('form_key',rand(1,500));
	
	// $data = array('error'=>'<div class="alert alert-danger" style="margin-top:10px;">Login Failed</div>');
		// $this->load->view('admin/regdomain_view',$data);		
		
		if(is_admin()){
		redirect(site_url('admin'));
		}else{
		echo "Not Admin";
		}
	}

}

/* End of file purchase.php */
/* Location: ./application/modules/admin/controllers/purchase.php */