<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/product_model');
	}
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$session = $this->session->all_userdata();		
			if($session[0]->user_role_id == 2)
			{
				$this->data['product_result'] = $this->product_model->getAllProductByVendore($session[0]->user_id);
			}
			else
			{
				$this->data['product_result'] = $this->product_model->getAllProduct();  
			}     
			$this->show_view_admin('admin/product', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    /* Add and Update */
	public function addProduct()
	{
		$product_id = $this->uri->segment(4);
		$session = $this->session->all_userdata();
		if($product_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{		
					$post['product_title'] = $this->input->post('product_title');
					$post['product_description'] = $this->input->post('product_description');		
					$post['product_shipping_id'] = $this->input->post('product_shipping_id');
					$post['product_discount_id'] = $this->input->post('product_discount_id');
					$post['product_tax_id'] = $this->input->post('product_tax_id');
					$post['product_purchase_price'] = $this->input->post('product_purchase_price');
					$post['product_sale_price'] = $this->input->post('product_sale_price');
					$post['price_for_doctor'] = $this->input->post('price_for_doctor');
					$post['price_for_chemist'] = $this->input->post('price_for_chemist');
					$post['price_for_hospitalist'] = $this->input->post('price_for_hospitalist');
					$post['price_for_pharma'] = $this->input->post('price_for_pharma');
					
					if(isset($_POST['include_exclude_tax']) && $_POST['include_exclude_tax'] == 'include')
					{
						$tax_value = $this->product_model->getTaxValueById($post['product_tax_id']);
						if(!empty($tax_value))
						{
							if($tax_value->tax_type == 'Percent')
							{
							    $product_mrp = ($post['product_sale_price']*100)/(100+$tax_value->tax_value);
								$post['product_sale_price'] = round($product_mrp,2);

								$product_dr_mrp = ($this->input->post('price_for_doctor')*100)/(100+$tax_value->tax_value);
								$post['price_for_doctor'] = round($product_dr_mrp,2);

								$product_chemist_mrp = ($this->input->post('price_for_chemist')*100)/(100+$tax_value->tax_value);
								$post['price_for_chemist'] = round($product_chemist_mrp,2);

								$product_hospitalist_mrp = ($this->input->post('price_for_hospitalist')*100)/(100+$tax_value->tax_value);
								$post['price_for_hospitalist'] = round($product_hospitalist_mrp,2);

								$product_pharma_mrp = ($this->input->post('price_for_pharma')*100)/(100+$tax_value->tax_value);
								$post['price_for_pharma'] = round($product_pharma_mrp,2);
							}
						}
					}					
					$post['include_exclude_tax'] = $this->input->post('include_exclude_tax');
					$post['product_brand_id'] = $this->input->post('product_brand_id');
					$post['product_currency_type'] = $this->input->post('product_currency_type');
					$post['product_qty'] = $this->input->post('product_qty');
					$post['product_moq'] = $this->input->post('product_moq');
					$post['product_thumb_img'] = $this->input->post('product_img');
					$post['hsn_code'] = $this->input->post('hsn_code');	
					$post['expiry_date'] = $this->input->post('expiry_date');	
					$post['product_formula'] = $this->input->post('product_formula');
					$post['measurement_id'] = $this->input->post('measurement_type');
					$post['measurement_value'] = json_encode($this->input->post('measurement_value'));
					$post['product_status'] = $this->input->post('product_status');
					$post['product_updated_date'] = date('Y-m-d');
					$update_product_res = $this->product_model->updateproduct($post,$product_id);
					if($update_product_res){
						$msg = 'product update successfully!';		
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/product');
					}					
					
				}
				else
				{
					$this->data['product_edit'] = $this->product_model->editproduct($product_id);
					$this->data['shipping_list'] = $this->product_model->getShippingList();
					$this->data['tax_list'] = $this->product_model->getTaxList();	
					$this->data['category_list'] = $this->product_model->getCategoryList();
					$this->data['measurement_list'] = $this->product_model->getMeasurementList();
					$this->data['discount_list'] = $this->product_model->getDiscountList();
					$this->data['brand_list'] = $this->product_model->getBrandList();  

					$this->show_view_admin('admin/product_update', $this->data);
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

                     $category_id = $this->input->post('category_id');
					  if(!empty($category_id))
					  {

							$all_levels = '';
							$cat_id = '';
							for ($i=0; $i < count($category_id); $i++) { 
								
								if($i == 0){

									$all_levels = $category_id[$i];

								}else{

									$all_levels = $all_levels.','.$category_id[$i];

								}
								$cat_id = $category_id[$i];

							}

							$post['product_parent_cat_id'] = $cat_id;
							$post['product_category_levels'] = $all_levels;
						}
					
						$post['product_uid'] = time();
						$post['product_title'] = $this->input->post('product_title');
						$post['product_description'] = $this->input->post('product_description');		
						$post['product_shipping_id'] = $this->input->post('product_shipping_id');
						$post['product_discount_id'] = $this->input->post('product_discount_id');
						$post['product_tax_id'] = $this->input->post('product_tax_id');
						$post['product_purchase_price'] = $this->input->post('product_purchase_price');
						$post['product_sale_price'] = $this->input->post('product_sale_price');
						$post['price_for_doctor'] = $this->input->post('price_for_doctor');
						$post['price_for_chemist'] = $this->input->post('price_for_chemist');
						$post['price_for_hospitalist'] = $this->input->post('price_for_hospitalist');
						$post['price_for_pharma'] = $this->input->post('price_for_pharma');
						
						if(isset($_POST['include_exclude_tax']) && $_POST['include_exclude_tax'] == 'include')
						{
							$tax_value = $this->product_model->getTaxValueById($post['product_tax_id']);
							if(!empty($tax_value))
							{
								if($tax_value->tax_type == 'Percent')
								{
								    $product_mrp = ($post['product_sale_price']*100)/(100+$tax_value->tax_value);
									$post['product_sale_price'] = round($product_mrp,2);

									$product_dr_mrp = ($this->input->post('price_for_doctor')*100)/(100+$tax_value->tax_value);
									$post['price_for_doctor'] = round($product_dr_mrp,2);

									$product_chemist_mrp = ($this->input->post('price_for_chemist')*100)/(100+$tax_value->tax_value);
									$post['price_for_chemist'] = round($product_chemist_mrp,2);

									$product_hospitalist_mrp = ($this->input->post('price_for_hospitalist')*100)/(100+$tax_value->tax_value);
									$post['price_for_hospitalist'] = round($product_hospitalist_mrp,2);

									$product_pharma_mrp = ($this->input->post('price_for_pharma')*100)/(100+$tax_value->tax_value);
									$post['price_for_pharma'] = round($product_pharma_mrp,2);
								}
							}
						}					
						$post['include_exclude_tax'] = $this->input->post('include_exclude_tax');
						$post['product_brand_id'] = $this->input->post('product_brand_id');
						$post['product_currency_type'] = $this->input->post('product_currency_type');
						$post['product_qty'] = $this->input->post('product_qty');
						$post['product_moq'] = $this->input->post('product_moq');
						$post['product_thumb_img'] = $this->input->post('product_img');
						$post['hsn_code'] = $this->input->post('hsn_code');	
						$post['expiry_date'] = $this->input->post('expiry_date');	
						$post['product_formula'] = $this->input->post('product_formula');
						$post['measurement_id'] = $this->input->post('measurement_type');
						$post['measurement_value'] = json_encode($this->input->post('measurement_value'));
						$post['product_created_date'] = date('Y-m-d');
						$post['product_updated_date'] = date('Y-m-d');					
						$post['added_by'] = $this->data['user_id'];			
						$product_id =  $this->product_model->addProduct($post);
						if($product_id)
						{
						   if(!empty($this->input->post('attr_counter')))
                           {	
								$attr_counter= $this->input->post('attr_counter');
								$attribute_name = $this->input->post('attribute_name');
								$attr_value = $this->input->post('attr_value');
								$attr_img_val = $this->input->post('attr_img_val');
								$j = 0;
								$a = 0;
								$product_id = $product_id;
					            for($i = 0; $i < count($attribute_name); $i++)
			                    {		                         	
		                         	$attr['attr_name'] = $attribute_name[$i];
		                         	$attr['product_id'] = $product_id;
		                         	$attr['added_by'] = $this->data['user_id'];
		                         	$attr_id =  $this->product_model->addProductAttr($attr);		                         	
		                         	for($j = $a; $j < ($attr_counter[$i]*2+$a);)
		                         	{

		                         		$attr_val['attr_id']= $attr_id;
		                         		$attr_val['attr_value']= $attr_value[$j];
		                         		$attr_val['attr_price']= $attr_value[$j+1];
		                         	     $attr_img_num = $attr_img_val[$j];
		                         	    if($_FILES['attr_img_'.$attr_img_num]['size'] > 0)
		                         	    {
					                        $attr_img_name = 'attr_img';
				                            $fieldName = "attr_img_".$attr_img_num;
				                            $Path  = 'webroot/admin/upload/attr_img/';
				                            $attr_img = $this->ImageUpload($_FILES['attr_img_'.$attr_img_num]['name'], $attr_img_name, $Path, $fieldName);
				                            $attr_val['attr_img'] = $Path.''.$attr_img;

		                         	    }		                         	    
		                         		$res =  $this->product_model->addProductAttrVal($attr_val);
		                         		$j= $j+2;
		                         	}
	                           		$a = $j;
	                        	}	                        
	                        }
	                        $msg = 'product added successfully!!';
							$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
							redirect(base_url().'admin/product');
					}
					else
					{
						$msg = 'Whoops, looks like something went wrong!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/product/addProduct');
					}
					
			}
			else
			{
	            $this->data['shipping_list'] = $this->product_model->getShippingList();
				$this->data['tax_list'] = $this->product_model->getTaxList();	
				$this->data['category_list'] = $this->product_model->getCategoryList();    
				$this->data['measurement_list'] = $this->product_model->getMeasurementList();
				$this->data['discount_list'] = $this->product_model->getDiscountList();
				$this->data['brand_list'] = $this->product_model->getBrandList();    
				$this->show_view_admin('admin/product_add', $this->data);
			}

		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
			
		}//check permission if end

	}//main if end

}//main function end

/* Get State List */

    public function checkUnicHsnNumber()
    {
    	$hsn_code = $this->input->post('hsn_code');
    	if(isset($_POST['product_id']))
    	{
    		$product_id = $this->input->post('product_id');
    		echo $check_hsn = $this->product_model->checkUnicHsnNumber($hsn_code,$product_id);
    	}
    	else
    	{
    		echo $check_hsn = $this->product_model->checkUnicHsnNumber($hsn_code);
    	}
    }
	public function getSubCategoryList()
	{
		$category_id = $this->input->post('category_id');
		$sub_category_list = $this->product_model->getSubCategoryList($category_id);
       
		$html = '';
		if(count($sub_category_list) > 0)
		{
			$html .=  '<option value=""></option>'; 
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

	public function getMrpDiscountPriceList()
	{
		$mrpdiscount_list = $this->product_model->getMrpDiscountPriceList();
		
		if(!empty($mrpdiscount_list))
		{
			$mrp_array = array();
			$mrp = $this->input->post('mrp');
			$mrp_array['dr_price'] = $mrp-($mrp * $mrpdiscount_list['discountmrp_for_dr'])/100;
			$mrp_array['chemist_price'] = $mrp-($mrp * $mrpdiscount_list['discountmrp_for_chemist'])/100;
			$mrp_array['pharma_price'] = $mrp-($mrp * $mrpdiscount_list['discountmrp_for_pharma_wholseller'])/100;
			$mrp_array['hospitalist_price'] = $mrp-($mrp * $mrpdiscount_list['discountmrp_for_hospitalist'])/100;
			
			$m_array = array_merge($mrp_array,$mrpdiscount_list);
			echo json_encode($m_array); 
		}
	}
/* Get State List */
	public function getAllSpecification()
	{
		$category_id = $this->input->post('category_id');
		$specification_list = $this->product_model->getAllSpecification($category_id);
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
		$specification_val_list = $this->product_model->getAllSpecificationVal($specification_id);
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
	public function delete_product()
	{
		if($this->checkDeletePermission())
		{
			$product_id = $this->uri->segment(4);
			
			$this->product_model->delete_product($product_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/product'); 
			}
			else
			{
				$msg = 'product remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/product');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

  public function searchVendore(){   
        $search_key = $this->input->post('vendor_name');
  		$search_vendore = $this->product_model->searchVendore($search_key);
  		//print_r($search_vendore);die;
  		$html = '';
  		if(!empty($search_vendore)){?>

		  	<ul id="country-list">
			<?php foreach($search_vendore as $search_res) {?>
					
				<li onclick="select_search_vendor('<?php echo $search_res->user_name;?>','<?php echo $search_res->user_id;?>')"><?php echo $search_res->user_name;?></li>
				<?php } ?>
				</ul>
				<?php
	    }else{

	    	echo $html;

	    }
  }

  public function getAllMsmType()
  {   
        $measurement_id = $this->input->post('measurement_id');
  		$msm_value_result = $this->product_model->getAllMsmType($measurement_id);
  		//print_r($search_vendore);die;
  		$html = '';
  		if(!empty($msm_value_result))
  		{
  			$msm_val_arr = json_decode($msm_value_result[0]->measurement_level_value);  			
  			for ($i=0; $i < count($msm_val_arr); $i++) 
  			{ 

  				$html .=  '<div class="form-group col-md-3"><div class="input text"><input placeholder="'.$msm_val_arr[$i].'" required="required" class="form-control" name="measurement_value[]" type="number"></div></div>';
  			}
  			echo $html;
	    }else{

	    	echo $html;

	    }
  }



}

/* End of file */?>