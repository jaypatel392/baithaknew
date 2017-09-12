<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/user_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'userAdd' => array(
            
            array(
                'field' => 'user_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'user_email',
                'label' => 'email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'user_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'user_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'user_cpassword',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[user_password]'
            ),			
            array(
                'field' => 'user_country_id',
                'label' => 'state',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_state_id',
                'label' => 'status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_address_1',
                'label' => 'address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'user_postal_code',
                'label' => 'postal code',
                'rules' => 'trim|required'
            ),      
            array(
                'field' => 'shop_establishment_id',
                'label' => 'Shop establishment id',
                'rules' => 'trim|required'
            ),      
            array(
                'field' => 'drug_licence',
                'label' => 'Drug licence',
                'rules' => 'trim|required'
            ),      
            array(
                'field' => 'gstn',
                'label' => 'GST Number',
                'rules' => 'trim|required'
            ),      
            array(
                'field' => 'user_type',
                'label' => 'User Type',
                'rules' => 'trim|required'
            )      
        )		
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$session = $this->data['session'];
			if($session[0]->user_role_id == 1)
			{
				$this->data['user_result'] = $this->user_model->getAllUser();
			}
			else
			{
				$this->data['user_result'] = $this->user_model->getAllUserByRole($session[0]->user_id);
			}
			$this->show_view_admin('admin/user', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addUser()
	{
		$user_id = $this->uri->segment(4);
		if($user_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['userUpdate']);
					if($this->form_validation->run())
					{
						$post['user_id'] = $user_id;						
						$post['user_name'] = $this->input->post('user_name');
						$post['user_phone'] = $this->input->post('user_phone');
						$post['user_status'] = $this->input->post('user_status');
						if($post['user_status'] == '1')
						{
							$post['user_status_type'] = 'Approved';
						}												
						$post['user_country_id'] = $this->input->post('user_country_id');
						$post['user_state_id'] = $this->input->post('user_state_id');
						$post['user_city'] = $this->input->post('user_city');
						$post['user_address_1'] = $this->input->post('user_address_1');
						$post['user_address_2'] = $this->input->post('user_address_2');
						$post['user_postal_code'] = $this->input->post('user_postal_code');
						$post['user_updated_date'] = date('Y-m-d');
						$this->user_model->updateUser($post,$user_id);

						$msg = 'User update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/user');
					}
					else
					{
						$this->data['country_list'] = $this->user_model->getCountryList();
						$this->data['role_list'] = $this->user_model->getRoleList();
						$this->data['state_list'] = $this->user_model->getStateList();
						$this->data['user_edit'] = $this->user_model->editUser($user_id);
						$this->show_view_admin('admin/user_update', $this->data);
					}
				}
				else
				{
					$this->data['country_list'] = $this->user_model->getCountryList();
					$this->data['role_list'] = $this->user_model->getRoleList();
					$this->data['state_list'] = $this->user_model->getStateList();
					$this->data['user_edit'] = $this->user_model->editUser($user_id);
					$this->show_view_admin('admin/user_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['userAdd']);
					if($this->form_validation->run())
					{					
						$post['user_type'] = $this->input->post('user_type');
						$post['user_role_id'] = '0';
						$post['user_name'] = $this->input->post('user_name');
						$post['user_email'] = $this->input->post('user_email');
						$post['user_phone'] = $this->input->post('user_phone');
						$post['user_password'] = md5($this->input->post('user_password'));
						$post['user_status'] = $this->input->post('user_status');
						if($post['user_status'] == '1')
						{
							$post['user_status_type'] = 'Approved';
						}
						else
						{
							$post['user_status_type'] = 'Pending';
						}
						$post['user_country_id'] = '99';
						$post['user_state_id'] = $this->input->post('user_state_id');
						$post['user_city'] = $this->input->post('user_city');
						$post['user_address_1'] = $this->input->post('user_address_1');
						$post['user_address_2'] = $this->input->post('user_address_2');
						$post['user_postal_code'] = $this->input->post('user_postal_code');
						$post['shop_establishment_id'] = $this->input->post('shop_establishment_id');
						$post['drug_licence'] = $this->input->post('drug_licence');
						$post['gstn'] = $this->input->post('gstn');						
						$post['added_by'] = $this->data['user_id'];
						$post['user_created_date'] = date('Y-m-d');
						$post['user_updated_date'] = date('Y-m-d');
						$user_id =  $this->user_model->addUser($post);
						if($user_id)
						{
							$msg = 'user added successfully!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/user');
						}
						else
						{
							$msg = 'oops, looks like something went wrong!';				
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/user/user_add');
						}
					}
					else
					{
						$this->data['country_list'] = $this->user_model->getCountryList();
						$this->data['role_list'] = $this->user_model->getRoleList();
						$this->data['state_list'] = $this->user_model->getStateList();
						$this->show_view_admin('admin/user_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->user_model->getCountryList();
					$this->data['role_list'] = $this->user_model->getRoleList();
					$this->data['state_list'] = $this->user_model->getStateList();
					$this->show_view_admin('admin/user_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_user()
	{
		if($this->checkDeletePermission())
		{
			$user_id = $this->uri->segment(4);
			
			$this->user_model->delete_user($user_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/user'); 
			}
			else
			{
				$msg = 'user remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/user');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	public function approveRejectUser($user_id = '',$action = '')
	{
		if($user_id)
		{
			if($action == 'Approve')
			{
				$post['user_status'] = '1';
				$post['user_status_type'] = 'Approved';
				$approve = $this->user_model->approveUser($user_id,$post);
				if($approve)
				{
					$msg = 'user approved successfully...!';
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect('admin/user');
				}
			}
			else if($action == 'Reject')
			{
				$post['user_status'] = '3';
				$post['user_status_type'] = 'Rejected';
				$reject = $this->user_model->rejectUser($user_id,$post);
				if($reject)
				{
					$msg = 'user rejected successfully...!';
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect('admin/user');
				}
			}
		}
	}

	/* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->user_model->getStateListByCountryId($country_id);

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
}

/* End of file */?>