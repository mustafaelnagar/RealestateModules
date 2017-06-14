<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */

class Serv_core extends CI_Controller {
	
	var $per_page = 10;
	
	public function __construct()
	{
		parent::__construct();
		is_installed(); #defined in auth helper
		checksavedlogin(); #defined in auth helper
		
		if(!is_admin())
		{
			if(count($_POST)<=0)
			$this->session->set_userdata('req_url',current_url());
			redirect(site_url('admin/auth'));
		}

		$this->per_page = get_per_page_value();#defined in auth helper

		$this->load->model('serv_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
	
	public function index()
	{
		$this->all();
	}

		#load all services view with paging
	public function all($start='0')
	{
		$value['posts']  	= $this->serv_model->get_all_posts_by_range($start,$this->per_page,'create_time');
		$total 				= $this->serv_model->count_all_posts();
		$value['pages']		= configPagination('admin/serv/all',$total,5,$this->per_page);
        $data['title'] = 'All Posts';
        $data['content'] = $this->load->view('admin/serv/allposts_view',$value,TRUE);
		$this->load->view('admin/template/template_view',$data);		
	}


	public function manage($id='')
	{
		$values 		= array();
		$values['title'] = 'Manage Service';
		if($id!='')
		{
			$values['title']  		= 'Update Service';
			$values['action_type']  = 'update';
			$values['price']  = 'price';
			$values['page'] 		= $this->serv_model->get_post_by_id($id);
		}

        $data['content'] = $this->load->view('serv/post_view',$values,TRUE);
		$this->load->view('admin/template/template_view',$data);			
	}


	public function add()
	{

	// print_r($_POST);
	
	// echo "I'm in add"; 
	
	// check if we have post data 
	if(isset($_POST) and !empty($_POST)){
	
			$data['featured_img'] 	= $this->input->post('featured_img');
			$data['type'] 			= $this->input->post('type');
			// $data['title'] 			= $this->input->post('title');
	
			$data['price'] 			= $this->input->post('price');
			// $data['description'] 	= $this->input->post('description'); //content is the desc 
			
			//English Data
			$data['description'] 	= $this->input->post('descriptionen');
			$data['title'] 			= $this->input->post('titleen');
	//Arabic Data
			$data['descriptionar'] 	= $this->input->post('descriptionar');
			$data['titlear'] 			= $this->input->post('titlear');
	
			$data['created_by']		= $this->session->userdata('user_id');
			$data['create_time']	= time();
			$data['status']			= $this->input->post('action');
			
			// echo "I got the data";

			if(constant("ENVIRONMENT")=='demo')
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Data updated.[NOT AVAILABLE ON DEMO]</div>');
			}
			else
			{
				if($this->input->post('action_type')=='update')
				{
					$id = $this->input->post('id');
					$this->serv_model->update_post($data,$id);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Post updated</div>');				
				}
				else
				{
					$id = $this->serv_model->insert_post($data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Services Inserted</div>');				
					redirect(site_url('admin/serv/all'));		
				}				
			}	

	}//end of post 
		// $this->form_validation->set_rules('title', 'Title', 'required');
		// $this->form_validation->set_rules('type', 'Type', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			
		$values 		= array();
		$values['title'] = 'Add Service';
		
			if($this->input->post('action_type')=='update')
				$this->manage($this->input->post('id'));
			else
	
				// $this->manage();	 // call the normal add servie view 
				$data['content'] = $this->load->view('serv/add_view',$values,TRUE);
				$this->load->view('admin/template/template_view',$data);			
		}
		else
		{
			
			// redirect(site_url('admin/serv/all'.$id));		
			redirect(site_url('admin/serv/all'));		
		}

	}
	

	public function delete($page='0',$id='',$confirmation='')
	{
		if($confirmation=='')
		{
			$data['content'] = $this->load->view(
												'admin/confirmation_view',
												array(
												'id'=>$id,
												'url'=>site_url('admin/serv/delete/'.$page)),
												TRUE
												);
			$this->load->view('admin/template/template_view',$data);
		}
		else
		{
			if($confirmation=='yes')
			{
				if(constant("ENVIRONMENT")=='demo')
				{
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Data updated.[NOT AVAILABLE ON DEMO]</div>');
				}
				else
				{
					$this->serv_model->delete_post_by_id($id);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Service Deleted</div>');					
				}
			}
			redirect(site_url('admin/serv/all/'.$page));		
			
		}		
	}


	public function featuredimguploader()

	{

		$this->load->view('admin/serv/featured_img_uploader_view');

	}

	public function uploadfeaturedfile()

	{

		$date_dir = 'thumbs/';

		$config['upload_path'] = './uploads/'.$date_dir;

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		$config['min_width'] = '256';

		$config['min_height'] = '256';



		$this->load->library('dbcupload', $config);

		$this->dbcupload->display_errors('', '');	

		if($this->dbcupload->do_upload('photoimg'))

		{

			$data = $this->dbcupload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			create_square_thumb('./uploads/'.$date_dir.$data['file_name'],'./uploads/thumbs/');

			$media['media_name'] 		= $data['file_name'];

			$media['media_url']  		= base_url().'uploads/'.$date_dir.$data['file_name'];

			$media['create_time'] 		= standard_date($format, $time);

			$media['status']			= 1;

			

			$status['error'] 	= 0;

			$status['name']	= $data['file_name'];

		}

		else

		{

			$errors = $this->dbcupload->display_errors();

			$errors = str_replace('<p>','',$errors);

			$errors = str_replace('</p>','',$errors);

			$status = array('error'=>$errors,'name'=>'');

		}



		echo json_encode($status);

		die;

	}



}

/* End of file page_core.php */
/* Location: ./application/modules/admin/controllers/page_core.php */