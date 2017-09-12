<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class homeSetting extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/homesetting_model');
	}

	public function homeBanner()
	{

		$this->data['banner_list'] = $this->homesetting_model->getAllBannerList();
		$this->show_view_admin('admin/home_banner', $this->data);	
	}

	public function addHomeBanner($home_banner_id = '')
	{
		if($home_banner_id != '')
		{
			if(isset($_POST['edit']))
			{
				$post['home_banner_url'] = $this->input->post('home_banner_url');
				$post['home_banner_status'] = $this->input->post('home_banner_status');				
				$post['home_banner_update_date'] = date('Y-m-d');
				$post['home_banner_id'] = $home_banner_id;

				//Banner Image Uplaod
				if ($_FILES["home_banner_img_name"]["name"]) 
				{
	                   $home_banner_img_name         = 'home_banner_img_name';
	                   $fieldName            = "home_banner_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $home_banner_img_name         = $this->ImageUpload($_FILES["home_banner_img_name"]["name"], $home_banner_img_name, $Path, $fieldName);
	                   $post['home_banner_img_name'] = $Path.$home_banner_img_name;
                }

				$update_res = $this->homesetting_model->updateHomeBanner($post);
				if($update_res)
				{
					$msg = 'Banner Updated successfully!!';			
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/homeBanner');
				}
			}
			$this->data['edit_banner'] = $this->homesetting_model->editHomeBanner($home_banner_id);
			$this->show_view_admin('admin/update_home_banner',$this->data);
		}
		else
		{
			if(isset($_POST['add']))
			{
				$post['home_banner_url'] = $this->input->post('home_banner_url');
				$post['home_banner_status'] = $this->input->post('home_banner_status');
				$post['home_banner_created_data'] = date('Y-m-d');
				$post['home_banner_update_date'] = date('Y-m-d');

				//Banner Image Uplaod
				if ($_FILES["home_banner_img_name"]["name"]) 
				{
                   $home_banner_img_name = 'home_banner_img_name';
                   $fieldName = "home_banner_img_name";
                   $Path = 'webroot/admin/upload/home_page/';
                   $home_banner_img_name = $this->ImageUpload($_FILES["home_banner_img_name"]["name"], $home_banner_img_name, $Path, $fieldName);
                   $post['home_banner_img_name'] = $Path.$home_banner_img_name;
                }

				$add_res = $this->homesetting_model->addHomeBanner($post);
				if($add_res)
				{
					$msg = 'Banner added successfully!!';					
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/homeBanner');
				}

			}
			$this->show_view_admin('admin/add_home_banner',$this->data);
		}

	}

	public function deleteHomeBanner($home_banner_id = '')
	{
		if($home_banner_id)
		{
			$del_res = $this->homesetting_model->deleteHomeBanner($home_banner_id);
			if($del_res)
			{
				$msg = 'Home Banner remove successfully...!';	
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/homeSetting/homeBanner');
			}
		}
	}

	public function discountBanner()
	{
		$this->data['dis_banner'] = $this->homesetting_model->getDiscountBannerList();
		$this->show_view_admin('admin/discount_banner', $this->data);	
	}

	public function addDiscountBanner($dis_banner_id = '')
	{
		if($dis_banner_id != '')
		{
			if(isset($_POST['edit']))
			{
				$post['discount_img_url'] = $this->input->post('discount_img_url');
				$post['discount_img_status'] = $this->input->post('discount_img_status');
				$post['discount_img_update_date'] = date('Y-m-d');
				$post['discount_img_id'] = $dis_banner_id;

				//Banner Image Uplaod
				if ($_FILES["discount_img_name"]["name"]) 
				{
	                   $home_banner_img_name         = 'discount_img_name';
	                   $fieldName            = "discount_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $discount_img_name         = $this->ImageUpload($_FILES["discount_img_name"]["name"], $home_banner_img_name, $Path, $fieldName);
	                   $post['discount_img_name'] = $Path.$discount_img_name;
                }

				$update_res = $this->homesetting_model->updateDiscountBanner($post);
				if($update_res)
				{
					$msg = 'Discount Banner Updated successfully!!';			
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/discountBanner');
				}
			}
			$this->data['edit_dis_banner'] = $this->homesetting_model->editDiscountBanner($dis_banner_id);
			$this->show_view_admin('admin/update_discount_banner',$this->data);
		}
		else
		{
			if(isset($_POST['add']))
			{
				$post['discount_img_url'] = $this->input->post('discount_img_url');
				$post['discount_img_status'] = $this->input->post('discount_img_status');
				$post['discount_img_created_date'] = date('Y-m-d');
				$post['discount_img_update_date'] = date('Y-m-d');

				//Banner Image Uplaod
				if ($_FILES["discount_img_name"]["name"]) 
				{
	                   $discount_img_name         = 'discount_img_name';
	                   $fieldName            = "discount_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $discount_img_name         = $this->ImageUpload($_FILES["discount_img_name"]["name"], $discount_img_name, $Path, $fieldName);
	                   $post['discount_img_name'] = $Path.$discount_img_name;
                }

				$add_res = $this->homesetting_model->addDiscountBanner($post);
				if($add_res)
				{
					$msg = 'Banner added successfully!!';					
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/discountBanner');
				}

			}
			$this->show_view_admin('admin/add_discount_banner',$this->data);
		}

	}

	public function dealsBanner()
	{
		$this->data['deals_banner'] = $this->homesetting_model->getDealsBannerList();
		$this->show_view_admin('admin/deals_banner', $this->data);	
	}

	public function addDealsBanner($deals_banner_id = '')
	{
		if($deals_banner_id != '')
		{
			if(isset($_POST['edit']))
			{
				$post['home_deals_url'] = $this->input->post('home_deals_url');
				$post['home_deals_status'] = $this->input->post('home_deals_status');
				$post['home_deals_update_date'] = date('Y-m-d');
				$post['home_deals_id'] = $deals_banner_id;

				//Banner Image Uplaod
				if ($_FILES["home_deals_img_name"]["name"]) 
				{
	                   $home_deals_img_name         = 'home_deals_img_name';
	                   $fieldName            = "home_deals_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $home_deals_img_name         = $this->ImageUpload($_FILES["home_deals_img_name"]["name"], $home_deals_img_name, $Path, $fieldName);
	                   $post['home_deals_img_name'] = $Path.''.$home_deals_img_name;
                }
               
				$update_res = $this->homesetting_model->updateDealsBanner($post);
				if($update_res)
				{
					$msg = 'Deals Banner Updated successfully!!';			
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/dealsBanner');
				}
			}
			$this->data['edit_deals_banner'] = $this->homesetting_model->editDealsBanner($deals_banner_id);
			$this->show_view_admin('admin/update_deals_banner',$this->data);
		}
		else
		{
			if(isset($_POST['add']))
			{
				
				$post['home_deals_url'] = $this->input->post('home_deals_url');
				$post['home_deals_status'] = $this->input->post('home_deals_status');
				$post['home_deals_created_date'] = date('Y-m-d');
				$post['home_deals_update_date'] = date('Y-m-d');

				//Banner Image Uplaod
				if ($_FILES["home_deals_img_name"]["name"]) 
				{
	                   $home_deals_img_name         = 'home_deals_img_name';
	                   $fieldName            = "home_deals_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $home_deals_img_name         = $this->ImageUpload($_FILES["home_deals_img_name"]["name"], $home_deals_img_name, $Path, $fieldName);
	                   $post['home_deals_img_name'] = $Path.''.$home_deals_img_name;
                }


				$add_res = $this->homesetting_model->addDealsBanner($post);
				if($add_res)
				{
					$msg = 'Deals Banner added successfully!!';					
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/dealsBanner');
				}

			}
			$this->show_view_admin('admin/add_deals_banner',$this->data);
		}

	}

	public function specialDealsBanner()
	{

		$this->data['special_deals_list'] = $this->homesetting_model->getAllSpecialDealsList();
		$this->show_view_admin('admin/special_deals_banner', $this->data);	
	}

	public function addSpecialDealsBanner($sd_banner_id = '')
	{
		if($sd_banner_id != '')
		{
			if(isset($_POST['edit']))
			{
				$post['home_sp_deals_url'] = $this->input->post('home_sp_deals_url');
				$post['home_sp_deals_status'] = $this->input->post('home_sp_deals_status');				
				$post['home_sp_deals_update_date'] = date('Y-m-d');
				$post['home_sp_deals_id'] = $sd_banner_id;

				//Banner Image Uplaod
				if ($_FILES["home_sp_deals_img_name"]["name"]) 
				{
	                   $home_sp_deals_img_name         = 'home_sp_deals_img_name';
	                   $fieldName            = "home_sp_deals_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $home_sp_deals_img_name         = $this->ImageUpload($_FILES["home_sp_deals_img_name"]["name"], $home_sp_deals_img_name, $Path, $fieldName);
	                   $post['home_sp_deals_img_name'] = $Path.$home_sp_deals_img_name;
                }
                
				$update_res = $this->homesetting_model->updateSpecialDealsBanner($post);
				if($update_res)
				{
					$msg = 'Banner Updated successfully!!';			
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/specialDealsBanner');
				}
			}
			$this->data['edit_banner'] = $this->homesetting_model->editSpecialDealsBanner($sd_banner_id);
			$this->show_view_admin('admin/update_specialdeals_banner',$this->data);
		}
		else
		{
			if(isset($_POST['add']))
			{
				$post['home_sp_deals_url'] = $this->input->post('home_sp_deals_url');
				$post['home_sp_deals_status'] = $this->input->post('home_sp_deals_status');
				$post['home_sp_deals_created_date'] = date('Y-m-d');
				$post['home_sp_deals_update_date'] = date('Y-m-d');

				//Banner Image Uplaod
				if ($_FILES["home_sp_deals_img_name"]["name"]) 
				{
	                   $home_sp_deals_img_name         = 'home_sp_deals_img_name';
	                   $fieldName            = "home_sp_deals_img_name";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $home_sp_deals_img_name         = $this->ImageUpload($_FILES["home_sp_deals_img_name"]["name"], $home_sp_deals_img_name, $Path, $fieldName);
	                   $post['home_sp_deals_img_name'] = $Path.$home_sp_deals_img_name;
                }

				$add_res = $this->homesetting_model->addSpecialDealsBanner($post);
				if($add_res)
				{
					$msg = 'Special Deals Banner added successfully!!';					
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/specialDealsBanner');
				}

			}
			$this->show_view_admin('admin/add_specialdeals_banner',$this->data);
		}

	}

	public function deleteSpecialDealsBanner($home_banner_id = '')
	{
		if($home_banner_id)
		{
			$del_res = $this->homesetting_model->deleteSpecialDealsBanner($home_banner_id);
			if($del_res)
			{
				$msg = 'Special Deals Banner remove successfully...!';	
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/homeSetting/specialDealsBanner');
			}
		}
	}

	public function testimonials()
	{

		$this->data['testimonials_list'] = $this->homesetting_model->getAllTestimonialsList();
		$this->show_view_admin('admin/testimonials', $this->data);	
	}

	public function addTestimonials($testimonial_id = '')
	{
		if($testimonial_id != '')
		{
			if(isset($_POST['edit']))
			{
				$post['testimonial_name'] = $this->input->post('testimonial_name');
				$post['testimonial_description'] = $this->input->post('testimonial_description');
				$post['testimonial_status'] = $this->input->post('testimonial_status');				
				$post['testimonial_update_date	'] = date('Y-m-d');
				$post['testimonial_id'] = $testimonial_id;

				//Banner Image Uplaod
				if ($_FILES["testimonial_img"]["name"]) 
				{
	                   $testimonial_img         = 'testimonial_img';
	                   $fieldName            = "testimonial_img";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $testimonial_img         = $this->ImageUpload($_FILES["testimonial_img"]["name"], $testimonial_img, $Path, $fieldName);
	                   $post['testimonial_img'] = $Path.$testimonial_img;
                }

				$update_res = $this->homesetting_model->updateTestimonials($post);
				if($update_res)
				{
					$msg = 'Banner Updated successfully!!';			
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/testimonials');
				}
			}
			$this->data['edit_testimonials'] = $this->homesetting_model->editTestimonials($testimonial_id);
			$this->show_view_admin('admin/update_testimonials',$this->data);
		}
		else
		{
			if(isset($_POST['add']))
			{
				$post['testimonial_name'] = $this->input->post('testimonial_name');
				$post['testimonial_description'] = $this->input->post('testimonial_description');
				$post['testimonial_status'] = $this->input->post('testimonial_status');
				$post['testimonial_created_date'] = date('Y-m-d');
				$post['testimonial_update_date'] = date('Y-m-d');

				//Banner Image Uplaod
				if ($_FILES["testimonial_img"]["name"]) 
				{
	                   $testimonial_img         = 'testimonial_img';
	                   $fieldName            = "testimonial_img";
	                   $Path                 = 'webroot/admin/upload/home_page/';
	                   $testimonial_img         = $this->ImageUpload($_FILES["testimonial_img"]["name"], $testimonial_img, $Path, $fieldName);
	                   $post['testimonial_img'] = $Path.$testimonial_img;
                }

				$add_res = $this->homesetting_model->addTestimonials($post);
				if($add_res)
				{
					$msg = 'Special Deals Banner added successfully!!';					
					$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
					redirect(base_url().'admin/homeSetting/testimonials');
				}

			}
			$this->show_view_admin('admin/add_testimonials',$this->data);
		}

	}

	public function deleteTestimonials($testimonial_id = '')
	{
		if($testimonial_id)
		{
			$del_res = $this->homesetting_model->deleteTestimonials($testimonial_id);
			if($del_res)
			{
				$msg = 'Special Deals Banner remove successfully...!';	
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/homeSetting/testimonials');
			}
		}
	}


}
?>