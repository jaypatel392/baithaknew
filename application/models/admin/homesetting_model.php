<?php
class Homesetting_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}


	/*	Show all  */
	public function getAllBannerList()
	{
		$this->db->select('*');
		$this->db->from('tbl_home_banner');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function addHomeBanner($post)
	{
		$this->db->insert('tbl_home_banner', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Edit details */	
	public function editHomeBanner($home_banner_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_home_banner');
		$this->db->where('home_banner_id', $home_banner_id);
		$query = $this->db->get();
		return $query->result();
	}	

	/* Update */
	public function updateHomeBanner($post)
	{		
		$data['home_banner_url'] = $post['home_banner_url'];
		$data['home_banner_status'] = $post['home_banner_status'];
		$data['home_banner_update_date'] = $post['home_banner_update_date'];
		if(isset($post['home_banner_img_name']))
		{
			$data['home_banner_img_name'] = $post['home_banner_img_name'];
		}
		$this->db->where('home_banner_id', $post['home_banner_id']);
		$this->db->update('tbl_home_banner', $data);
		return true;
	}

	function deleteHomeBanner($home_banner_id)
	{
		$this->db->delete('tbl_home_banner', array('home_banner_id' => $home_banner_id));	
		return 1;		
	}

	public function getDiscountBannerList()
	{
		$this->db->select('*');
		$this->db->from('tbl_home_discount');
		$query = $this->db->get();
		return $query->result() ;
	}	

	public function addDiscountBanner($post)
	{
		$this->db->insert('tbl_home_discount', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	public function editDiscountBanner($dis_banner_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_home_discount');
		$this->db->where('discount_img_id', $dis_banner_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateDiscountBanner($post)
	{
		$data['discount_img_url'] = $post['discount_img_url'];
		$data['discount_img_status'] = $post['discount_img_status'];
		$data['discount_img_update_date'] = $post['discount_img_update_date'];
		if(isset($post['discount_img_name']))
		{
			$data['discount_img_name'] = $post['discount_img_name'];
		}
		$this->db->where('discount_img_id', $post['discount_img_id']);
		$this->db->update('tbl_home_discount', $data);
		return true;
	}

	public function getDealsBannerList()
	{
		$this->db->select('*');
		$this->db->from('tbl_home_deals');
		$query = $this->db->get();
		return $query->result() ;
	}	

	public function addDealsBanner($post)
	{
		$this->db->insert('tbl_home_deals', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	public function editDealsBanner($dis_banner_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_home_deals');
		$this->db->where('home_deals_id', $dis_banner_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateDealsBanner($post)
	{
		$data['home_deals_url'] = $post['home_deals_url'];
		$data['home_deals_status'] = $post['home_deals_status'];
		$data['home_deals_update_date'] = $post['home_deals_update_date'];
		if(isset($post['home_deals_img_name']))
		{
			$data['home_deals_img_name'] = $post['home_deals_img_name'];
		}
		$this->db->where('home_deals_id', $post['home_deals_id']);
		$this->db->update('tbl_home_deals', $data);
		return true;
	}

	/*	Show all  */
	public function getAllSpecialDealsList()
	{
		$this->db->select('*');
		$this->db->from('tbl_home_sp_deals');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function addSpecialDealsBanner($post)
	{
		$this->db->insert('tbl_home_sp_deals', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Edit details */	
	public function editSpecialDealsBanner($home_sp_deals_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_home_sp_deals');
		$this->db->where('home_sp_deals_id', $home_sp_deals_id);
		$query = $this->db->get();
		return $query->result();
	}	

	/* Update */
	public function updateSpecialDealsBanner($post)
	{		
		$data['home_sp_deals_url'] = $post['home_sp_deals_url'];
		$data['home_sp_deals_status'] = $post['home_sp_deals_status'];
		$data['home_sp_deals_update_date'] = $post['home_sp_deals_update_date'];
		if(isset($post['home_sp_deals_img_name']))
		{
			$data['home_sp_deals_img_name'] = $post['home_sp_deals_img_name'];
		}
		$this->db->where('home_sp_deals_id', $post['home_sp_deals_id']);
		$this->db->update('tbl_home_sp_deals', $data);
		return true;
	}

	function deleteSpecialDealsBanner($home_sp_deals_id)
	{
		$this->db->delete('tbl_home_sp_deals', array('home_sp_deals_id' => $home_sp_deals_id));	
		return 1;		
	}

	/*	Show all  */
	public function getAllTestimonialsList()
	{
		$this->db->select('*');
		$this->db->from('tbl_testimonial');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function addTestimonials($post)
	{
		$this->db->insert('tbl_testimonial', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Edit details */	
	public function editTestimonials($testimonial_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_testimonial');
		$this->db->where('testimonial_id', $testimonial_id);
		$query = $this->db->get();
		return $query->result();
	}	

	/* Update */
	public function updateTestimonials($post)
	{		
		$data['testimonial_name'] = $post['testimonial_name'];
		$data['testimonial_description'] = $post['testimonial_description'];
		$data['testimonial_status'] = $post['testimonial_status'];
		$data['testimonial_update_date'] = $post['testimonial_update_date'];
		if(isset($post['testimonial_img']))
		{
			$data['testimonial_img'] = $post['testimonial_img'];
		}
		$this->db->where('testimonial_id', $post['testimonial_id']);
		$this->db->update('tbl_testimonial', $data);
		return true;
	}

	function deleteTestimonials($testimonial_id)
	{
		$this->db->delete('tbl_testimonial', array('testimonial_id' => $testimonial_id));	
		return 1;		
	}

}

?>

