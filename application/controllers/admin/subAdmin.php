<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SubAdmin extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/subadmin_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'subAdminAdd' => array(
            
            array(
                'field' => 'sub_admin_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'sub_admin_email',
                'label' => 'email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'sub_admin_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'sub_admin_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'sub_admin_cpassword',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[sub_admin_password]'
            ),			
            array(
                'field' => 'sub_admin_country_id',
                'label' => 'state',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_state_id',
                'label' => 'status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_address_1',
                'label' => 'address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_postal_code',
                'label' => 'postal code',
                'rules' => 'trim|required'
            )           
        ),
		'subAdminUpdate' => array(
        	
            array(
                'field' => 'sub_admin_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'sub_admin_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),            	
            array(
                'field' => 'sub_admin_country_id',
                'label' => 'state',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_state_id',
                'label' => 'status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_address_1',
                'label' => 'address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'sub_admin_postal_code',
                'label' => 'postal code',
                'rules' => 'trim|required'
            )           
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['sub_admin_result'] = $this->subadmin_model->getAllSubAdmin();	

			$this->show_view_admin('admin/sub_admin', $this->data);

		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addSubAdmin()
	{
		$sub_admin_id = $this->uri->segment(4);
		if($sub_admin_id)
		{

			if($this->checkEditPermission())
			{
			
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{

					$this->form_validation->set_rules($this->validation_rules['subAdminUpdate']);
					if($this->form_validation->run())
					{
						
						$post['user_id'] = $sub_admin_id;						
						$post['user_name'] = $this->input->post('sub_admin_name');
						$post['user_phone'] = $this->input->post('sub_admin_phone');
						$post['user_status'] = $this->input->post('sub_admin_status');						
						$post['user_country_id'] = $this->input->post('sub_admin_country_id');
						$post['user_state_id'] = $this->input->post('sub_admin_state_id');
						$post['user_city'] = $this->input->post('sub_admin_city');
						$post['user_address_1'] = $this->input->post('sub_admin_address_1');
						$post['user_address_2'] = $this->input->post('sub_admin_address_2');
						$post['user_postal_code'] = $this->input->post('sub_admin_postal_code');
						$post['user_updated_date'] = date('Y-m-d');
						$this->subadmin_model->updatesubAdmin($post);

						$msg = 'Sub Admin update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/subAdmin');
					}
					else
					{
						$this->data['country_list'] = $this->subadmin_model->getCountryList();
						$this->data['role_list'] = $this->subadmin_model->getRoleList();
						$this->data['state_list'] = $this->subadmin_model->getStateList();
						$this->data['sub_admin_edit'] = $this->subadmin_model->editSubAdmin($sub_admin_id);
						$this->show_view_admin('admin/sub_admin_update', $this->data);
					}
				}
				else
				{
					$this->data['country_list'] = $this->subadmin_model->getCountryList();
					$this->data['role_list'] = $this->subadmin_model->getRoleList();
					$this->data['state_list'] = $this->subadmin_model->getStateList();
					$this->data['sub_admin_edit'] = $this->subadmin_model->editSubAdmin($sub_admin_id);
					$this->show_view_admin('admin/sub_admin_update', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
		else
		{
			if($this->checkAddPermission())
			{				
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add")
				{

					$this->form_validation->set_rules($this->validation_rules['subAdminAdd']);
					if($this->form_validation->run())
					{
						$post['user_type'] = 'Sub-Admin';						
						$post['user_name'] = $this->input->post('sub_admin_name');
						$post['user_email'] = $this->input->post('sub_admin_email');
						$post['user_phone'] = $this->input->post('sub_admin_phone');
						$post['user_password'] = $this->input->post('sub_admin_password');
						$post['user_status'] = $this->input->post('sub_admin_status');
						$post['user_role_id'] = '3';
						$post['user_country_id'] = $this->input->post('sub_admin_country_id');
						$post['user_state_id'] = $this->input->post('sub_admin_state_id');
						$post['user_city'] = $this->input->post('sub_admin_city');
						$post['user_address_1'] = $this->input->post('sub_admin_address_1');
						$post['user_address_2'] = $this->input->post('sub_admin_address_2');
						$post['user_postal_code'] = $this->input->post('sub_admin_postal_code');
						$post['added_by'] = $this->data['user_id'];
						$post['user_created_date'] = date('Y-m-d');
						$post['user_updated_date'] = date('Y-m-d');						
						$sub_admin_id =  $this->subadmin_model->addSubAdmindmin($post);

						if($sub_admin_id)
						{		
							$message = '';										
							$subject = 'Party Shaarty';						
							$message .= 'Thanks for choosing Party Shaarty<br/><br/>';
							$message .= 'Your Ragistration successfully.<br/><br/>';
							$message .= 'Click to login ...  '.base_url().'<br/><br/>';
							$mail = $this->send_mail($post['user_email'], $subject, $message);
							$msg = 'Sub Admin added successfully!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/subAdmin');
						}
						else
						{
							$msg = 'oops, looks like something went wrong!';			
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/sub_admin/sub_admin_add');
						}
					}
					else
					{
						$this->data['country_list'] = $this->subadmin_model->getCountryList();
						$this->data['role_list'] = $this->subadmin_model->getRoleList();
						$this->show_view_admin('admin/sub_admin_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->subadmin_model->getCountryList();
					$this->data['role_list'] = $this->subadmin_model->getRoleList();
					$this->show_view_admin('admin/sub_admin_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function deleteSubAdmin()
	{
		if($this->checkDeletePermission())
		{
			$sub_admin_id = $this->uri->segment(4);
			
			$this->subadmin_model->deleteSubAdmin($sub_admin_id);

				$msg = 'Sub Admin remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/subAdmin');
			
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->subadmin_model->getStateListByCountryId($country_id);

		$html = '';
		if(count($state_list) > 0)
		{
			foreach ($state_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->state_id.'">'.$s_list->state_name.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

	public function changeStatus()
	{
		$post['user_id'] = $this->input->post('user_id');
		$post['user_status'] = $this->input->post('user_status');
		echo $status_res = $this->subadmin_model->updateStatus($post);
	}
}

/* End of file */?>