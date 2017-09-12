<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tax extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/tax_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'taxAdd' => array(
            array(
                'field' => 'tax_name',
                'label' => 'tax name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'tax_type',
                'label' => 'tax type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'tax_value',
                'label' => 'tax value',
                'rules' => 'trim|required'
            )         
        ),
		'taxUpdate' => array(
        	array(
                'field' => 'tax_name',
                'label' => 'tax name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'tax_type',
                'label' => 'tax type',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'tax_value',
                'label' => 'tax value',
                'rules' => 'trim|required'
            )   
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['tax_result'] = $this->tax_model->getAllTax();
			$this->show_view_admin('admin/tax', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addTax()
	{
		$tax_id = $this->uri->segment(4);
		if($tax_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['taxUpdate']);
					if($this->form_validation->run())
					{
						$post['tax_id'] = $tax_id;
						$post['tax_name'] = $this->input->post('tax_name');
						$post['tax_type'] = $this->input->post('tax_type');
						$post['tax_value'] = $this->input->post('tax_value');
						$post['tax_status'] = $this->input->post('tax_status');						
						$post['tax_updated_date'] = date('Y-m-d');
						$this->tax_model->updateTax($post);

						$msg = 'Tax update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/tax');
					}
					else
					{
						$this->data['tax_edit'] = $this->tax_model->editTax($tax_id);
						$this->show_view_admin('admin/tax_update', $this->data);
					}
				}
				else
				{
					$this->data['tax_edit'] = $this->tax_model->editTax($tax_id);
						$this->show_view_admin('admin/tax_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['taxAdd']);
					if($this->form_validation->run())
					{
						$post['added_by'] = $this->data['user_id'];

						$post['tax_name'] = $this->input->post('tax_name');
						$post['tax_value'] = $this->input->post('tax_value');
						$post['tax_type'] = $this->input->post('tax_type');
						$post['tax_status'] = $this->input->post('tax_status');						
						$post['tax_created_date'] = date('Y-m-d');
						$post['tax_updated_date'] = date('Y-m-d');
						$tax_id =  $this->tax_model->addTax($post);

						if($tax_id)
						{
							$msg = 'Tax added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/tax');
						}
						else
						{
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/tax/tax_add');
						}
					}
					else
					{
						$this->show_view_admin('admin/tax_add', $this->data);
					}		
				}
				else
				{
					$this->show_view_admin('admin/tax_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_tax()
	{
		if($this->checkDeletePermission())
		{
			$tax_id = $this->uri->segment(4);
			
			$this->tax_model->delete_tax($tax_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/tax'); 
			}
			else
			{
				$msg = 'Tax remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/tax');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}	
}

/* End of file */?>