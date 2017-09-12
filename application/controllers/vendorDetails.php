<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class VendorDetails extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/vendor_model');	
		$this->load->model('front/products_model');	
	}
	
		
	public function index()
	{					
		$session = $this->session->all_userdata();
		$this->data['categories'] = $this->vendor_model->getAllcategories($session[0]->user_id);
		$this->data['vendor_products'] = $this->vendor_model->getAllVendorProducts($session[0]->user_id);
		$this->data['vendor_about'] = $this->vendor_model->getAllVendorAbout($session[0]->user_id);
		$this->show_view_front('front/vendor_details', $this->data);	

	}
	public function aboutUs()
	{					
		$session = $this->session->all_userdata();
		$this->data['categories'] = $this->vendor_model->getAllcategories($session[0]->user_id);
		$this->data['vendor_about'] = $this->vendor_model->getAllVendorAbout($session[0]->user_id);
		$this->show_view_front('front/vendor_about', $this->data);	

	}

	public function gallery()
	{					
		$session = $this->session->all_userdata();
		$this->data['categories'] = $this->vendor_model->getAllcategories($session[0]->user_id);
		$this->data['vendor_gallery'] = $this->vendor_model->getAllVendorGallery($session[0]->user_id);
		$this->data['vendor_about'] = $this->vendor_model->getAllVendorAbout($session[0]->user_id);
		$this->show_view_front('front/vendor_gallery', $this->data);	

	}

	public function reviews()
	{					
		$session = $this->session->all_userdata();
		$this->data['categories'] = $this->vendor_model->getAllcategories($session[0]->user_id);
		$this->data['vendor_products'] = $this->vendor_model->getAllVendorProducts($session[0]->user_id);
		
			$this->data['vendor_about'] = $this->vendor_model->getAllVendorAbout($session[0]->user_id);

		$this->show_view_front('front/vendor_reviews', $this->data);	

	}

   
}
/* End of file */