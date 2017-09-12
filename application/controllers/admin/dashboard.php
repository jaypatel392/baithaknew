<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/home_model');
	}
	
	/* Dashboard Show */
	public function index()
	{		
		$this->data['product_notify'] = $this->home_model->getAllProductNotfication();
		
		$this->show_view_admin('admin/dashboard', $this->data);
    }

    
	/* Dashboard Show */
	public function error()
	{	
		$value = $this->uri->segment(4);
		$error_msg = $this->uri->segment(5);
		if($value == '1')
		{
			$this->data['error_msg'] = $error_msg;
			$this->show_view_admin('admin/error/error_permission', $this->data);
		}		
    }


}

/* End of file */?>