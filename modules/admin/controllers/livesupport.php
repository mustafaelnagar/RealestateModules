<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
embedding the live support chat system 
 */

class Livesupport extends CI_Controller {
	
	
	
	public function __construct()
	{
		parent::__construct();
		// is_installed(); #defined in auth helper
		checksavedlogin(); #defined in auth helper
		
		if(!is_admin())
		{
			if(count($_POST)<=0)
			$this->session->set_userdata('req_url',current_url());
			redirect(site_url('admin/auth'));
		}

		// $this->load->model('users_model');// to get users models


		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
	
	public function index()
	{
		
		// $this->all();
		
		//idev-inc.com/projects/findhome.com/livesupport/index.php/site_admin/
    
        $data['title'] = 'All Reservations';
        
        $data['content'] = $this->load->view('live_support',$data,true);

//print_r($data);
//print_r($value);

		$this->load->view('admin/template/template_view',$data);
		
	}


}

/* End of file page_core.php */
/* Location: ./application/modules/admin/controllers/page_core.php */