<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  purchase Controller
 *
 * This class handles purchase management related functionality
 *
 * @package		Admin
 * @subpackage	purchase
 *  		 
 *  
 */
require_once'purchase_core.php';
class Purchase extends Purchase_core {

	public function __construct()
	{
		parent::__construct();
	}
}