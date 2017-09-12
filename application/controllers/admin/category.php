<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller 
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/category_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'categoryAdd' => array(
            array(
                'field' => 'category_name',
                'label' => 'Category name',
                'rules' => 'trim|required'
            ) 
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['category_result'] = $this->category_model->getAllCategory();	
			$this->data['specifiction_result'] = $this->category_model->getAllSpecificationCategory();
			
			$this->show_view_admin('admin/category', $this->data);
			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addCategory()
	{     
		$cat_id = $this->uri->segment(4);
		if($cat_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['categoryAdd']);
					if($this->form_validation->run())
					{
						$post['category_parent_id'] = $this->input->post('category_parent_id');
						$post['category_name'] = $this->input->post('category_name');
						$post['category_description'] = $this->input->post('category_description');
						if ($_FILES["category_img"]["name"]) 
						{
	                        $category_img         = 'category_img';
	                        $fieldName            = "category_img";
	                        $Path                 = 'webroot/admin/upload/category/';
	                        $category_img         = $this->ImageUpload($_FILES["category_img"]["name"], $category_img, $Path, $fieldName);
	                        $post['category_img'] = $category_img;
	                        $post['category_img_path'] = base_url().''.$Path;
	                    }
						
						$post['category_status'] = $this->input->post('category_status');
						$post['category_updated_date'] = date('Y-m-d');
					
						$update_res = $this->category_model->updateCategory($post,$cat_id);
						if($update_res)
						{
							$msg = 'Category update successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/category');
						}
					}
					else
					{
						$this->data['category_edit'] = $this->category_model->editCategory($cat_id);
						$this->data['parent_category_list'] = $this->category_model->getParentCategory($cat_id);						
						$this->show_view_admin('admin/category_update', $this->data);
					}
				}
				else
				{
					$this->data['category_edit'] = $this->category_model->editCategory($cat_id);
					$this->data['parent_category_list'] = $this->category_model->getParentCategory($cat_id);
					$this->show_view_admin('admin/category_update', $this->data);
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
					$this->form_validation->set_rules($this->validation_rules['categoryAdd']);
					if($this->form_validation->run())
					{
						
						$category_id = $this->input->post('category_id');
						if(!empty($category_id))
						{
							$all_levels = '';
							$cat_id = '';
							for ($i=0; $i < count($category_id); $i++) 
							{ 
								if($category_id[$i]){
									if($i == 0)
									{
										$all_levels = $category_id[$i];
									}
									else
									{
										$all_levels = $all_levels.','.$category_id[$i];
									}
									$cat_id = $category_id[$i];
								  }
							 }
							$post['category_parent_id'] = $cat_id;
							$post['category_level_no'] = $all_levels;
						}

						$post['category_name'] = $this->input->post('category_name');
						$post['category_description'] = $this->input->post('category_description');
						if ($_FILES["category_img"]["name"]) 
						{
                            $category_img         = 'category_img';
                            $fieldName            = "category_img";
                            $Path                 = 'webroot/admin/upload/category/';
                            $category_img         = $this->ImageUpload($_FILES["category_img"]["name"], $category_img, $Path, $fieldName);
                            $post['category_img'] = $category_img;
                            $post['category_img_path'] = base_url().''.$Path;
                        }						
						$post['category_status'] = $this->input->post('category_status');
						$post['category_created_date'] = date('Y-m-d');
						$post['category_updated_date'] = date('Y-m-d');
						$post['added_by'] = $this->data['user_id'];
						$cat_id =  $this->category_model->addCategory($post);
                        if($cat_id)
                        {
	                        $msg = 'Category added successfully!!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/category');
					  }
					  else
					  {
					  		$msg = 'Process failed !!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					  }
					}
					else
					{
						$this->data['parent_category_list'] = $this->category_model->getParentCategory();
						$this->show_view_admin('admin/category_add', $this->data);
					}		
				}
				else
				{
					$this->data['parent_category_list'] = $this->category_model->getParentCategory();
					$this->show_view_admin('admin/category_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	// check duplicacy
	public function checkCategory()
	{
		$category_name = $this->input->post('category_name');
		$category_id = $this->input->post('category_id');      
		$result = $this->category_model->checkCategory($category_name,$category_id);
		
		if($result)
		{
			echo 0;
		}
		else
		{
			echo 1;
	   	}
	}
	/* Delete */
	public function delete_category()
	{
		if($this->checkDeletePermission())
		{
			$cat_id = $this->uri->segment(4);			
			
			$this->category_model->delete_category($cat_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				  redirect(base_url().'admin/role'); 
			}
			else
			{
				$msg = 'Role remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/category');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

	/* Get Parent category List */
	public function getParentSubCategory()
	{
		$parent_cat_id = $this->input->post('parent_cat_id');
		$sub_category_list = $this->category_model->getParentSubCategory($parent_cat_id);

		$html = '';
		if(count($sub_category_list) > 0)
		{
			$html .= '<option value=""></option>';
			foreach ($sub_category_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->category_id.'">'.$s_list->category_name.'</option>';
			}
			
			echo $html;
		}
		else
		{
			echo $html;
		}
	}

	/* Get Parent category List */
	public function getSpecificationBytype()
	{
		$specification_type = $this->input->post('specification_type');
		$specification_list = $this->category_model->getSpecificationBytype($specification_type);
         
		$html = '';
		if(count($specification_list) > 0)
		{
			foreach ($specification_list as $s_list) 
			{
				$html .=  '<input type="checkbox" name="specificatin_value[]" value="'.$s_list->specification_id.'">&nbsp;'.$s_list->specification_name.'&nbsp;&nbsp;';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}
}
