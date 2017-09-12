<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shipping extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/shipping_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'shippingAdd' => array(
            array(
                'field' => 'shipping_name',
                'label' => 'shipping name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_type',
                'label' => 'shipping type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'shipping_value',
                'label' => 'shipping value',
                'rules' => 'trim|required'
            )         
        ),
		'shippingUpdate' => array(
        	array(
                'field' => 'shipping_name',
                'label' => 'shipping name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'shipping_type',
                'label' => 'shipping type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'shipping_value',
                'label' => 'shipping value',
                'rules' => 'trim|required'
            )   
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['shipping_result'] = $this->shipping_model->getAllShipping();
			$this->show_view_admin('admin/shipping', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addShipping()
	{
		$shipping_id = $this->uri->segment(4);
		if($shipping_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['shippingUpdate']);
					if($this->form_validation->run())
					{
						$post['shipping_id'] = $shipping_id;
						$post['shipping_name'] = $this->input->post('shipping_name');
						$post['shipping_type'] = $this->input->post('shipping_type');
						$post['shipping_multiply_type'] = $this->input->post('shipping_multiply_type');
						$post['shipping_multiply_value'] = $this->input->post('shipping_multiply_value');
						$post['shipping_value'] = $this->input->post('shipping_value');
						$post['shipping_status'] = $this->input->post('shipping_status');						
						$post['shipping_updated_date'] = date('Y-m-d');
						$this->shipping_model->updateShipping($post);

						$msg = 'shipping update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/shipping');
					}
					else
					{
						$this->data['shipping_edit'] = $this->shipping_model->editShipping($shipping_id);
						$this->show_view_admin('admin/shipping_update', $this->data);
					}
				}
				else
				{
					$this->data['shipping_edit'] = $this->shipping_model->editShipping($shipping_id);
						$this->show_view_admin('admin/shipping_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['shippingAdd']);
					if($this->form_validation->run())
					{
						$post['added_by'] = $this->data['user_id'];

						$post['shipping_name'] = $this->input->post('shipping_name');
						$post['shipping_value'] = $this->input->post('shipping_value');
						$post['shipping_type'] = $this->input->post('shipping_type');
						$post['shipping_status'] = $this->input->post('shipping_status');
						$post['shipping_multiply_type'] = $this->input->post('shipping_multiply_type');
						$post['shipping_multiply_value'] = $this->input->post('shipping_multiply_value');						
						$post['shipping_created_date'] = date('Y-m-d');
						$post['shipping_updated_date'] = date('Y-m-d');
						$shipping_id =  $this->shipping_model->addShipping($post);

						if($shipping_id)
						{
							$msg = 'shipping added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/shipping');
						}
						else
						{
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/shipping/shipping_add');
						}
					}
					else
					{
						$this->show_view_admin('admin/shipping_add', $this->data);
					}		
				}
				else
				{
					$this->show_view_admin('admin/shipping_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_shipping()
	{
		if($this->checkDeletePermission())
		{
			$shipping_id = $this->uri->segment(4);
			
			$this->shipping_model->delete_shipping($shipping_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/shipping'); 
			}
			else
			{
				$msg = 'shipping remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/shipping');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}	
}

/* End of file */?>