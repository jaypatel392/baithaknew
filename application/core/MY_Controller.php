<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	var $userid='' ; 
	var $usermenu=array() ; 
	var $base_url = ''; // The page we are linking to
    var $prefix = ''; // A custom prefix added to the path.
    var $suffix = ''; // A custom suffix added to the path.
    var $total_rows = 3; // Total number of items (database results)
    var $per_page = 1; // Max number of items you want shown per page
    var $num_links = 1; // Number of "digit" links to show before/after the currently viewed page
    var $cur_page = 1; // The current page being viewed
    var $use_page_numbers = FALSE; // Use page number for segment instead of offset
    var $first_link = '&lsaquo; First';
    var $next_link = 'Next... →';
    var $prev_link = '← pre';
    var $last_link = 'Last &rsaquo;';
    var $uri_segment = 4;
    var $full_tag_open = '';
    var $full_tag_close = '';
    var $first_tag_open = '';
    var $first_tag_close = '&nbsp;';
    var $last_tag_open = '<li>';
    var $last_tag_close = '</li>';
    var $first_url = ''; // Alternative URL for the First Page.
    var $cur_tag_open = '<li class="active"><a href="#">';
    var $cur_tag_close = '</a></li>';
    var $next_tag_open = '<li>';
    var $next_tag_close = '</li>';
    var $prev_tag_open = '<li>';
    var $prev_tag_close = '</li>';
    var $num_tag_open = '<li>';
    var $num_tag_close = '</li>';
    var $page_query_string = FALSE;
    var $query_string_segment = 'per_page';
    var $display_pages = TRUE;
    var $anchor_class = '';
	/*
	constructor of this controller
	*/
	
	public function __construct()
	{

		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->data['session'] = $this->session->all_userdata();
		$session = $this->session->all_userdata();
		$this->load->model('front/homepage_model');
		if(!empty($session[0]))
		{
			$this->data['user_id'] = $session[0]->user_id;
		}
		$this->load->model('admin/home_model');
	}
	
	/* load the view files admin */
	public function show_view_admin($view, $data = '') 
	{    		
		if($this->checkSessionAdmin())
		{
			$session = $this->session->all_userdata();	
			$role_id = $session[0]->user_role_id;
			$data['getAllTabAsPerRole'] = $this->home_model->getAllTabAsPerRole($role_id);	
			$this->load->view('admin/admin_header');
			$this->load->view('admin/admin_sidebar',$data);
			$this->load->view($view, $data);
			$this->load->view('admin/admin_footer');
		}
		else
		{
			redirect(base_url().'admin');
		}
    }
		
	/*	Check Session Admin */
	public function checkSessionAdmin() 
	{
		$session = $this->session->all_userdata();	
		if(empty($session['0']->user_id))
		{
			return false;		
		}
		if (isset($session['0']))
		{
            $this->user = $session['0']->user_name;
            $this->email = $session['0']->user_email;
			$this->user_id = $session['0']->user_id;
			$this->role_id = $session['0']->user_role_id;
        }
		return true;
	}
	
	/* Check tab Permissions */
	/* View */
	public function checkViewPermission()
	{
		$session = $this->session->all_userdata();	
		$role_id = $session[0]->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(2))
			{
				if($tab_list->userView == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	/* Add */
	public function checkAddPermission()
	{
		$session = $this->session->all_userdata();	
		$role_id = $session[0]->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(2))
			{
				if($tab_list->userAdd == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	/* Edit */
	public function checkEditPermission()
	{
		$session = $this->session->all_userdata();	
		$role_id = $session[0]->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(2))
			{
				if($tab_list->userEdit == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}	

	/* Delete */
	public function checkDeletePermission()
	{
		$session = $this->session->all_userdata();	
		$role_id = $session[0]->user_role_id;
		$TabAsPerRole = $this->home_model->getAllTabAsPerRole($role_id);

		foreach($TabAsPerRole as $tab_list)
		{
			if($tab_list->controller_name == $this->uri->segment(2))
			{
				if($tab_list->userDelete == '1')
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}	
	/* END check permission */




	/*	Mail Send */
	public function send_mail($email, $subject, $message)	
	{		
		$config = array(	
			'protocol' => 'smtp',			
			'smtp_host' => 'tls://smtp.gmail.com',		
			'smtp_port' => 465,				
			'smtp_user' => 'arvind.sixthsense@gmail.com', 	
			'smtp_pass' => 'arvind@123', 			
			'mailtype' => 'html',			
			'charset' => 'iso-8859-1',			
			'wordwrap' => TRUE,				
			'charset'  => 'utf-8',			
			'priority' => '1',	
		);	
		$this->load->library('email',$config);	
		$this->email->set_newline("\n");	
		$this->email->from('arvind.sixthsense@gmail.com',"Party Shaarty");	
		$this->email->to($email);  	
		$this->email->subject($subject);	
		$this->email->message($message);
		return $this->email->send();
	}


	public function send_mail_admin($email, $subject, $message,$user_name)	
	{		
		$config = array(	
			'protocol' => 'SMTP',			
			'smtp_host' => 'tls://smtp.gmail.com',		
			'smtp_port' => 465,				
			'smtp_user' => 'arvind.sixthsense@gmail.com', 	
			'smtp_pass' => 'arvind@123', 			
			'mailtype' => 'html',			
			'charset' => 'iso-8859-1',			
			'wordwrap' => TRUE,				
			'charset'  => 'utf-8',			
			'priority' => '1',	
		);	
		$this->load->library('email',$config);	
		$this->email->set_newline("\n");	
		$this->email->from($email, $user_name);	
		$this->email->to('krishna.sixthsense@gmail.com');  	
		$this->email->subject($subject);	
		$this->email->message($message);
		return $this->email->send();
	}
	
	
	/* send push notification */
	public function sendPushNotification($device_id, $message, $title)
	{		
		$to      = array($device_id);
		define( 'API_ACCESS_KEY', 'AIzaSyDjVzaw6vlmI_IzMYOAdT6c0MB99cUsg6c');
		$img_url = 'http://cdn2.thr.com/sites/default/files/2012/12/img_logo_blue.jpg';
		$registrationIds = $to;
		$msg = array(
			'message' => $message,
			'title' => $title,
			'vibrate' => 1,
			'sound' => 1,
			'image'=>$img_url
		);
		$fields = array(
			'registration_ids' => $registrationIds,
			'data' => $msg
		);
		$headers = array(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//echo $result;
	}

	/* Upload Image */
	public function ImageUpload($filename, $name, $imagePath, $fieldName)
	{
		$temp = explode(".",$filename);
		$extension = end($temp);
		$filenew =  date('d-M-Y').'_'.str_replace($filename,$name,$filename).'_'.rand(). "." .$extension;  		
		$config['file_name'] = $filenew;
		$config['upload_path'] = $imagePath;
		$config['allowed_types'] = 'GIF | gif | JPE | jpe | JPEG | jpeg | JPG | jpg | PNG | png';
		$this->upload->initialize($config);
		$this->upload->set_allowed_types('*');
		$this->upload->set_filename($config['upload_path'],$filenew);
		
		if(!$this->upload->do_upload($fieldName))
		{
			$data = array('msg' => $this->upload->display_errors());
		}
		else 
		{ 
			$data = $this->upload->data();	
			$imageName = $data['file_name'];			
			return $imageName;
		}		
	}
	


	public function checkSessionUser() 
	{
		$session = $this->session->all_userdata();	
		if(empty($session['0']->user_id))
		{
			return false;		
		}
		if (isset($session['0']))
		{
            $this->user = $session['0']->user_name;
            $this->email = $session['0']->user_email;
			$this->user_id = $session['0']->user_id;
			$this->role_id = $session['0']->user_role_id;
        }
		return true;
	}
	

	public function show_view_front($view, $data = '') 
	{    
		

		$this->data['topCategories'] = $this->homepage_model->getTopcategories();
		
    	if($this->checkSessionUser())
		{
			$session = $this->session->all_userdata();	
			$role_id = $session[0]->user_role_id;
			$this->data['getAllTabAsPerRole'] = $this->home_model->getAllTabAsPerRole($role_id);
			$this->load->view('front/header',$this->data);
			//$this->load->view('front/admin_sidebar',$data);
			$this->load->view($view, $this->data);
			$this->load->view('front/footer',$this->data);
		}
		else
		{			
			$this->data['subscribe_list'] = $this->homepage_model->getSubscribPlan();				
			$this->load->view('front/header',$this->data);			
			$this->load->view($view, $this->data);
			$this->load->view('front/footer',$this->data);
		}
    }

}
?>