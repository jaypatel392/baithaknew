<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Measurement extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/measurement_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'measurementAdd' => array(
            array(
                'field' => 'measurement_name',
                'label' => 'Measurement name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'measurement_level',
                'label' => 'Measurement level',
                'rules' => 'trim|required'
            )			
        ),
		'measurementUpdate' => array(
           array(
                'field' => 'measurement_name',
                'label' => 'Measurement name',
                'rules' => 'trim|required'
            ),
             array(
                'field' => 'measurement_level',
                'label' => 'Measurement level',
                'rules' => 'trim|required'
            )
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['measurement_result'] = $this->measurement_model->getAllMeasurement();	
			$this->show_view_admin('admin/measurement', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addMeasurement()
	{     
		$msm_id = $this->uri->segment(4);
		if($msm_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['measurementUpdate']);
					if($this->form_validation->run())
					{
						$check_change_measurement = $this->input->post('check_change_measurement');
						
											
						if(!empty($check_change_measurement)){
								
							$p_measurement_id = $this->input->post('p_measurement_id');
							
							$all_levels = '';
							
							for ($i=0; $i < count($p_measurement_id); $i++) { 
								if($p_measurement_id[$i]){
									if($i == 0){

										$all_levels = $p_measurement_id[$i];

									}else{

										$all_levels = $all_levels.','.$p_measurement_id[$i];

									}
									    $msmp_id = $p_measurement_id[$i];
								  }							

							 }

							$post['measurement_parent_id'] = $msmp_id;
							$post['measurement_level_no'] = $all_levels;
						}

						$post['measurement_id'] = $msm_id;
						$post['measurement_name'] = $this->input->post('measurement_name');
						$post['measurement_type'] = $this->input->post('measurement_type');
						$post['measurement_description'] = $this->input->post('measurement_description');
						
						$post['measurement_status'] = $this->input->post('measurement_status');
						$post['measurement_updated_date'] = date('Y-m-d');
						$update_res = $this->measurement_model->updateMeasurement($post);
						if($update_res){
							if($this->input->post('specifimsmin_value')){
							$specifimsmin_value = $this->input->post('specifimsmin_value');
							$this->measurement_model->delete_specifimsmion($msm_id);
								
							for($i = 0; $i < count($specifimsmin_value); $i++) {

								$post_spc['specifimsmion_id'] = $specifimsmin_value[$i];
						        $post_spc['measurement_id'] = $msm_id;						       
						        $this->measurement_model->addSpecifimsmionValue($post_spc);
						       
							}
						  }else{
						  	$this->measurement_model->delete_specifimsmion($msm_id);
						  }
						}
 
						$msg = 'Measurement update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/measurement');
					}
					else
					{
						$this->data['measurement_edit'] = $this->measurement_model->editMeasurement($msm_id);
						$this->show_view_admin('admin/measurement_update', $this->data);
					}
				}
				else
				{
					$this->data['measurement_edit'] = $this->measurement_model->editMeasurement($msm_id);
					$this->show_view_admin('admin/measurement_update', $this->data);
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
					
					$this->form_validation->set_rules($this->validation_rules['measurementAdd']);
					if($this->form_validation->run())
					{
						$post['measurement_name'] = $this->input->post('measurement_name');
						$post['measurement_level'] = $this->input->post('measurement_level');
						if($post['measurement_level'] == '1')
						{	
							$msm_level_arr = $this->input->post('measurement_level1');
							$post['measurement_level_value'] = json_encode($msm_level_arr);
						}

						if($post['measurement_level'] == '2')
						{	
							$msm_level_arr = $this->input->post('measurement_level2');
							$post['measurement_level_value'] = json_encode($msm_level_arr);
						}
						if($post['measurement_level'] == '3')
						{	
							$msm_level_arr = $this->input->post('measurement_level3');
							$post['measurement_level_value'] = json_encode($msm_level_arr);							
						}
						$post['measurement_created_date'] = date('Y-m-d');
						$post['measurement_update_date'] = date('Y-m-d');
						$post['added_by'] = $this->data['user_id'];
						$msm_id = $this->measurement_model->addMeasurement($post);
                        if($msm_id)
                        {
                        	
	                        $msg = 'Measurement added successfully!!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/measurement');
					  	}
					  	else
					  	{
						  	$msg = 'Process failed !!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					  	}
					}
					else
					{						
						$this->show_view_admin('admin/measurement_add', $this->data);
					}		
				}
				else
				{					
					$this->show_view_admin('admin/measurement_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}	
	
	/* Delete */
	public function deleteMeasurement()
	{
		if($this->checkDeletePermission())
		{
			$msm_id = $this->uri->segment(4);
			$this->measurement_model->deleteMeasurement($msm_id);
		
				$msg = 'Measurement remove successfully...!';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/measurement');
			
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}
}
