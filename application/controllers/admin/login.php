<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/login_model');	
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'login' => array(
            array(
                'field' => 'user_email',
                'label' => 'Email',
                'rules' => 'trim|required'
            ),
			 array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        ),
		'profile' => array(
            array(
                'field' => 'user_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			 array(
                'field' => 'user_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),			
			array(
                'field' => 'user_cpassword',
                'label' => 'Confirm Password',
                'rules' => 'trim|matches[user_password]'
            )

        ),
		'forgotPassword_email' => array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            )
        ),
		'resetpassword' => array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|matches[rpassword]'
            ),
			array(
                'field' => 'rpassword',
                'label' => 'Re-Type Password',
                'rules' => 'trim|required'
            )
        )
    );
		
	/* Login */
	public function index()
	{
		if($this->checkSessionAdmin())
		{
			redirect('admin/dashboard');
		}
		else
		{	
			if(isset($_POST['Login']) && $_POST['Login'] =='Login')
			{
				$this->form_validation->set_rules($this->validation_rules['login']);
				if ($this->form_validation->run()) 
				{
					$this->data['user_email'] = $_POST['user_email'];
					$this->data['password'] = MD5($_POST['password']);
					$user_details = $this->login_model->checkUserLogin($this->data);
					if(!empty($user_details))
					{
						$this->session->set_userdata($user_details);
						redirect('admin/dashboard');
					}
					else
					{
						$msg = 'Invalid Email And Password';
						$this->session->set_flashdata('message', '<div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div>');
						redirect('admin');
					}
				}
				else
				{					
					$this->load->view('admin/login', $this->data);
				}
			}
			else
			{
				$this->load->view('admin/login');
			}
		}
    }

    /*	Logout */
	public function logout() 
	{        
        $this->session->sess_destroy();		
        redirect( base_url().'admin');
    }


    /*	Update Profile */
	public function profile($user_id) 
	{   

        if(isset($_POST['Submit']) && $_POST['Submit'] =='Profile')
		{
			$this->form_validation->set_rules($this->validation_rules['profile']);
			if ($this->form_validation->run()) 
			{
				$post['user_id'] = $user_id;
				$post['user_name'] = $this->input->post('user_name');
				$post['user_phoe'] = $this->input->post('user_name');
				$user_password = $this->input->post('user_password');
				if($user_password)
				{
					$post['user_password'] = $user_password;
				}
				$res = $this->login_model->updateProfile($post);
				$msg = 'Profile update successfully!!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin');
			}
			else
			{	
				$this->data['user_details'] = $this->login_model->getUserDetails($user_id);				
				$this->show_view_admin('admin/admin_profile', $this->data);
			}
		}
		else
		{
			$this->data['user_details'] = $this->login_model->getUserDetails($user_id);
			$this->show_view_admin('admin/admin_profile', $this->data);
		}
    }		
	
}
/* End of file */