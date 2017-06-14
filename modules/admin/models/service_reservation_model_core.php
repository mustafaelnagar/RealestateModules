<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 */



class Service_reservation_model_core extends CI_Model 

{

	var $pages,$menu;


	function __construct()

	{

		parent::__construct();

		$this->load->database();

		$this->pages = array();

	}


	function get_all_posts_by_range($start,$limit='',$sort_by='')

	{


		if($start=='all')
		$query = $this->db->get('services_bookings');

		else
		$query = $this->db->get('services_bookings',$limit,$start);

		return $query;

	}

	

	function count_all_reservatisons()

	{

		$num_rows = $this->db->count_all_results('services_bookings');
		return $num_rows;
	}

	

	function delete_post_by_id($id)

	{

		$data['status'] = 0;

		$this->db->update('services_bookings',$data,array('id'=>$id));

	}



	function insert_post($data)

	{

		$this->db->insert('services_bookings',$data);
		// echo ("Im here");print_r($data).die();

		return $this->db->insert_id();

	}



	function update_post($data,$id)

	{

		$this->db->update('services_bookings',$data,array('id'=>$id));

	}



	function get_post_by_id($id)

	{

		$query = $this->db->get_where('services_bookings',array('id'=>$id));

		if($query->num_rows()<=0)

		{
			$res = new stdClass();
			return $res;

		}

		else

		{

			return $query->row();

		}

	}

	  function get_service_name_by_id($id)
    {

        $this->db->select('title');
        $query = $this->db->get_where('services',array('id'=>$id));
        
        $service_name = $query->row(); 
        //print_r($service_name);
        return $service_name->title;        
        //die('die');		
        
        		
		
    }

}



/* End of file page_model_core.php */

/* Location: ./system/application/models/page_model_core.php */