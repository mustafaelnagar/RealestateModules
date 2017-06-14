<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 
 */

class Cms extends CI_Controller {
	
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

		$this->load->model('services_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
	
	public function index()
	{
		$this->manage();
	}

 
	public function add()
	{


		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('alias', 'Menu alias', 'required|callback_is_valid_alias');
		$this->form_validation->set_rules('show_in_menu', 'Show in menu', 'required');
		$this->form_validation->set_rules('content_from', 'Content from', 'required');
		if($this->input->post('crawl_after')!='')
		$this->form_validation->set_rules('crawl_after', 'Crawl after', 'numeric|greater_than[0]');
		
		if ($this->form_validation->run() == FALSE)
		{
			if($this->input->post('action_type')=='update')
				$this->manage($this->input->post('id'));
			else
				$this->index();	
		}
		else
		{
			$data['title'] 			= $this->input->post('title');
			$data['alias'] 			= $this->input->post('alias');
			$data['show_in_menu'] 	= $this->input->post('show_in_menu');
			$data['content_from'] 	= $this->input->post('content_from');
			if($data['content_from']=='Manual')
			$data['url'] 			= 'show/page/'.$data['alias'];
			else
			$data['url'] 			= $this->input->post('url');
			
			$data['url']			= rtrim($data['url'],"/");

			$data['layout']			= $this->input->post('layout');
			$data['parent'] 		= $this->input->post('parent');
			if($data['layout']==0)
			$data['sidebar']		= $this->input->post('leftbar');
			else if($data['layout']==1)
			$data['sidebar']		= $this->input->post('rightbar');
			else
			$data['sidebar']		= '';
			$data['content']		= $this->input->post('content');
			$data['status']			= $this->input->post('action');
			
			$seo = array();
			$seo['meta_description'] 	= $this->input->post('meta_description');
			$seo['key_words'] 			= $this->input->post('key_words');
			$seo['crawl_after'] 		= $this->input->post('crawl_after');
			$data['seo_settings']		= json_encode($seo);

			if(constant("ENVIRONMENT")=='demo')
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Data updated.[NOT AVAILABLE ON DEMO]</div>');
			}
			else
			{
				if($this->input->post('action_type')=='update')
				{
					$id = $this->input->post('id');
					// echo "<pre>";
					// print_r($_POST);
					// die;
					$this->page_model->update_page($data,$id);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Page updated</div>');				
				}
				else
				{
					$id = $this->page_model->insert_page($data);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Page Created</div>');				
				}				
			}	

			redirect(site_url('admin/page/manage/'.$id));		
		}

	}
	
 
 
 
 
/* idev serice page template */
function service()
{

/* check if we have data posted in the hrttp request, get the data and update the services foields in the db */
	
	if(isset($_POST) and !empty($_POST)){
	
		// echo "we have data";
		// print_r($_POST);
	
	//get first service 
	$service=array();
	$service['img'] = $_POST['service_photo']; 
	$service['title'] = $_POST['title_1']; 
	$service['subtitle'] = $_POST['subtitle1']; 
	$service['title_ar'] = $_POST['title_ar1']; 
	$service['subtitle_ar'] = $_POST['subtitle_ar1']; 
	$service['url'] = $_POST['url1']; 
	
	//the id is fixed at tabel parts 
	$this->services_model->update_package($service,1);
	

	$service=array();
	$service['img'] = $_POST['service_photo_2']; 
	$service['title'] = $_POST['title_2']; 
	$service['subtitle'] = $_POST['subtitle_2']; 
	$service['title_ar'] = $_POST['title_ar2']; 
	$service['subtitle_ar'] = $_POST['subtitle_ar2']; 
	$service['url'] = $_POST['url2']; 
	
	//the id is fixed at tabel parts 
	$this->services_model->update_package($service,2);
		
	$service=array();
	$service['img'] = $_POST['service_photo_3']; 
	$service['title'] = $_POST['title_3']; 
	$service['subtitle'] = $_POST['subtitle3']; 
	$service['title_ar'] = $_POST['title_ar3']; 
	$service['subtitle_ar'] = $_POST['subtitle_ar3']; 
	$service['url'] = $_POST['url3']; 
	
	
	//the id is fixed at tabel parts 
	$this->services_model->update_package($service,3);
	
	
	//the id is fixed at tabel parts 
		
	$service=array();
	$service['img'] = $_POST['service_photo_4']; 
	$service['title'] = $_POST['title_4']; 
	$service['subtitle'] = $_POST['subtitle4']; 
	$service['title_ar'] = $_POST['title_ar4']; 
	$service['subtitle_ar'] = $_POST['subtitle_ar4']; 
	$service['url'] = $_POST['url4']; 
	
	
	//the id is fixed at tabel parts 
	$this->services_model->update_package($service,4);
	
	
	}
		$values = array();
	
		$values['title'] = 'Service Page';		

		$values['service_1'] = $this->services_model->get_service_by_id(1); 
		$values['service_2'] = $this->services_model->get_service_by_id(2); 
		$values['service_3'] = $this->services_model->get_service_by_id(3); 
		$values['service_4'] = $this->services_model->get_service_by_id(4); 
		
		
	    $data['content'] = $this->load->view('cms/services',$values,TRUE);

		
		$this->load->view('admin/template/template_view',$data);			

} 

/* upload images functions step 1  */

/* service 1 img */
	public function service_1_img()

	{

		$this->load->view('cms/service_1_img');

	}
	
	/* service 2 img */
	public function service_2_img()

	{
		$this->load->view('cms/service_2_img');
	}

		/* service 2 img */
	public function service_3_img()

	{
		$this->load->view('cms/service_3_img');
	}

	
		/* service 2 img */
	public function service_4_img()

	{
		$this->load->view('cms/service_4_img');
	}

/*upload profile photo step2 in the cms images */

	public function upload_cms_photo()

	{

		$date_dir = 'cmsuploads/';

		$config['upload_path'] = './uploads/cmsuploads/';

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		

		$this->load->library('upload', $config);

		$this->upload->display_errors('', '');	



		if($this->upload->do_upload('photoimg'))

		{

			$data = $this->upload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			

			$media['media_name'] 		= utf8_encode($data['file_name']);

			$media['media_url']  		= base_url().'uploads/cmsuploads/'.$data['file_name'];

			$media['create_time'] 		= standard_date($format, $time);

			$media['status']			= 1;

			

			create_square_thumb('./uploads/cmsuploads/'.$data['file_name'],'./uploads/cmsuploads/thumb/');



			$status['error'] 	= 0;

			$status['name']	= $data['file_name'];

		}

		else

		{

			$errors = $this->upload->display_errors();

			$errors = str_replace('<p>','',$errors);

			$errors = str_replace('</p>','',$errors);

			$status = array('error'=>$errors,'name'=>'');

		}

		echo json_encode($status);

		die;

	}

	public function upload_profile_photo()

	{

		$date_dir = 'profile_photos/';

		$config['upload_path'] = './uploads/profile_photos/';

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		

		$this->load->library('upload', $config);

		$this->upload->display_errors('', '');	



		if($this->upload->do_upload('photoimg'))

		{

			$data = $this->upload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			

			$media['media_name'] 		= $data['file_name'];

			$media['media_url']  		= base_url().'uploads/profile_photos/'.$data['file_name'];

			$media['create_time'] 		= standard_date($format, $time);

			$media['status']			= 1;

			

			create_square_thumb('./uploads/profile_photos/'.$data['file_name'],'./uploads/profile_photos/thumb/');



			$status['error'] 	= 0;

			$status['name']	= $data['file_name'];

		}

		else

		{

			$errors = $this->upload->display_errors();

			$errors = str_replace('<p>','',$errors);

			$errors = str_replace('</p>','',$errors);

			$status = array('error'=>$errors,'name'=>'');

		}

		echo json_encode($status);

		die;

	}


	/* upload icon file */

	public function uploadiconfile()

	{

		$date_dir = $this->create_date_directory();

		$config['upload_path'] = './uploads/'.$date_dir;

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '1000';

		$config['max_width'] = '32';

		$config['max_height'] = '32';

		$config['min_width'] = '32';

		$config['min_height'] = '32';



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



	public function uploadsearchbgfile()

	{

		//$date_dir = $this->create_date_directory();

		$config['upload_path'] = './uploads/banner/';

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		$config['min_width'] = '1024';

		$config['min_height'] = '600';



		$this->load->library('dbcupload', $config);

		$this->dbcupload->display_errors('', '');	

		if($this->dbcupload->do_upload('photoimg'))

		{

			$data = $this->dbcupload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			//create_square_thumb('./uploads/'.$date_dir.$data['file_name'],'./uploads/thumbs/');

			$media['media_name'] 		= $data['file_name'];

			$media['media_url']  		= base_url().'uploads/banner/'.$data['file_name'];

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



	public function uploadfeaturedfile()

	{

		$date_dir = $this->create_date_directory();

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

    public function uploadbrochure()

    {

        $date_dir = $this->create_date_directory();

        $config['upload_path'] = './uploads/gallery';

        $config['allowed_types'] = 'pdf|doc|docx';

        $config['max_size'] = '5120';





        $this->load->library('dbcupload', $config);

        $this->dbcupload->display_errors('', '');

        if($this->dbcupload->do_upload('photoimg'))

        {

            $data = $this->dbcupload->data();


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

	public function uploadgalleryfile()

	{

		//$date_dir = $this->create_date_directory();

		$config['upload_path'] = './uploads/gallery/';

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		// $config['min_width'] = '256';

		// $config['min_height'] = '256';



		$this->load->library('dbcupload', $config);

		$this->dbcupload->display_errors('', '');	

		if($this->dbcupload->do_upload('photoimg'))

		{

			$data = $this->dbcupload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			//create_square_thumb('./uploads/'.$date_dir.$data['file_name'],'./uploads/thumbs/');

			$media['media_name'] 		= $data['file_name'];

			$media['media_url']  		= base_url().'uploads/gallery/'.$data['file_name'];

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



	public function uploadbannerfile()

	{

		//$date_dir = $this->create_date_directory();

		$config['upload_path'] = './uploads/banner/';

		$config['allowed_types'] = 'gif|jpg|JPG|png';

		$config['max_size'] = '5120';

		$config['min_width'] = '1024';

		$config['min_height'] = '600';



		$this->load->library('dbcupload', $config);

		$this->dbcupload->display_errors('', '');	

		if($this->dbcupload->do_upload('photoimg'))

		{

			$data = $this->dbcupload->data();

			$this->load->helper('date');

			$format = 'DATE_RFC822';

			$time = time();

			//create_square_thumb('./uploads/'.$date_dir.$data['file_name'],'./uploads/thumbs/');

			$media['media_name'] 		= $data['file_name'];

			$media['media_url']  		= base_url().'uploads/banner/'.$data['file_name'];

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



	public function crop($src='',$width=256,$height=256)

	{

		$config['image_library'] = 'gd2';

		$config['source_image'] = $src;

		$config['width'] = $width;

		$config['height'] = $height;



		$this->load->library('image_lib', $config);



		$this->image_lib->resize();

	}


	
}//end class

/* End of file page_core.php */
/* Location: ./application/modules/admin/controllers/page_core.php */