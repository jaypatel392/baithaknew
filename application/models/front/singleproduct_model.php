<?php

 class Singleproduct_model extends CI_Model {
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}


	public function getThreeProductImage($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_img');
		$this->db->where('product_id',$product_id);
		$this->db->where('product_img_status','1');
		$query = $this->db->get();	
		return $query->result();
	}

	public function getProductDetail($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getProductAttributes($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAttrvalue($attr_id)
	{		
		$this->db->select('*');
		$this->db->from('tbl_product_attr_val');
		$this->db->where('attr_id',$attr_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function getProductSpecifications($product_id)
	{
		$this->db->select('a.*,b.*,c.*');
		$this->db->from('tbl_product_specification a');
		$this->db->join('tbl_specification b', 'a.specification_id = b.specification_id');
		$this->db->join('tbl_specification_val c' ,'a.specification_val_id = c.specification_val_id');
		$this->db->where('a.product_id',$product_id);
		$query = $this->db->get();		
		return $query->result();
	}



	public function getReviews($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_review a');
		$this->db->join('tbl_user b', 'a.user_id = b.user_id');
		$this->db->where('a.review_type_id',$product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRelatedProducts($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');		
		$this->db->where('product_parent_cat_id != ',$category_id);
		$this->db->where('product_status','1');
		$query = $this->db->get();
		return $query->result();
	}


	public function getProductDiscountById($discount_id)
	{        
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_id', $discount_id);       
		$this->db->where('discount_status', '1');        
		$this->db->where('discount_end_date >', date('y-m-d'));
		$query = $this->db->get();
		return $query->result();
	}

}
?>