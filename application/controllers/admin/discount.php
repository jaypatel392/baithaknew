<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Discount extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/discount_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'discountAdd' => array(
            array(
                'field' => 'discount_name',
                'label' => 'discount name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'discount_type',
                'label' => 'discount type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'discount_value',
                'label' => 'discount value',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'discount_start_date',
                'label' => 'discount start date',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'discount_end_date', 
				'label' => 'discount end date',   
				'rules' => 'trim|required'  
			)          
        ),
		'discountUpdate' => array(
        	 array(
                'field' => 'discount_name',
                'label' => 'discount name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'discount_type',
                'label' => 'discount type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'discount_value',
                'label' => 'discount value',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'discount_start_date',
                'label' => 'discount start date',
                'rules' => 'trim|required'
            ),
             array( 
				'field' => 'discount_end_date', 
				'label' => 'discount end date',   
				'rules' => 'trim|required'  
			)    
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['discount_result'] = $this->discount_model->getAllDiscount();
			$this->show_view_admin('admin/discount', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addDiscount()
	{
		$discount_id = $this->uri->segment(4);
		if($discount_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['discountUpdate']);
					if($this->form_validation->run())
					{
						$post['discount_id'] = $discount_id;
						$post['discount_name'] = $this->input->post('discount_name');
						$post['discount_type'] = $this->input->post('discount_type');
						$post['discount_value'] = $this->input->post('discount_value');
						$post['discount_start_date'] = $this->input->post('discount_start_date');						
						$post['discount_end_date'] = $this->input->post('discount_end_date');
						$post['discount_status'] = $this->input->post('discount_status');						
						$post['discount_updated_date'] = date('Y-m-d');
						$this->discount_model->updateDiscount($post);

						$msg = 'Discount update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/discount');
					}
					else
					{
						$this->data['discount_edit'] = $this->discount_model->editDiscount($discount_id);
						$this->show_view_admin('admin/discount_update', $this->data);
					}
				}
				else
				{
					$this->data['discount_edit'] = $this->discount_model->editDiscount($discount_id);
						$this->show_view_admin('admin/discount_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['discountAdd']);
					if($this->form_validation->run())
					{
						$post['added_by'] = $this->data['user_id'];

						$post['discount_name'] = $this->input->post('discount_name');
						$post['discount_value'] = $this->input->post('discount_value');
						$post['discount_type'] = $this->input->post('discount_type');
						$post['discount_start_date'] = $this->input->post('discount_start_date');						
						$post['discount_end_date'] = $this->input->post('discount_end_date');
						$post['discount_status'] = $this->input->post('discount_status');						
						$post['discount_created_date'] = date('Y-m-d');
						$post['discount_updated_date'] = date('Y-m-d');
						$discount_id =  $this->discount_model->addDiscount($post);

						if($discount_id)
						{
							$msg = 'Discount added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/discount');
						}
						else
						{
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/discount/discount_add');
						}
					}
					else
					{
						$this->show_view_admin('admin/discount_add', $this->data);
					}		
				}
				else
				{
					$this->show_view_admin('admin/discount_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_discount()
	{
		if($this->checkDeletePermission())
		{
			$discount_id = $this->uri->segment(4);
			
			$this->discount_model->delete_discount($discount_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/discount'); 
			}
			else
			{
				$msg = 'Discount remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/discount');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}	
}

/* End of file */?>