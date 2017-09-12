<?php

 class Vendor_model extends CI_Model {
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	public function getAllcategories($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_type', 'Product');
		$this->db->where('category_parent_id','0');
		$this->db->where('added_by',$user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getSubCategories($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_type', 'Product');
		$this->db->where('category_parent_id',$category_id);
		$query = $this->db->get();
		return $query->result();  
	}

	public function getAllVendorProducts($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('added_by', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllVendorAbout($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_vendor_details b','a.user_id = b.vendor_id','inner');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAllVendorGallery($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_vendor_gallery');		
		$this->db->where('vendor_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getProductReviews($product_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('tbl_review a');
		$this->db->join('tbl_user b','a.user_id = b.user_id','inner');		
		$this->db->where('review_type_id', $product_id);
		$query = $this->db->get();
		return $query->result();
	}

}

?>