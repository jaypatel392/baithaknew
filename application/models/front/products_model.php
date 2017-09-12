<?php

 class products_model extends CI_Model {
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	public function getAllcategories()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_type', 'Product');
		$this->db->where('category_parent_id','0');
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

	public function getProducts()
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->join('tbl_category', 'tbl_category.category_parent_id = tbl_product.product_parent_cat_id' ); 
		$query = $this->db->get();
		return $query->result();
	}

	public function getProductDiscount($discount_id)
	{
		$today = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('tbl_discount a');
		$this->db->where('discount_end_date >',$today);
		$this->db->where('discount_status','1');
		$this->db->where('discount_id',$discount_id);
		$query = $this->db->get();
	    return $query->result();
	}	



	public function getProductByCity($city_name)
	{        
        $this->db->select('a.*');
        $this->db->from('tbl_product a');
        $this->db->join('tbl_user b', 'a.added_by = b.user_id');
        $this->db->where('a.product_status', '1');
        $this->db->like('b.user_city',$city_name);
        $this->db->order_by('a.product_updated_date', 'DESC');
        $query = $this->db->get();        
        return $query->result();
    }

    public function getNewProduct()
	{        
        $this->db->select('a.*,b.*');
        $this->db->from('tbl_product a');
        $this->db->join('tbl_discount b', 'a.product_discount_id = b.discount_id');       
        $this->db->where('a.product_status', '1');
        $query = $this->db->get();
        return $query->result();
    }



	public function getBrands()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_status', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function getProductByCategoryId($e_limit,$s_limit,$category_id)
	{		
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_parent_cat_id',$category_id);
		$this->db->where('product_status','1');
		$this->db->limit($e_limit, $s_limit);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRecord_countProduct($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_parent_cat_id',$category_id);
		$this->db->where('product_status','1');
		$query = $this->db->get();	
		return $query->num_rows();
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


	///****************** Cart Product Start **************************

	public function getCartProductById($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');			
		$this->db->where('product_id',$product_id);  			
		$query = $this->db->get();	
		return $query->result();
	}

	public function getProductByCategoryIdAndPrice($e_limit,$s_limit,$category_id,$minPrice,$maxPrice)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_parent_cat_id',$category_id);
		$this->db->where('product_status','1');

		if($minPrice == '0'){
			$this->db->where('product_sale_price <=', $maxPrice);
		}
		elseif ($maxPrice == '0') {
			$this->db->where('product_sale_price >=',$minPrice);
		}
		else{
			$this->db->where('product_sale_price >=',$minPrice);
			$this->db->where('product_sale_price <=',$maxPrice);
		}
		$this->db->where('product_sale_price !=' ,'0');
		$query = $this->db->get();
		return $query->result();
	}



	public function getSortedProduct($cat_id,$sortBy)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_parent_cat_id',$cat_id);
		$this->db->where('product_status','1');
		if($sortBy == 'newproduct')
		{
			$this->db->order_by('product_updated_date', 'DESC');
		}
		if($sortBy == 'price_lowtohigh')
		{
			$this->db->order_by('product_sale_price','asc');
		}

		if($sortBy == 'price_hightolow')
		{
			$this->db->order_by('product_sale_price','DESC');
		}

		$query = $this->db->get();	
		return $query->result();

	}

	public function addCartproducts($post)
	{
		$this->db->insert('tbl_cart', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addCartproductsAttr($post){
		$this->db->insert('tbl_cart_attr', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function getProductByKeyword($keyword)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->like('product_description',$keyword);
		$this->db->where('product_status','1');
		$query = $this->db->get();	
		return $query->result();

	}


	public function getAllbrands()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_status','1');
		$query = $this->db->get();	
		return $query->result();
	}


	public function getProductBybrandId($brandId)
	{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_brand_id',$brandId);
		$this->db->where('product_status','1');
		$query = $this->db->get();	
		return $query->result();
	}


	public function getProductByBrandIdAndPrice($brandId,$minPrice,$maxPrice)
	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_brand_id',$brandId);
		$this->db->where('product_status','1');
		if($minPrice == '0'){
			$this->db->where('product_sale_price <=', $maxPrice);
		}
		elseif ($maxPrice == '0') {
			$this->db->where('product_sale_price >=',$minPrice);
		}
		else
		{
			$this->db->where('product_sale_price >=',$minPrice);
			$this->db->where('product_sale_price <=',$maxPrice);
		}
		$query = $this->db->get();	
		return $query->result();

	}


	public function getsortedProductsbyBrand($brandId,$sortBy)
	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_brand_id',$brandId);
		$this->db->where('product_status','1');
		if($sortBy == 'newproduct')
		{
			$this->db->order_by('product_updated_date', 'DESC');
		}
		if($sortBy == 'price_lowtohigh')
		{
			$this->db->order_by('product_sale_price','asc');
		}

		if($sortBy == 'price_hightolow')
		{
			$this->db->order_by('product_sale_price','DESC');
		}

		$query = $this->db->get();	
		return $query->result();
	}




	public function getProductByKeywordAndPrice($keyword,$minPrice,$maxPrice)
	{

		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->like('product_description',$keyword);
		$this->db->where('product_status','1');
		if($minPrice == '0'){
			$this->db->where('product_sale_price <=', $maxPrice);
		}
		elseif ($maxPrice == '0') {
			$this->db->where('product_sale_price >=',$minPrice);
		}
		else
		{
			$this->db->where('product_sale_price >=',$minPrice);
			$this->db->where('product_sale_price <=',$maxPrice);
		}
		$query = $this->db->get();	
		return $query->result();
	}


	public function getsortedProductsbyKeyword($keyword,$sortBy)
		{
		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->like('product_description',$keyword);
		$this->db->where('product_status','1');
		if($sortBy == 'newproduct')
		{
			$this->db->order_by('product_updated_date', 'DESC');
		}
		if($sortBy == 'price_lowtohigh')
		{
			$this->db->order_by('product_sale_price','asc');
		}

		if($sortBy == 'price_hightolow')
		{
			$this->db->order_by('product_sale_price','DESC');
		}

		$query = $this->db->get();	
		return $query->result();
	}

	public function getUserDetailsById($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id',$user_id);
		$this->db->where('user_status','1');
		$query = $this->db->get();	
		return $query->result();
	}


	/*	Get all Country List  */
	public function getCountryList()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_status', '1');
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
	public function getStateListByCountryId($country_id)
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getProductAttributes($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAttrvalueMinPrice($attr_id)
	{		
		$this->db->select('min(attr_price) as attr_min_price');
		$this->db->from('tbl_product_attr_val');
		$this->db->where('attr_id',$attr_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAttrvalueMaxPrice($attr_id)
	{		
		$this->db->select('max(attr_price) as attr_max_price');
		$this->db->from('tbl_product_attr_val');		   
		$this->db->where('attr_id',$attr_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getUserDefultDeleveryAddres($user_id)
	{
		$this->db->select('a.*,c.state_name,b.country_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b', 'a.user_address_country_id = b.country_id');
		$this->db->join('state c', 'a.user_address_state_id = c.state_id');
		$this->db->where('a.user_address_type','D');
		$this->db->where('a.user_address_default','1');
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();		
		return $query->result();
	}

	public function getUserDefultBillingAddres($user_id)
	{
		$this->db->select('a.*,c.state_name,b.country_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b', 'a.user_address_country_id = b.country_id');
		$this->db->join('state c', 'a.user_address_state_id = c.state_id');
		$this->db->where('a.user_address_type','B');
		$this->db->where('a.user_address_default','1');
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function getALLDeleveryAddres($user_id)
	{
		$this->db->select('a.*,c.state_name,b.country_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b', 'a.user_address_country_id = b.country_id');
		$this->db->join('state c', 'a.user_address_state_id = c.state_id');
		$this->db->where('a.user_address_type','D');		
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function getAllBillingAdresses($user_id)
	{
		$this->db->select('a.*,c.state_name,b.country_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b', 'a.user_address_country_id = b.country_id');
		$this->db->join('state c', 'a.user_address_state_id = c.state_id');
		$this->db->where('a.user_address_type','B');		
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function removeDefultsdelAdress($user_id)
	{
		$this->db->where('user_address_default','1');
		$this->db->where('user_id',$user_id);
		$this->db->where('user_address_type','D');
		$this->db->update('tbl_user_address',  array('user_address_default' => '0'));
		return true;
	}
	public function removeDefultsbillAdress($user_id)
	{
		$this->db->where('user_address_default','1');
		$this->db->where('user_id',$user_id);
		$this->db->where('user_address_type','B');
		$this->db->update('tbl_user_address',  array('user_address_default' => '0'));
		return true;
	}

	public function setDefaultDeladdress($address_id)
	{
		$this->db->where('user_address_id',$address_id);
		$this->db->update('tbl_user_address',  array('user_address_default' => '1' ));
		return true;
	}
	
	public function setDefaultSameBillingaddress($address_id)
	{
		$this->db->where('same_as_delivery_address',$address_id);
		$this->db->update('tbl_user_address',  array('user_address_default' => '1' ));
		return true;
	}

	public function addNewAddress($post)
	{
		$this->db->insert('tbl_user_address', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	public function getStateName($state_id)
	{
		$this->db->select('state_name');
		$this->db->from('state');
		$this->db->where('state_id',$state_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function removeSameBillingAddress($bill_addrss_id)
	{
		$this->db->delete('tbl_user_address', array('user_address_id' => $bill_addrss_id));		
		return 1;	
	}

	public function checkSameBillingAddress($user_id,$del_addrs_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user_address');
		$this->db->where('user_id',$user_id);
		$this->db->where('same_as_delivery_address',$del_addrs_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/************************ Start Order *********************************/
	/* add order */	
	public function addOrder($post)
	{
		$this->db->insert('tbl_order', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}	

	public function updateOrderUnicId($unic)
	{
		$data['unic_order_id'] = $unic['unic_order_id'];
		$this->db->where('order_id',$unic['order_id']);
		$this->db->update('tbl_order', $data);
		return true;

	}
	/* add order Product*/	
	public function addOrderProduct($post)
	{
		$this->db->insert('tbl_order_product', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}	

	public function addOrderStatus($post)
	{
		$this->db->insert('tbl_order_status', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}	

	public function getAllUserOrdersById($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where('order_user_id',$user_id);		
		$this->db->where('order_status','1');		
		$this->db->order_by('order_id','DESC');		
		$query = $this->db->get();
		return $query->result();
	}

	public function getOrderProductById($order_id)
	{
		$this->db->select('a.*,b.*,c.user_name');
		$this->db->from('tbl_order_product a');
		$this->db->join('tbl_product b', 'a.product_id = b.product_id', 'inner');		
		$this->db->join('tbl_user c', 'b.added_by = c.user_id' , 'inner');		
		$this->db->where('a.order_id',$order_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getdelAddressById($address_id)
	{
		$this->db->select('a.*,c.state_name,b.country_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b', 'a.user_address_country_id = b.country_id');
		$this->db->join('state c', 'a.user_address_state_id = c.state_id');		
		$this->db->where('a.user_address_id',$address_id);		
		$query = $this->db->get();		
		return $query->result();
	}

	public function getProductAttrDetails($attr_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr');
		$this->db->where('attr_id', $attr_id);
		$query = $this->db->get();	
		return $query->result();
	}

	public function getProductAttrValueDetails($attr_val_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr_val');
		$this->db->where('attr_val_id', $attr_val_id);
		$query = $this->db->get();	
		return $query->result();
	}



 }
?>