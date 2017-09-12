<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class About extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('front/homepage_model');
	}
	
	public function index()
	{	   
	   $this->show_view_front('front/about',$this->data);
	
    }

}
/* End of file */
?>