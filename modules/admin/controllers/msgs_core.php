<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

@authoer @mustafa_elnagar

*/
 
class Msgs_core extends CI_controller{
	
	
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

		$this->load->model('reservation_model');
		$this->load->model('msgs_model');// to get users models
$this->load->model('users_model');// to get users models


		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}
	
	
	public function index()
	{
		$this->all_messages();
	}

 
	function all_messages(){
	
			//this is the Messages Page, subpage from the Control Panel  - FrontEnd 


			//get the user profile data from the session 

			$user_id= $this->session->userdata('user_id');
			
			$user_name= $this->session->userdata('user_name');
			
			$user_email = $this->session->userdata('user_email');
			
			//get the user profile data 
			$value['user_data']=$this->msgs_model->get_user_profile($user_email);  //by mail 
			
			// $value['notifications'] = $this->msgs_model->get_user_notifications($this->session->userdata('user_id'));

			// get the user inbox 
			$value['inbox'] = $this->msgs_model->get_all_user_inbox($this->session->userdata('user_id'));

			$value['inbox_count'] = count($value['inbox']);
			
			// echo "The inbox count ".$value['inbox'];
	
			// echo "The # =  ".count($value['inbox']);
	
		//$value['pages']		= configPagination('admin/service_reservation/all',$total,5,$this->per_page);
			// get the user inbox 
			// $value['to_inbox'] = $this->msgs_model->get_to_user_inbox($this->session->userdata('user_id'));

		    // $data['profile_data']=$profile_data;
			// 
	 		$data['content'] 	= $this->load->view('admin/massages/allmassages',$value,TRUE);

	 		// $data['content'] = $this->load->view('admin/pages/allpages_view',$value,TRUE);
			
			$data['sub_title'] 	= "Messages";

			// $data['alias']	    = 'Mustafa';
	//		load_template($data,$this->active_theme,'admin/template/template_view'); to load the template of the UI

			$this->load->view('admin/template/template_view',$data);

}
	
	function chatbox()
	{
		
		//get the post form data
		
		$from_id = $this->input->post('from_id');
		$to_id	 = $this->input->post('to_id');
		
		// echo "From = ". $from_id." to = ".$to_id."<br/>";
	
	
			$user_id= $this->session->userdata('user_id');
			
			$user_name= $this->session->userdata('user_name');
			
			$user_email = $this->session->userdata('user_email');
			
			// $value['user_data']=$this->msgs_model->get_user_profile($user_email);  //by mail 
			

			// get the user inbox 
			// $value['inbox'] = $this->msgs_model->get_all_user_inbox($this->session->userdata('user_id'));
		
		
			
			
			$value['chat'] = $this->msgs_model->get_thread_chat($from_id,$to_id);
			
			$value['to_pf_pic'] = $this->msgs_model->get_pf_img_by_id($to_id); 
			
			$value['from_pf_pic'] = $this->msgs_model->get_pf_img_by_id($from_id); 

			//check which user from them is the user id 
			if($from_id==$user_id){
			$from_id = $user_id;
			}else{
			$to_id = $user_id ; 
			
			}
			$value['from_id'] = $from_id; 
			
			$value['to_id'] = $to_id; 
		
			// print_r($chat); 
			
	 		$data['content'] 	= $this->load->view('admin/massages/chatbox',$value,TRUE);
			
			$data['sub_title'] 	= "Messages";

			$this->load->view('admin/template/template_view',$data);

	}
	
		function newmsg()
	{
		
		//get the post form data
		$user_id= $this->session->userdata('user_id');
		
		// $to_id	 = $this->input->post('to_id'); // wait to get from the users names when user will select 
		
	
	
			// $value['chat'] = $this->msgs_model->get_thread_chat($from_id,$to_id);
			
			// $value['to_pf_pic'] = $this->msgs_model->get_pf_img_by_id($to_id); 
			
			// $value['from_pf_pic'] = $this->msgs_model->get_pf_img_by_id($from_id); 

			//check which user from them is the user id 
			// if($from_id==$user_id){
			// $from_id = $user_id;
			// }else{
			// $to_id = $user_id ; 
			
			// }
			
			$value['from_id'] = $user_id; 
			
			// $value['to_id'] = $to_id; 
		
			// print_r($chat); 
			
	 		$data['content'] 	= $this->load->view('admin/massages/newmsg_view',$value,TRUE);
			
			$data['sub_title'] 	= "Messages";

			$this->load->view('admin/template/template_view',$data);

	}
	
	public function manage($id='')
	{
		$values = array();
		$values['title'] = 'New Page';
		$data['title'] = 'New Page';
		if($id!='')
		{
			$data['title'] = 'Edit Page';
			$values['title'] = 'Edit Page';
			$values['action_type']  = 'update';
			$values['page'] 		= $this->page_model->get_page_by_id($id);
		}
        
        $data['content'] = $this->load->view('pages/page_view',$values,TRUE);
		$this->load->view('admin/template/template_view',$data);			
	}

 
	public function add()
	{


		// $this->form_validation->set_rules('title', 'Title', 'required');
		// $this->form_validation->set_rules('alias', 'Menu alias', 'required|callback_is_valid_alias');
		// $this->form_validation->set_rules('show_in_menu', 'Show in menu', 'required');

		
		//check POST if we got dat or not 
		
			$data['from_id'] 	= $this->input->post('from_id');
			
			$data['to_id'] 	= $this->input->post('to_id');
			
			$data['msg'] 	= $this->input->post('msg');

			
			
			if(constant("ENVIRONMENT")=='demo')
			{
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Data updated.[NOT AVAILABLE ON DEMO]</div>');
			}
			else
			{
					$id = $this->msgs_model->add_msg($data);
					
					
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Message Sent </div>');				
				}				
				

			// redirect(site_url('admin/msgs/chatbox/'.$id));		
		
			echo "<form id='redirection' action='".site_url('admin/msgs/chatbox/')."' method='post'>
					<input type='hidden' name='from_id' value='".$data['from_id']."'>
					<input type='hidden' name='to_id' value='".$data['to_id']."'>
				</form> 
				
					<script type='text/javascript'>
						document.getElementById('redirection').submit();
					</script>";
	}
	

	public function delete_msg($page='0',$id='',$confirmation='')
	{
		if($confirmation=='')
		{
			$data['content'] = $this->load->view('admin/confirmation_view',array('id'=>$id,'url'=>site_url('admin/page/delete/'.$page)),TRUE);
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
					$this->page_model->delete_page_by_id($id);
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Page Deleted</div>');					
				}
			}
			redirect(site_url('admin/page/all/'.$page));		
			
		}		
	}

	
public function get_usernames_ajax($term='')

	{

		if($term=='')
			$term = $this->input->post('term');

		// echo "console.log(' the term = $term')";
		
		// $country = $this->input->post('country');

		// $data = $this->realestate_model->get_locations_json($term,'state',$country);	
		$data = $this->msgs_model->get_unames_json($term);	

		echo json_encode($data);

	}

	 
}

/* End of file page_core.php */
/* Location: ./application/modules/admin/controllers/page_core.php */