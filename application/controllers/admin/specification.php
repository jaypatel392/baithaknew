<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Specification extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/specification_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'specificationAdd' => array(
            array(
                'field' => 'specification_name',
                'label' => 'specification name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'specification_type',
                'label' => 'Specification Type',
                'rules' => 'trim|required'
            )
            
        ),
		'specificationUpdate' => array(
        	array(
                'field' => 'specification_name',
                'label' => 'specification name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'specification_type',
                'label' => 'Specification Type',
                'rules' => 'trim|required'
            )
           
        )
    );	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['specification_result'] = $this->specification_model->getAllSpecification();
			$this->data['specification_value'] = $this->specification_model->getSpecificationValue();			
			$this->show_view_admin('admin/specification', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addspecification()
	{
		$specification_id = $this->uri->segment(4);
		if($specification_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['specificationUpdate']);
					if($this->form_validation->run())
					{
						$post['specification_id'] = $specification_id;
						$post['specification_name'] = $this->input->post('specification_name');
						$post['specification_status'] = $this->input->post('specification_status');
						$post['specification_type'] = $this->input->post('specification_type');

						$this->specification_model->updateSpecification($post);
						$specification_value_new = $this->specification_model->editspecificationValue($specification_id);
						
						foreach ($specification_value_new as $value)
						{
							//echo 'specification_new_value_'.$value->specification_val_id; 
							$post_s_v['specification_val'] = $this->input->post('specification_new_value_'.$value->specification_val_id);
							$post_s_v['specification_val_id'] = $value->specification_val_id;
							
							$this->specification_model->updateSpecificationValue($post_s_v);
                        }
                       // die();
                        $spci_value = $this->input->post('specification_value');
                        if($spci_value)
                        {
                         
                             for($i = 0; $i < count($spci_value); $i++){
								$post['specification_val'] = $spci_value[$i];
						        $post['specification_id'] = $specification_id;
						        $this->specification_model->addSpecificationValue($post);
						    }
						}

						$msg = 'specification update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/specification');
					}
					else
					{
						$this->data['specification_edit'] = $this->specification_model->editspecification($specification_id);
						$this->show_view_admin('admin/specification_update', $this->data);
					}
				}
				else
				{
					$this->data['specification_edit'] = $this->specification_model->editspecification($specification_id);
					$this->data['specification_value_edit'] = $this->specification_model->editspecificationValue($specification_id);
						$this->show_view_admin('admin/specification_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['specificationAdd']);
					if($this->form_validation->run())
					{
						$post['added_by'] = $this->data['user_id'];
						$post['specification_name'] = $this->input->post('specification_name');
						$post['specification_status'] = $this->input->post('specification_status');
						$post['specification_type'] = $this->input->post('specification_type');
						
						$specification_id =  $this->specification_model->addSpecification($post);

						if($specification_id)
						{
							$spci_value = $this->input->post('specification_value');
							
							for($i = 0; $i < count($spci_value); $i++) {

								$post['specification_val'] = $spci_value[$i];
						        $post['specification_id'] = $specification_id;
						        $this->specification_model->addSpecificationValue($post);
						       
							}

							$msg = 'specification added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/specification');
						}
						else
						{
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/specification/specification_add');
						}
					}
					else
					{
						$this->show_view_admin('admin/specification_add', $this->data);
					}		
				}
				else
				{
					$this->show_view_admin('admin/specification_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_specification()
	{
		if($this->checkDeletePermission())
		{
			$specification_id = $this->uri->segment(4);
			
			$this->specification_model->delete_specification($specification_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/specification'); 
			}
			else
			{
				$msg = 'specification remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/specification');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}	
}

/* End of file */?>