<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/event_model');
	}
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['event_result'] = $this->event_model->getAllEvent();
			$this->show_view_admin('admin/event', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addEvent()
	{
		$event_id = $this->uri->segment(4);
		if($event_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['eventUpdate']);
					if($this->form_validation->run())
					{
						$post['event_id'] = $event_id;
						$post['event_name'] = $this->input->post('event_name');
						$post['event_type'] = $this->input->post('event_type');
						$post['event_multiply_type'] = $this->input->post('event_multiply_type');
						$post['event_multiply_value'] = $this->input->post('event_multiply_value');
						$post['event_value'] = $this->input->post('event_value');
						$post['event_status'] = $this->input->post('event_status');						
						$post['event_updated_date'] = date('Y-m-d');
						$this->event_model->updateEvent($post);

						$msg = 'event update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/event');
					}
					else
					{
						$this->data['category_list'] = $this->event_model->getCategoryList();    
					$this->data['discount_list'] = $this->event_model->getDiscountList();
					$this->data['event_edit'] = $this->event_model->editevent($event_id);
					$this->data['event_attr'] = $this->event_model->editEventAttr($event_id);
					$this->data['event_specification'] = $this->event_model->editEventSpecification($event_id);
					$this->data['event_images'] = $this->event_model->editEventImages($event_id);
					$this->data['event_date_time'] = $this->event_model->editEventDateTime($event_id);
					$this->show_view_admin('admin/event_update', $this->data);
					}
				}
				else
				{
					$this->data['event_edit'] = $this->event_model->editevent($event_id);
					$this->data['category_list'] = $this->event_model->getCategoryList();    
					$this->data['sub_category_list'] = $this->event_model->getSubCategoryList($this->data['event_edit'][0]->event_parent_category_id);    
					$this->data['discount_list'] = $this->event_model->getDiscountList();	
					$this->data['event_attr'] = $this->event_model->editEventAttr($event_id);
					$this->data['event_specification'] = $this->event_model->editEventSpecification($event_id);
					$this->data['event_images'] = $this->event_model->editEventImages($event_id);
					$this->data['event_date_time'] = $this->event_model->editEventDateTime($event_id);
					$this->show_view_admin('admin/event_update', $this->data);
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

						$post['event_title'] = $this->input->post('event_title');
						$post['event_category_id'] = $this->input->post('event_category_id');
						$post['event_parent_category_id'] = $this->input->post('event_parent_cat_id');
						$post['event_start_date'] = $this->input->post('event_start_date');
						$post['event_end_date'] = $this->input->post('event_end_date');
						$post['event_base_price'] = $this->input->post('event_price');
						$post['event_total_sheet'] = $this->input->post('event_seats');
						$post['event_day_slote_status'] = $this->input->post('event_day_slot');
						$post['event_discount_id'] = $this->input->post('event_discount_id');
						$post['event_status'] = $this->input->post('event_status');
						$post['event_description'] = $this->input->post('event_description');
			    		$post['event_created_date'] = date('Y-m-d');
						$post['event_updated_date'] = date('Y-m-d');
						$post['added_by'] = $this->data['user_id'];
						
						if ($_FILES["event_thumb_img"]["name"]) {
	                        $event_thumb_img    = 'event_thumb_img';
	                        $fieldName            = "event_thumb_img";
	                        $Path                 = 'webroot/admin/upload/event/';
	                        $event_thumb_img = $this->ImageUpload($_FILES["event_thumb_img"]["name"], $event_thumb_img, $Path, $fieldName);
	                        $post['event_image'] = base_url().''.$Path.''.$event_thumb_img;
	                      
	                    }
						$event_id =  $this->event_model->addEvent($post);
						if($event_id)
						{			

							$timing_counter= $this->input->post('timing_counter');
                            $event_time= $this->input->post('event_time');                        
	                        $j = 0;
							for($i = 0; $i < count($timing_counter); $i++)
	                        {
	                         	$a = $j + $timing_counter[$i];
	                         	//echo "aaa---".$a.'<br>';
	                         	for($j; $j < $a;)
	                         	{
	                         		$e_tm['event_id']= $event_id;
	                         		$e_tm['event_date']= $event_time[$j];
	                         		$e_tm['event_start_time']= $event_time[$j+1];
	                         		$e_tm['event_end_time']= $event_time[$j+2];
	                         		$res =  $this->event_model->addEventDateTime($e_tm);
	                         		$j= $j+3;
	                         	}
	                         	$j = $a;
	                        }

	                        $attribute = $this->input->post('attribute');
	                        if($attribute)
	                        {
		                        for($i = 0; $i < count($attribute);)
		                        {
		                        	$e_attr['event_id'] = $event_id;
		                         	$e_attr['attribute_name'] = $attribute[$i];
		                         	$e_attr['attribute_value']= $attribute[$i+1];
		                         	$this->event_model->addEventAttribute($e_attr);
		                         	$i = $i+2;
		                        }
		                    }
	                        
	                        $specification = $this->input->post('specification');                 
	                        if($specification)
	                        {
		                        for($i = 0; $i < count($specification);)
		                        {
		                        	$e_spc['event_id'] = $event_id;
		                         	$e_spc['specification_id'] = $specification[$i];
		                         	$e_spc['specification_val_id']= $specification[$i+1];
		                         	$this->event_model->addEventSpecification($e_spc);
		                         	$i = $i+2;
		                        }
		                    }

                           $event_images = $_FILES["event_images"]['name'];
	                        for($i = 0; $i < count($event_images); $i++)
				            {						  
		                        $imagedetails = getimagesize($_FILES["event_images"]['tmp_name'][$i]);
	       						$width = $imagedetails[0];
	                            $height = $imagedetails[1];
	                            if($width > 600 && $height > 400)
	                            {
                            	
	                            	$image_name = $_FILES["event_images"]["name"][$i];
		                            $Path = 'webroot/admin/upload/event/'.$image_name;
		                            move_uploaded_file($_FILES['event_images']['tmp_name'][$i],$Path);
		                            $event_imgs['event_img_name'] = base_url().''.$Path.''.$image_name;
		                            $event_imgs['event_id'] = $event_id;
		                            $event_imgs['event_img_created_date'] = date('Y-m-d');
		                            $event_imgs['added_by'] = $this->data['user_id'];
		                            $imgs_res = $this->event_model->addEventImags($event_imgs);

                               }

                           } 	

						 $msg = 'event added successfully!!';					
						 $this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						  redirect(base_url().'admin/event');
					   }
					   else
					   {
							$msg = 'Whoops, looks like something went wrong!';					
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/event/event_add');
						}
				}
				else
				{
					
					$this->data['category_list'] = $this->event_model->getCategoryList();    
					$this->data['discount_list'] = $this->event_model->getDiscountList(); 
					$this->show_view_admin('admin/event_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}

/* Get State List */
	public function getSubCategoryList()
	{
		$category_id = $this->input->post('category_id');
		$sub_category_list = $this->event_model->getSubCategoryList($category_id);
       
		$html = '';
		if(count($sub_category_list) > 0)
		{
			$html .=  '<option value="">Select Sub Category</option>'; 
			foreach ($sub_category_list as $sub_list) 
			{
				$html .= '<option value="'.$sub_list->category_id.'">'.$sub_list->category_name.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

/* Get State List */
	public function getAllSpecification()
	{
		$category_id = $this->input->post('category_id');
		$specification_list = $this->event_model->getAllSpecification($category_id);

       	$html = '';
		if(count($specification_list) > 0)
		{
			 
			foreach ($specification_list as $spc_list) 
			{
				$html .= '<div class="row"><div class="col-md-2"><div class="input text"><br><input type="checkbox" value="'.$spc_list->specification_id.'" name="specification[]" onclick="GetAllSpecificationVal('.$spc_list->specification_id.')" id="check_or_not'.$spc_list->specification_id.'" >'.'&nbsp'.$spc_list->specification_name.'</div></div><div id="allspcifictionVal'.$spc_list->specification_id.'"></div></div>';
			}
			$html .= "<br>";
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}


/* Get State List */
	public function getAllSpecificationVal()
	{
		$specification_id = $this->input->post('specification_id');
		$specification_val_list = $this->event_model->getAllSpecificationVal($specification_id);
       	$html = '';
		if(count($specification_val_list) > 0)
		{
			$html .=  '<div id="remove_sp_val'.$specification_id.'"><div class="col-md-2"><lable>&nbsp;</lable><select class="form-control" name="specification[]"><option value="" required >Select Specification Value</option>'; 
			foreach ($specification_val_list as $s_val_list) 
			{
				$html .= '<option value="'.$s_val_list->specification_val_id.'">'.$s_val_list->specification_val.'</option>';
			}
			$html .="</select></div>";
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}


	/* Delete */
	public function delete_event()
	{
		if($this->checkDeletePermission())
		{
			$event_id = $this->uri->segment(4);
			
			$this->event_model->delete_event($event_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/event'); 
			}
			else
			{
				$msg = 'event remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/event');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}	
}

/* End of file */?>