<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/page_model');	
	}
	
	public function helpPage()
	{
		$help_page = $this->page_model->getHelpPage();
		if(!empty($help_page))
		{
			echo json_encode(array("status"=>1,"help_page"=>$help_page));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 

	public function legalPage()
	{
		$legal_page = $this->page_model->getLegalPage();
		if(!empty($legal_page))
		{
			echo json_encode(array("status"=>1,"legal_page"=>$legal_page));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 

	public function addHelpMessages()
	{
		$post['help_msg_name'] = $_GET['name'];
		$post['help_msg_email'] = $_GET['email'];
		$post['help_msg_phone'] = $_GET['phone'];
		$post['help_msg_massage'] = $_GET['message'];
		$post['help_msg_created_date'] = date('Y-m-d');
		$post['help_msg_update_date'] = date('Y-m-d');
		
		$add_message = $this->page_model->addHelpMessages($post);
		
		if(!empty($add_message))
		{
			echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 

}

/* End of file */?>