<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DiscountMrp extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/discountmrp_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'discountmrpAdd' => array(
            array(
                'field' => 'discountmrp_for_dr',
                'label' => 'Percent For Dr.',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'discountmrp_for_hospitalist',
                'label' => 'Percent For Hospitalist',
                'rules' => 'trim|required'
            ),		 
            array(
                'field' => 'discountmrp_for_pharma_wholseller',
                'label' => 'Percent For Pharma Wholseller',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'discountmrp_for_chemist',
                'label' => 'Percent For Chemist',
                'rules' => 'trim|required'
            )			
        ), 

        'discountmrpUpdate' => array(
            array(
                'field' => 'discountmrp_for_dr',
                'label' => 'Percent For Dr.',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'discountmrp_for_hospitalist',
                'label' => 'Percent For Hospitalist',
                'rules' => 'trim|required'
            ),		 
            array(
                'field' => 'discountmrp_for_pharma_wholseller',
                'label' => 'Percent For Pharma Wholseller',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'discountmrp_for_chemist',
                'label' => 'Percent For Chemist',
                'rules' => 'trim|required'
            )
        )		
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['discountmrp_result'] = $this->discountmrp_model->getAllDiscountMrp();	
			$this->show_view_admin('admin/discountmrp', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addDiscountMrp()
	{     
		$discountmrp_id = $this->uri->segment(4);
		if($discountmrp_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['discountmrpUpdate']);
					if($this->form_validation->run())
					{
						$post['discountmrp_for_dr'] = $this->input->post('discountmrp_for_dr');
						$post['discountmrp_for_hospitalist'] = $this->input->post('discountmrp_for_hospitalist');						
						$post['discountmrp_for_pharma_wholseller'] = $this->input->post('discountmrp_for_pharma_wholseller');						
						$post['discountmrp_for_chemist'] = $this->input->post('discountmrp_for_chemist');					
						$post['discountmrp_update_date'] = date('Y-m-d');				
						$update_res = $this->discountmrp_model->updateDiscountMrp($post,$discountmrp_id);
						$msg = 'Discount MRP update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/discountMrp');
					}
					else
					{
						$this->data['discountmrp_edit'] = $this->discountmrp_model->editDiscountMrp($discountmrp_id);
						$this->show_view_admin('admin/discountmrp_update', $this->data);
					}
				}
				else
				{
					$this->data['discountmrp_edit'] = $this->discountmrp_model->editDiscountMrp($discountmrp_id);
					$this->show_view_admin('admin/discountmrp_update', $this->data);
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
					
					$this->form_validation->set_rules($this->validation_rules['discountmrpAdd']);
					if($this->form_validation->run())
					{
						$post['discountmrp_for_dr'] = $this->input->post('discountmrp_for_dr');
						$post['discountmrp_for_hospitalist'] = $this->input->post('discountmrp_for_hospitalist');						
						$post['discountmrp_for_pharma_wholseller'] = $this->input->post('discountmrp_for_pharma_wholseller');						
						$post['discountmrp_for_chemist'] = $this->input->post('discountmrp_for_chemist');						
						$post['discountmrp_created_date'] = date('Y-m-d');
						$post['discountmrp_update_date'] = date('Y-m-d');
						$dismrp_id = $this->discountmrp_model->addDiscountMrp($post);
                        if($dismrp_id)
                        {
                        	
	                        $msg = 'Discount MRP added successfully!!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/discountMrp');
					  	}
					  	else
					  	{
						  	$msg = 'Process failed please try again!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/discountMrp');
					  	}
					}
					else
					{						
						$this->show_view_admin('admin/discountmrp_add', $this->data);
					}		
				}
				else
				{					
					$this->show_view_admin('admin/discountmrp_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}	
	
	/* Delete */
	public function deleteDiscountMrp()
	{
		if($this->checkDeletePermission())
		{
			$discountmrp_id = $this->uri->segment(4);
			$this->discountmrp_model->deleteDiscountMrp($discountmrp_id);
		
				$msg = 'Discount MRP remove successfully...!';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/discountMrp');
			
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}
}
