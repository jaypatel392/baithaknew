<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coupon extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/coupon_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'couponAdd' => array(
            array(
                'field' => 'coupon_code',
                'label' => 'coupon code',
                'rules' => 'trim|required|is_unique[tbl_coupon.coupon_code]'
            ),
            array(
                'field' => 'coupon_value',
                'label' => 'coupon value',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_start_date',
                'label' => 'coupon start date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_end_date',
                'label' => 'coupon end date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_type',
                'label' => 'coupon type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'coupon_status',
                'label' => 'coupon status',
                'rules' => 'trim|required'
            )         
        ),
		'couponUpdate' => array(
        	array(
                'field' => 'coupon_code',
                'label' => 'coupon code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_value',
                'label' => 'coupon value',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_start_date',
                'label' => 'coupon start date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_end_date',
                'label' => 'coupon end date',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'coupon_type',
                'label' => 'coupon type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'coupon_status',
                'label' => 'coupon status',
                'rules' => 'trim|required'
            )    
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['coupon_result'] = $this->coupon_model->getAllCoupon();
			$this->show_view_admin('admin/coupon', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addCoupon()
	{
		$coupon_id = $this->uri->segment(4);
		if($coupon_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['couponUpdate']);
					if($this->form_validation->run())
					{
						$post['coupon_id'] = $coupon_id;
						$post['coupon_code'] = $this->input->post('coupon_code');
						$post['coupon_value'] = $this->input->post('coupon_value');
						$post['coupon_start_date'] = $this->input->post('coupon_start_date');
						$post['coupon_end_date'] = $this->input->post('coupon_end_date');
						$post['coupon_type'] = $this->input->post('coupon_type');
						$post['coupon_status'] = $this->input->post('coupon_status');
						$post['coupon_updated_date'] = date('Y-m-d');
						$this->coupon_model->updateCoupon($post);

						$msg = 'Coupon update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/coupon');
					}
					else
					{
						$this->data['coupon_edit'] = $this->coupon_model->editCoupon($coupon_id);
						$this->data['user_list'] = $this->coupon_model->getAllUserList();
						$this->show_view_admin('admin/coupon_update', $this->data);
					}
				}
				else
				{
					$this->data['coupon_edit'] = $this->coupon_model->editCoupon($coupon_id);
					$this->data['user_list'] = $this->coupon_model->getAllUserList();
					$this->show_view_admin('admin/coupon_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['couponAdd']);
					if($this->form_validation->run())
					{
						$post['added_by'] = $this->data['user_id'];
						$post['coupon_code'] = $this->input->post('coupon_code');
						$post['coupon_value'] = $this->input->post('coupon_value');
						$post['coupon_start_date'] = $this->input->post('coupon_start_date');
						$post['coupon_end_date'] = $this->input->post('coupon_end_date');
						$post['coupon_type'] = $this->input->post('coupon_type');
						$post['send_code_type'] = $this->input->post('send_code_type');
						if($post['send_code_type'] == 'custom')
						{
							
						}
						$post['coupon_created_date'] = date('Y-m-d');
						$post['coupon_updated_date'] = date('Y-m-d');
						$coupon_id =  $this->coupon_model->addCoupon($post);

						if($coupon_id)
						{
							$msg = 'Coupon added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/coupon');
						}
						else
						{
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/coupon/coupon_add');
						}
					}
					else
					{
						$this->data['user_list'] = $this->coupon_model->getAllUserList();
						$this->show_view_admin('admin/coupon_add', $this->data);
					}		
				}
				else
				{
					$this->data['user_list'] = $this->coupon_model->getAllUserList();
					$this->show_view_admin('admin/coupon_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_coupon()
	{
		if($this->checkDeletePermission())
		{
			$coupon_id = $this->uri->segment(4);
			
			$this->coupon_model->delete_coupon($coupon_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/coupon'); 
			}
			else
			{
				$msg = 'Coupon remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/coupon');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	// check duplicacy
	public function checkCouponCode()
	{
		$coupon_code = $this->input->post('coupon_code');
		$coupon_id = $this->input->post('coupon_id');      
		$result = $this->category_model->checkCouponCode($coupon_code,$coupon_id);
		
		if($result)
		{
			echo 0;
		}
		else
		{
			echo 1;
	   	}
	}	
}

/* End of file */?>