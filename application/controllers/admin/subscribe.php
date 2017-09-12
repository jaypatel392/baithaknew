<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscribe extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/subscribe_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'subscribeAdd' => array(
            array(
                'field' => 'subscribe_name',
                'label' => 'Subscribe name',
                'rules' => 'trim|required|is_unique[tbl_subscribe.subscribe_name]'
            ),
             array(
                'field' => 'subscribe_plan',
                'label' => 'Subscribe plan',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subscribe_limit',
                'label' => 'Subscribe limit',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subscribe_charge',
                'label' => 'Subscribe charge',
                'rules' => 'trim|required'
            )
			
        ),
		'subscribeUpdate' => array(
           array(
                'field' => 'subscribe_name',
                'label' => 'Subscribe name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subscribe_plan',
                'label' => 'Subscribe plan',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subscribe_limit',
                'label' => 'Subscribe limit',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'subscribe_charge',
                'label' => 'Subscribe charge',
                'rules' => 'trim|required'
            )
       
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['subscribe_result'] = $this->subscribe_model->getAllSubscribePlan();
			$this->show_view_admin('admin/subscribe', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addSubscribe()
	{
     
		$subs_id = $this->uri->segment(4);
		if($subs_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['subscribeUpdate']);
					if($this->form_validation->run())
					{						

						$post['subscribe_id'] = $subs_id;
						$post['subscribe_name'] = $this->input->post('subscribe_name');
						$post['subscribe_plan'] = $this->input->post('subscribe_plan');
						$post['subscribe_limit'] = $this->input->post('subscribe_limit');
						$post['subscribe_charge'] = $this->input->post('subscribe_charge');	
						$post['subscribe_description'] = $this->input->post('subscribe_description');	
						$post['subscribe_status'] = $this->input->post('subscribe_status');
						$post['subscribe_update_date'] = date('Y-m-d');
						$update_res = $this->subscribe_model->updateSubscribe($post);
						
						$msg = 'Subscribe update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/subscribe');
					}
					else
					{
						$this->data['subscribe_edit'] = $this->subscribe_model->editSubscribe($subs_id);									
						$this->show_view_admin('admin/subscribe_update', $this->data);
					}
				}
				else
				{
					$this->data['subscribe_edit'] = $this->subscribe_model->editSubscribe($subs_id);					
					$this->show_view_admin('admin/subscribe_update', $this->data);
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

					$this->form_validation->set_rules($this->validation_rules['subscribeAdd']);
					if($this->form_validation->run())
					{
						$post['subscribe_name'] = $this->input->post('subscribe_name');
						$post['subscribe_plan'] = $this->input->post('subscribe_plan');
						$post['subscribe_limit'] = $this->input->post('subscribe_limit');
						$post['subscribe_charge'] = $this->input->post('subscribe_charge');	
						$post['subscribe_description'] = $this->input->post('subscribe_description');	
						$post['subscribe_status'] = $this->input->post('subscribe_status');
						$post['subscribe_created_date'] = date('Y-m-d');
						$post['subscribe_created_date'] = date('Y-m-d');
						$subs_id =  $this->subscribe_model->addsubscribe($post);
                        if($subs_id)
                        {                        	
							$msg = 'Subscribe added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/subscribe');
					  }
					  else
					  {
						  	$msg = 'Process failed !!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					  }
					}
					else
					{
						
						$this->show_view_admin('admin/subscribe_add', $this->data);
					}		
				}
				else
				{						
					$this->show_view_admin('admin/subscribe_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	
	/* Delete */
	public function delete_subscribe()
	{
		if($this->checkDeletePermission())
		{
			$subs_id = $this->uri->segment(4);
			$subscribe_del = $this->subscribe_model->delete_subscribe($subs_id);

			if ($subscribe_del)
			{

				$msg = 'Subscribe remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/subscribe');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}
	
}

?>
