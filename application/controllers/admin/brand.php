<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Brand extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/brand_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'brandAdd' => array(
            array(
                'field' => 'brand_name',
                'label' => 'Brand name',
                'rules' => 'trim|required|is_unique[tbl_brand.brand_name]'
            ),
			
        ),
		'brandUpdate' => array(
           array(
               'field' => 'brand_name',
                'label' => 'brand name',
                'rules' => 'trim|required'
            )
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['brand_result'] = $this->brand_model->getAllBrand();	
			
			$this->show_view_admin('admin/brand', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addBrand()
	{
      
		$brand_id = $this->uri->segment(4);
		if($brand_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{

					$this->form_validation->set_rules($this->validation_rules['brandUpdate']);
					if($this->form_validation->run())
					{
						$post['brand_id'] = $brand_id;
						$post['brand_name'] = $this->input->post('brand_name');
						$post['brand_description'] = $this->input->post('brand_description');
					   if ($_FILES["brand_logo"]["name"]) {
                            $brand_logo         = 'brand_logo';
                            $fieldName            = "brand_logo";
                            $Path                 = 'webroot/admin/upload/brand/';
                            $brand_logo         = $this->ImageUpload($_FILES["brand_logo"]["name"], $brand_logo, $Path, $fieldName);
                            $post['brand_logo'] = $brand_logo;
                        }
						$post['brand_status'] = $this->input->post('brand_status');
						$post['brand_updated_date'] = date('Y-m-d');
						$res = $this->brand_model->updateBrand($post);
						if($res){									
						$msg = 'Brand update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						 redirect(base_url().'admin/brand');
					   }
					}
					else
					{
						echo "sdgdfgdfg"; die;
						$this->data['brand_edit'] = $this->brand_model->editBrand($brand_id);										
					$this->show_view_admin('admin/brand_update', $this->data);
					}
				}
				else
				{

					$this->data['brand_edit'] = $this->brand_model->editBrand($brand_id);										
					$this->show_view_admin('admin/brand_update', $this->data);		
					
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
					$this->form_validation->set_rules($this->validation_rules['brandAdd']);
					if($this->form_validation->run())
					{
						$post['brand_name'] = $this->input->post('brand_name');
						$post['brand_description'] = $this->input->post('brand_description');
					   if ($_FILES["brand_logo"]["name"]) {
                            $brand_logo         = 'brand_logo';
                            $fieldName            = "brand_logo";
                            $Path                 = 'webroot/admin/upload/brand/';
                            $brand_logo         = $this->ImageUpload($_FILES["brand_logo"]["name"], $brand_logo, $Path, $fieldName);
                            $post['brand_logo'] = $brand_logo;
                        }
						$post['brand_status'] = $this->input->post('brand_status');
						$post['brand_created_date'] = date('Y-m-d');
						$post['brand_updated_date'] = date('Y-m-d');
						$post['added_by'] = $this->data['user_id'];
						$brand_id =  $this->brand_model->addBrand($post);
                        if($brand_id){
                        $msg = 'Brand added successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/brand');
					  }else{
					  	$msg = 'Process failed !!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					  }
					}
					else
					{
						
						$this->show_view_admin('admin/brand_add', $this->data);
					}		
				}
				else
				{
					
					$this->show_view_admin('admin/brand_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	
	/* Delete */
	public function delete_brand()
	{
		if($this->checkDeletePermission())
		{
			$brand_id = $this->uri->segment(4);			
			
			$this->brand_model->delete_brand($brand_id);
			
				$msg = 'Brand remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/brand');
			
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

}
