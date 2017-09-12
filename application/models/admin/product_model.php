<?php

class Product_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all product  */
	public function getAllProduct()
	{
		$this->db->select('a.* ,b.category_name');
		$this->db->from('tbl_product a');
		$this->db->join('tbl_category b','a.product_parent_cat_id = b.category_id','left');
		$this->db->where('a.product_id !=', '19');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getAllProductByVendore($user_id)
	{
		$this->db->select('a.* ,b.category_name');
		$this->db->from('tbl_product a');
		$this->db->join('tbl_category b','a.product_parent_cat_id = b.category_id','left');
		$this->db->where('a.added_by', $user_id);
		$this->db->where('a.product_id !=', '19');
		$this->db->order_by('a.product_status','ASC');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Role List  */
	public function getRoleList()
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Category List  */
	public function getCategoryList()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_parent_id', '0');
		$this->db->where('category_type', 'Product');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Shipping List  */
	public function getShippingList()
	{
		$this->db->select('*');
		$this->db->from('tbl_shipping');
		$this->db->where('shipping_status', '1');		
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Tax List  */
	public function getTaxList()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_status', '1');		
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Get all Tax List  */
	public function getDiscountList()
	{
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_status', '1');		
		$this->db->where('discount_end_date >=', date('Y-m-d'));	
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/*	Get all Mrp Discount List  */
	public function getMrpDiscountPriceList()
	{
		$this->db->select('*');
		$this->db->from('tbl_discountmrp');
		$this->db->where('discountmrp_status', '1');		
		$query = $this->db->get();
		return $query->row_array() ;
	}

	/*	Get all Tax List  */
	public function getBrandList()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_status', '1');		
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Tax List  */
	public function getMeasurementList()
	{
		$this->db->select('*');
		$this->db->from('tbl_measurement');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getStateList()
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('state_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Get all State List by country list */
	public function getSubCategoryList($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_parent_id', $category_id);
		$query = $this->db->get();
		return $query->result() ;
	}

/*	Show all Role  */
	public function getAllSpecification($category_id)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_category_specification a'); 
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','left');
		$this->db->where('category_id', $category_id);
		$query = $this->db->get();		
		return $query->result();

	}

	public function getAllSpecificationVal($specification_id)
	{
		$this->db->select('*');
		$this->db->from(' tbl_specification_val'); 
		$this->db->where('specification_id', $specification_id);
		$query = $this->db->get();		
		return $query->result();

	}

	/* Add New product */	
	public function addProduct($post)
	{
		$this->db->insert('tbl_product', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Add New product */	
	public function addProductAttr($post)
	{
		$this->db->insert('tbl_product_attr', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
  
  public function addProductAttrVal($post)
	{
		$this->db->insert('tbl_product_attr_val', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}


	public function addProductSpecification($post)
	{
		$this->db->insert('tbl_product_specification', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	public function addProductImags($post)
	{
		$this->db->insert('tbl_product_img', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit product details */	
	public function editProduct($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update product */
	public function updateProduct($post,$product_id)
	{
		$this->db->where('product_id', $product_id);
		$this->db->update('tbl_product', $post);
		return true;
	}

	public function updateStatus($post)
	{		
		
		$data['product_status'] = $post['product_status'];
		$this->db->where('product_id', $post['product_id']);
		$this->db->update('tbl_product', $data);
		return true;
	}
	
	/* Delete product detail */
	function delete_product($product_id)
	{
		$this->db->delete('tbl_product', array('product_id' => $product_id));		
		return 1;		
	}

	public function getVendorDetailsById($added_by){
    	
    	$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id',$added_by);		
		$query = $this->db->get();
		return $query->result();
  	}

  	public function checkUnicHsnNumber($hsn_code,$product_id = NULL)
  	{   	
    	$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('hsn_code',$hsn_code);	
		if($product_id != NULL)
		{
			$this->db->where('product_id !=',$product_id);	
		}
		$query = $this->db->get();
		return $query->num_rows();
  	}

  public function getProductMultipleImg($product_id){

  	    $this->db->select('*');
		$this->db->from('tbl_product_img');
		$this->db->where('product_id',$product_id);		
		$query = $this->db->get();
		return $query->result();
  }

  /* Edit Role details */	
	public function getAllMsmType($msm_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_measurement');
		$this->db->where('measurement_id', $msm_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getTaxValueById($tax_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_id', $tax_id);		
		$query = $this->db->get();
		return $query->row() ;
	}


}
?>
