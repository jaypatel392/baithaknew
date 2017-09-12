<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vendor extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/vendor_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'vendorAdd' => array(
            
            array(
                'field' => 'vendor_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'vendor_email',
                'label' => 'email',
                'rules' => 'trim|required|is_unique[tbl_user.user_email]'
            ),
			array(
                'field' => 'vendor_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'vendor_password', 
				'label' => 'Password',   
				'rules' => 'trim|required'  
			),
			array(  
				'field' => 'vendor_cpassword',
				'label' => 'Confirm Password', 
				'rules' => 'trim|required|matches[vendor_password]'
            ),			
            array(
                'field' => 'vendor_country_id',
                'label' => 'state',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_state_id',
                'label' => 'status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_address_1',
                'label' => 'address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_postal_code',
                'label' => 'postal code',
                'rules' => 'trim|required'
            )           
        ),
		'vendorUpdate' => array(
        	
            array(
                'field' => 'vendor_name',
                'label' => 'name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'vendor_phone',
                'label' => 'phone',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_country_id',
                'label' => 'state',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_state_id',
                'label' => 'status',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_city',
                'label' => 'city',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_address_1',
                'label' => 'address',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'vendor_postal_code',
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
			$this->data['vendor_result'] = $this->vendor_model->getAllvendor();	
			$this->show_view_admin('admin/vendor', $this->data);

		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addvendor()
	{
		$vendor_id = $this->uri->segment(4);
		if($vendor_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{

					$this->form_validation->set_rules($this->validation_rules['vendorUpdate']);
					if($this->form_validation->run())
					{
						$post['user_id'] = $vendor_id;						
						$post['user_name'] = $this->input->post('vendor_name');
						$post['user_phone'] = $this->input->post('vendor_phone');
						$post['user_status'] = $this->input->post('vendor_status');						
						$post['user_country_id'] = $this->input->post('vendor_country_id');
						$post['user_state_id'] = $this->input->post('vendor_state_id');
						$post['user_city'] = $this->input->post('vendor_city');
						$post['user_address_1'] = $this->input->post('vendor_address_1');
						$post['user_address_2'] = $this->input->post('vendor_address_2');
						$post['user_postal_code'] = $this->input->post('vendor_postal_code');
						$post['user_updated_date'] = date('Y-m-d');
						$this->vendor_model->updateVendor($post);

						$msg = 'Vendor update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/vendor');
					}
					else
					{
						$this->data['country_list'] = $this->vendor_model->getCountryList();
						$this->data['role_list'] = $this->vendor_model->getRoleList();
						$this->data['state_list'] = $this->vendor_model->getStateList();
						$this->data['vendor_edit'] = $this->vendor_model->editVendor($vendor_id);
						$this->show_view_admin('admin/vendor_update', $this->data);
					}
				}
				else
				{
					$this->data['country_list'] = $this->vendor_model->getCountryList();
					$this->data['role_list'] = $this->vendor_model->getRoleList();
					$this->data['state_list'] = $this->vendor_model->getStateList();
					$this->data['vendor_edit'] = $this->vendor_model->editVendor($vendor_id);
					$this->show_view_admin('admin/vendor_update', $this->data);
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
					
					$this->form_validation->set_rules($this->validation_rules['vendorAdd']);
					if($this->form_validation->run())
					{
						$post['user_type'] = 'Vendor';						
						$post['user_name'] = $this->input->post('vendor_name');
						$post['user_email'] = $this->input->post('vendor_email');
						$post['user_phone'] = $this->input->post('vendor_phone');
						$post['user_password'] = $this->input->post('vendor_password');
						$post['user_status'] = $this->input->post('vendor_status');
						$post['user_role_id'] = '2';
						$post['user_country_id'] = $this->input->post('vendor_country_id');
						$post['user_state_id'] = $this->input->post('vendor_state_id');
						$post['user_city'] = $this->input->post('vendor_city');
						$post['user_address_1'] = $this->input->post('vendor_address_1');
						$post['user_address_2'] = $this->input->post('vendor_address_2');
						$post['user_postal_code'] = $this->input->post('vendor_postal_code');
						$post['added_by'] = $this->data['user_id'];
						$post['user_created_date'] = date('Y-m-d');
						$post['user_updated_date'] = date('Y-m-d');						
						$vendor_id =  $this->vendor_model->addvendor($post);

						if($vendor_id)
						{		
							$message = '';										
							$subject = 'Party Shaarty';						
							$message .= 'Thanks for choosing Party Shaarty<br/><br/>';
							$message .= 'Your Ragistration successfully.<br/><br/>';
							$message .= 'Click to login ...  '.base_url().'<br/><br/>';
							$mail = $this->send_mail($post['user_email'], $subject, $message);
							$msg = 'vendor added successfully!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/vendor');
						}
						else
						{
							$msg = 'oops, looks like something went wrong!';			
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/vendor/vendor_add');
						}
					}
					else
					{
						$this->data['country_list'] = $this->vendor_model->getCountryList();
						$this->data['role_list'] = $this->vendor_model->getRoleList();
						$this->show_view_admin('admin/vendor_add', $this->data);
					}		
				}
				else
				{
					$this->data['country_list'] = $this->vendor_model->getCountryList();
					$this->data['role_list'] = $this->vendor_model->getRoleList();
					$this->show_view_admin('admin/vendor_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_vendor()
	{
		if($this->checkDeletePermission())
		{
			$vendor_id = $this->uri->segment(4);
			
			$this->vendor_model->delete_vendor($vendor_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/vendor'); 
			}
			else
			{
				$msg = 'Vendor remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/vendor');
			}
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
		$state_list = $this->vendor_model->getStateListByCountryId($country_id);

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
		echo $status_res = $this->vendor_model->updateStatus($post);
	}
}

/* End of file */?>