<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  page_model model
 *
 * This class handles page_model management related functionality

 */

//require_once'Services_model_core.php';

class Services_model extends Services_model_core 
{

	echo "Debugging <br/>"; //Debugging 
	function __construct()
	{
		echo "Debugging <br/>"; //Debugging 

		parent::__construct();
		$this->test();
	}

	function test(){
		echo "ayhaga";
			}

}

/* End of file page_model.php */
/* Location: ./system/application/models/page_model.php */