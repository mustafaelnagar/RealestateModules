<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  package_model_core model
 *
 * This class handles package_model_core management related functionality
 *
 * @package		Admin
 * @subpackage	package_model_core
 *  		 
 *  
 */


class Services_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	
	#bulk update the packages table
	function bulk_update_packages($data,$ids) {
		
		if(!isset($ids) || !isset($data))
			return;

		$this->db->where_in('id',$ids);
		$this->db->update('parts',$data);
	}

	#update a single record in packages table by id
	function update_package($data,$id) {
		
		if(!isset($id) || !isset($data))
			return;
		
		$this->db->where('id',$id);
		$this->db->update('parts',$data);
	}

	#insert package information into the database
	function insert_package($data) {

		$this->db->insert('packages',$data);
		return $this->db->insert_id();
	}

	#get a particular package by id
	function get_service_by_id($id)
	{
		$query = $this->db->get_where('parts',array('id'=>$id));
		if($query->num_rows()<=0)
		{
			echo 'Invalid id';die;
		}
		else
		{
			return $query->row();
		}
	}
	
}

/* End of file service_model_core.php */
/* Location: ./system/application/models/package_model_core.php */