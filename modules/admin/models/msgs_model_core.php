<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
This is the main model to get the user data at the front end  :) !
 */
class Msgs_model_core extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function insert_user_data($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	function insert_payment_data($data)
	{
		$this->db->insert('user_package',$data);
		return $data['unique_id'];
	}
	function get_user_payment_data_by_unique_id($unique_id)
	{
		$query = $this->db->get_where('user_package',array('unique_id'=>$unique_id));
		return $query;
	}
	function update_user_payment_data_by_unique_id($data,$unique_id)
	{
		$this->db->update('user_package',$data,array('unique_id'=>$unique_id));
	}
	function get_user_data_array_by_id($id)
	{
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->row_array();
	}
	function get_user_profile($user_email)
	{
		$query = $this->db->get_where('users',array('user_email'=>$user_email));
		return $query->row();
	}
	function get_user_profile_by_id($id)
	{
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->row();
	}
	function get_user_profile_by_user_name($user_name)
	{
		$query = $this->db->get_where('users',array('user_name'=>$user_name));
		if($query->num_rows()>0)
			return $query->row();
		else
			show_error('User name not valid' , 500 );
	}
	function get_all_user_posts_by_range($start,$limit='',$sort_by='',$id)
	{
		$this->db->order_by($sort_by, "asc");
		$this->db->where('status',1); 
		$this->db->where('created_by',$id);
		if($start=='all')
		$query = $this->db->get('posts');
		else
		$query = $this->db->get('posts',$limit,$start);
		return $query;
	}
	function count_all_user_posts($id)
	{
		$this->db->where('status',1); 		
		$this->db->where('created_by',$id); 
		$query = $this->db->get('posts');
		return $query->num_rows();
	}
//get all user msgs, from - to 
function get_all_user_inbox($id)
	{
		 // $where_condition = "('to_id'='".$id."' or 'from_id'='".$id."')";
		$this->db->where('to_id',$id ); 
		$this->db->or_where('from_id',$id ); 
		$query = $this->db->get('msgs');
		$all_msgs = $query->result();
		$new_data = array(); // the returned value
		//appending the values of uname, proffile picture from the users tabel 
		foreach ($all_msgs as $msg) {
			# code...
			$to_user_id =  $msg->to_id; 
			$from_user_id =  $msg->from_id; 
			$to_uname = $this->get_uname_by_id($to_user_id);  
			$from_uname = $this->get_uname_by_id($from_user_id);  
			$to_pf_pic= $this->get_pf_img_by_id($to_user_id); 
			$from_pf_pic= $this->get_pf_img_by_id($from_user_id); 
			//Append Data //important 
			//add the user name 
			$msg->to_uname = $to_uname; 
			//add the user name 
			$msg->from_uname = $to_uname; 
			// add from user profile picture 
			$msg->from_pf_pic = $from_pf_pic; 
			// add to user profile picture 
			$msg->to_pf_pic = $to_pf_pic; 
			// print_r($msg);
			$new_to_data[] = $msg; 
			//print_r($new_to_data);
		} // end for each 
		return $new_to_data;
	}
//get msgs recieved by user
function get_to_user_inbox($id)
	{
		$this->db->where('to_id',$id); 
		//$this->db->where('created_by',$id);		
		$query = $this->db->get('msgs');
		$all_to_msgs = $query->result();
		$new_to_data = array(); // the returned value
		//appending the values of uname, proffile picture from the users tabel 
		foreach ($all_to_msgs as $msg) {
			# code...
			$to_user_id =  $msg->to_id; 
			$to_user_name = $this->get_uname_by_id($to_user_id);  
			$from_pf_pic= $this->get_pf_img_by_id($to_user_id); 
			//add the user name 
			$msg->to_uname = $to_user_name; 
			// add from user profile picture 
			$msg->pf_pic = $from_pf_pic; 
			// print_r($msg);
			$new_to_data[] = $msg; 
			//print_r($new_to_data);
		} // end for each 
		// return $all_to_msgs;
		// echo "<br/> this is the new data, its stdclass summision of associate arrays  <br/>";
		// print_r($new_to_data);
		return $new_to_data;
	}
		function get_uname_by_id($id)
	{
		$query = $this->db->get_where('users',array('id'=>$id));
		// return $query->row();
		$result = $query->row();
		$uname= $result->first_name." ".$result->last_name  ;
		return $uname;
	}
		function get_propery_uniqid_by_id($id)
	{
		$query = $this->db->get_where('posts',array('id'=>$id));
		// return $query->row();
		$result = $query->row();
		$uniqid= $result->unique_id;
		return $uniqid;
	}
		function get_pf_img_by_id($id)
	{
		$query = $this->db->get_where('users',array('id'=>$id));
		$result = $query->row();
		$pf_img= $result->profile_photo;
		return $pf_img;
	}
//get msgs sent from user
function get_from_user_inbox($id)
	{
		$this->db->where('to_id',$id); 
		//$this->db->where('created_by',$id);		
		$query = $this->db->get('msgs');
		return $query->result();
	}
//get msgs sent from user
function get_rating_by_id($id)
	{
		$this->db->where('user_id',$id); 
		//$this->db->where('created_by',$id);		
		$query = $this->db->get('rating');
		//return $query->row; //its array have to make foreach not like user data  
		//print_r($query->row);
		return $query->result();
	}
	function get_reservations_by_userid($user_id)
	{
		$this->db->where('user_id',$user_id); 
		$query = $this->db->get('reservation');
		//Join prpoerty fields from the "post tabel"
		$reservations = $query->result();
		$new_reservations = array(); 
		foreach($reservations as $reservation){
		$property_id = $reservation->property_id;
		$property_fields = $this->get_property_fields_by_id($property_id);
		//get the property features 
		$reservation->propertyimg  = $property_fields->featured_img; 
		$reservation->propertyaddress = $property_fields->address.",".get_location_name_by_id($property_fields->city).','.get_location_name_by_id($property_fields->state).','.get_location_name_by_id($property_fields->country);
		$reservation->propertytype = $property_fields->type; 
		$reservation->propertypurpose = $property_fields->purpose; 
		//insert the new object in the stclass 
		$new_reservations[] =$reservation;
		} //end for each 
		return $new_reservations;
	}
	// get the property fields by 
	function get_property_fields_by_id($property_id)
	{
		$this->db->where('id',$property_id); 
		$query = $this->db->get('posts');
		return $query->row(); //the property array 
	}
//this function is to add notification to users 
	function add_notification($from_user,$to_user,$msg){
	}
// Add inbox message 
	function add_msg($data){
	$data['result'] = $this->db->insert('msgs',$data);
		return $data['result'];
	}
// search inbox message 
	function search_inbox($user_id,$search_key){
		//search the all inbox of the user (from,to) by the search key 
	}
function get_thread_chat($from_id,$to_id)
{
//get the user id 
//get the from id 
//get from to & to from 
		$firstcase = array('from_id' => $from_id, 'to_id' => $to_id);
		 $ndcase = array('from_id' => $to_id , 'to_id' => $from_id);
		$this->db->where($firstcase); 
		// $ndcase = array('from_id' => $to_id , 'to_id' => $from_id);
		$this->db->or_where($ndcase); 
		$this->db->order_by('notification_time', 'asc'); 
		$query = $this->db->get('msgs');
		$result = $query->result();
		return $result;
}


	function get_unames_json($term=''){
	
		$this->db->like('user_name',$term);
		
		
		// echo "<script> console.log(' the term = $term'); </script>";
		
		// $query = $this->db->get_where('name',array('status'=>1,'type'=>$type,'parent'=>$parent));
		$query = $this->db->get('users');
		
		$data = array();
		
		foreach ($query->result() as $row) {
			$val = array();
			$val['id'] = $row->id;
			$val['label'] = $row->user_name;
			
			array_push($data,$val);
		}
		return $data;
	}

} // end of the model
/* Location: ./application/modules/profile/models/user_model_core.php */