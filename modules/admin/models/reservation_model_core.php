<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 */



class Reservation_model_core extends CI_Model 

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

//		$this->db->order_by($sort_by, "asc");

//		$this->db->where('status !=',0); 

		if($start=='all')
		$query = $this->db->get('reservation');

		else
		$query = $this->db->get('reservation',$limit,$start);

		return $query;

	}

	

	function count_all_reservatisons()

	{

		$num_rows = $this->db->count_all_results('reservation');
		return $num_rows;
	}

	

	function delete_post_by_id($id)

	{

		$data['status'] = 0;

		$this->db->update('reservation',$data,array('id'=>$id));

	}



	function insert_post($data)

	{

		$this->db->insert('reservation',$data);
		// echo ("Im here");print_r($data).die();

		return $this->db->insert_id();

	}



	function update_post($data,$id)

	{

		$this->db->update('reservation',$data,array('id'=>$id));

	}



	function get_post_by_id($id)

	{

		$query = $this->db->get_where('reservation',array('id'=>$id));

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

}



/* End of file page_model_core.php */

/* Location: ./system/application/models/page_model_core.php */