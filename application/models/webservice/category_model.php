<?php

class Category_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	get all Parent Category  */
	public function getParentCategory()
	{
		$this->db->select('*');
		$this->db->from('tbl_category'); 
		$this->db->where('category_parent_id', '0');
		$this->db->where('category_status', '1');
		$this->db->order_by('category_name', 'ASC');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/* Get all sub category By Parent Id */
	public function getSubCategories($parant_cat_id)
	{
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_parent_id',$parant_cat_id);
        $this->db->order_by('category_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
	}

	/* Get all sub category By Parent Id */
	public function searchProductBykey($search_key,$offset)
	{
        $this->db->select('a.product_id,a.product_title,a.product_formula');
        $this->db->from('tbl_product a');
        $this->db->where('a.product_id != ' , '19');
        $this->db->like('a.product_formula',$search_key,'after');
		$this->db->or_like('a.product_title',$search_key,'after');		
        $query = $this->db->get();        
        return $query->result();
	}

	public function getAttrvalueMinPrice($attr_id)
	{		
		$this->db->select('min(attr_price) as attr_min_price');
		$this->db->from('tbl_product_attr_val');
		$this->db->where('attr_id',$attr_id);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
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
    	
	/*	get all Product list by Parent Category ID  */
	public function productByParentCategoryId($category_id,$offset)
	{
		$this->db->select('a.*,b.*,c.*,d.*,e.*,f.*');
		$this->db->from('tbl_product a'); 
		$this->db->join('tbl_measurement b','a.measurement_id = b.measurement_id','inner');
		$this->db->join('tbl_discount c','a.product_discount_id = c.discount_id','left');
		$this->db->join('tbl_tax d','a.product_tax_id = d.tax_id','left');
		$this->db->join('tbl_shipping e','a.product_shipping_id = e.shipping_id','left');
		$this->db->join('tbl_brand f','a.product_brand_id = f.brand_id','left');
		$this->db->where('a.product_parent_cat_id', $category_id);
		$this->db->where('a.product_status', '1');
		$this->db->limit(10,$offset);
		$this->db->order_by('a.product_title', 'ASC');
		$query = $this->db->get();		
		return $query->result() ;
	}

	/*	get all POS Product list  */
	public function posProductDataList($offset)
	{
		$this->db->select('a.*,b.*,c.*,d.*,e.*,f.*,g.category_name as s_category_name,g.category_id as s_category_id,h.category_name as p_category_name,h.category_id as p_category_id');
		$this->db->from('tbl_product a'); 
		$this->db->join('tbl_measurement b','a.measurement_id = b.measurement_id','inner');
		$this->db->join('tbl_discount c','a.product_discount_id = c.discount_id','left');
		$this->db->join('tbl_tax d','a.product_tax_id = d.tax_id','left');
		$this->db->join('tbl_shipping e','a.product_shipping_id = e.shipping_id','left');
		$this->db->join('tbl_brand f','a.product_brand_id = f.brand_id','left');
		$this->db->join('tbl_category g','a.product_parent_cat_id = g.category_id','left');
		$this->db->join('tbl_category h','g.category_parent_id = h.category_id','left');
		$this->db->where('a.product_status', '1');
		$this->db->where('a.product_id != ', '19');
		$this->db->limit(10,$offset);
		$this->db->order_by('a.product_title', 'ASC');
		$query = $this->db->get();		
		return $query->result() ;
	}
	
	/*	get all Product list by Parent Category ID with sort  */
	public function productByParentCategoryIdWithSort($category_id, $sort)
	{
		$this->db->select('*');
		$this->db->from('tbl_product'); 
		$this->db->where('product_parent_cat_id', $category_id);
		$this->db->where('product_status', '1');
		if($sort == 'plh')
		{
			$this->db->order_by('product_sale_price', 'ASC');
		}
		elseif($sort == 'phl')
		{
			$this->db->order_by('product_sale_price', 'DESC');
		}
		elseif($sort == 'name')
		{
			$this->db->order_by('product_id', 'ASC');
		}				
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	get all Product list by Parent Category ID with filter  */
	public function productByParentCategoryIdWithFilter($category_id, $post)
	{
		$this->db->select('a.*');
		$this->db->from('tbl_product a'); 
		$this->db->join('tbl_brand b','a.product_brand_id = b.brand_id','inner');
		$this->db->join('tbl_product_specification c','a.product_id = c.product_id','inner');
		$this->db->join('tbl_specification_val d','c.specification_id = d.specification_id','inner');
		$this->db->where('a.product_parent_cat_id', $category_id);
		$this->db->where('a.product_status', '1');
		$this->db->or_where_in('b.brand_name', $post['brand']);
		$this->db->or_where_in('d.specification_val', $post['specification']);
		$this->db->group_by('a.product_id');	
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	discount list  */
	public function discountList()
	{
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Tax list  */
	public function taxList()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Shipping list  */
	public function shippingList()
	{
		$this->db->select('*');
		$this->db->from('tbl_shipping');
		$this->db->where('shipping_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	
	/*	Manufacturer list  */
	public function allManufacturerList()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Tax list  */
	public function specificationList()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_specification a');
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','inner');
		$this->db->join('tbl_specification_val c','a.specification_val_id = c.specification_val_id','inner');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all Product details by product ID  */
	public function productDetailByProductId($product_id)
	{
		$this->db->select('a.*,b.*,c.*,d.*,e.*,f.*');
		$this->db->from('tbl_product a'); 
		$this->db->join('tbl_measurement b','a.measurement_id = b.measurement_id','inner');
		$this->db->join('tbl_discount c','a.product_discount_id = c.discount_id','left');
		$this->db->join('tbl_tax d','a.product_tax_id = d.tax_id','left');
		$this->db->join('tbl_shipping e','a.product_shipping_id = e.shipping_id','left');
		$this->db->join('tbl_brand f','a.product_brand_id = f.brand_id','left');
		$this->db->where('a.product_id', $product_id);
		$this->db->where('a.product_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	public function posProductDetailById($product_id)
	{
		$this->db->select('a.*');
		$this->db->from('tbl_product a'); 		
		$this->db->where('a.product_id', $product_id);
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all Product Images by product ID  */
	public function productImagesByProductId($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_img'); 
		$this->db->where('product_id', $product_id);
		$this->db->where('product_img_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all Product attributes by product ID  */
	public function attributesByProductId($product_id)
	{
		$this->db->select('attr_id,attr_name,attr_status,product_id,event_id,added_by,attr_name as attr_adc');
		$this->db->from('tbl_product_attr');
		$this->db->where('product_id', $product_id);		
		$query = $this->db->get();
		return $query->result() ;
	}
	/* get all Product attributes value  */
	public function allattributesList()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr'); 
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getProductReviewsById($product_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_review'); 
		$this->db->where('review_type_id', $product_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function attributesValue()
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr_val'); 
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all specification by category */
	public function getSpecificationByCategory($category_id)
	{
		$this->db->select('b.*');
		$this->db->from('tbl_category_specification a');
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','inner');
		$this->db->where('a.category_id', $category_id);		
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all specification Value */
	public function getSpecificationValue()
	{
		$this->db->select('*');
		$this->db->from('tbl_specification_val');		
		$query = $this->db->get();
		return $query->result() ;
	}
	/*	get all specification by category */
	public function getSpecification($specification_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_specification	');
		$this->db->where('specification_id', $specification_id);		
		$query = $this->db->get();
		$res =  $query->result() ;	
		$new_ar = array(); 		
		
	}
	/*	get all brand list  */
	public function getBrandList($category_id)
	{
		$this->db->select('a.*');
		$this->db->from('tbl_brand a'); 
		$this->db->join('tbl_product b','a.brand_id = b.product_brand_id','inner');
		$this->db->where('a.brand_status', '1');
		$this->db->where('b.product_parent_cat_id', $category_id);
		$this->db->order_by('a.brand_name', 'ASC');
		$this->db->group_by('a.brand_id');
		$query = $this->db->get();
		
		return $query->result() ;
	}
	/*	get all deal Product list  */
	public function dealProductList()
	{
		$this->db->select('*');
		$this->db->from('tbl_product'); 
		$this->db->where('product_deal_status', '1');
		$this->db->where('product_status', '1');
		$this->db->order_by('product_id', 'DESC');
		$query = $this->db->get();
		return $query->result() ;
	}

	/************************ Start Order *********************************/
	/* add order */	
	public function addOrder($post)
	{
		$this->db->insert('tbl_order', $post);
		//echo $this->db->last_query();die;
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}	
	/* add order Product*/	
	public function addOrderProduct($post)
	{
		$this->db->insert('tbl_order_product', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}	
	/* Update cart status*/
	public function updateCartStatus($post,$cart_id)
	{	
		$this->db->where('cart_id', $cart_id);
		$this->db->update('tbl_cart', $post);
		return true;
	}	

	/* Update cart status*/
	public function updateProductQty($product_id,$product_qty)
	{	
		$data['product_qty'] = $product_qty;
		$this->db->where('product_id', $product_id);
		$this->db->update('tbl_product', $data);
		return true;
	}		

	/* Update Order Details*/
	public function updateOrderDetails($order_id,$unic_order_id)
	{	
		$data['unic_order_id'] = $unic_order_id;
		$this->db->where('order_id', $order_id);
		$this->db->update('tbl_order', $data);
		return true;
	}	

	/* show product order history */	
	public function getOrderHistory($user_id){
		
		$this->db->select('a.*, c.*, d.*');
		$this->db->from('tbl_order a');
		$this->db->join('tbl_order_product b','a.order_id = b.order_id','inner');
		$this->db->join('tbl_cart c','b.cart_id = c.cart_id','inner');
		$this->db->join('tbl_product d','b.product_id = d.product_id','inner');
		$this->db->where('a.order_user_id', $user_id);	
		$query = $this->db->get();
		return $query->result() ;
	}

	/* show product order attributes */	
	public function getOrderProductAttr($user_id){
		
		$this->db->select('a.*, c.*, d.*');
		$this->db->from('tbl_order a');
		$this->db->join('tbl_order_product b','a.order_id = b.order_id','inner');
		$this->db->join('tbl_cart_attr c','b.cart_id = c.cart_id','inner');
		$this->db->join('tbl_product_attr d','b.product_id = d.product_id','inner');
		$this->db->where('a.order_user_id', $user_id);	
		$query = $this->db->get();
		return $query->result() ;
	}

	
	/************************ End order *********************************/	
	
  	/************************************* START CART ******************************************/
	/* Check wishlist */	
	public function checkCart($check){
		
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('cart_user_id', $check['cart_user_id']);		
		$this->db->where('cart_product_id', $check['cart_product_id']);		 		
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getCartDetailsById($user_id,$product_id){
		
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('cart_user_id', $user_id);		
		$this->db->where('cart_product_id', $product_id);		 		
		$query = $this->db->get();
		return $query->row() ;
	}
	/* add cart */	
	public function addCart($post)
	{
		$this->db->insert('tbl_cart', $post);	
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	/* Update cart */
	public function updateCartQty($post)
	{	
		$data['cart_product_qty'] = $post['cart_product_qty'];
		$data['cart_sub_total'] = $post['cart_sub_total'];
		$this->db->where('cart_user_id', $post['cart_user_id']);
		$this->db->where('cart_product_id', $post['cart_product_id']);
		$this->db->update('tbl_cart', $data);
		return true;
	}	
	/* add cart attributes */	
	public function addCartAttr($post){
		$this->db->insert('tbl_cart_attr', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
	/*	get cart details by user_id */
	public function getCartByUserId($user_id, $cart_offset = NULL)
	{
		$this->db->select('a.cart_id,cart_product_qty,cart_product_id,cart_sub_total, b.*, c.*, d.*, e.*, f.*, g.*, h.*');
		$this->db->from('tbl_cart a');
		$this->db->join('tbl_product b','a.cart_product_id = b.product_id','INNER');
		$this->db->join('tbl_discount c','b.product_discount_id = c.discount_id','left');
		$this->db->join('tbl_tax d','b.product_tax_id = d.tax_id','left');
		$this->db->join('tbl_shipping e','b.product_shipping_id = e.shipping_id','left');
		$this->db->join('tbl_brand f','b.product_brand_id = f.brand_id','left');
		$this->db->join('tbl_measurement g','b.measurement_id = g.measurement_id','inner');
		$this->db->join('tbl_category h','a.cart_category_id = h.category_id','INNER');
		$this->db->where('a.cart_user_id', $user_id);		
		$this->db->where('a.cart_status', '1');
		$this->db->where('a.cart_checkout_status', '0');
		if($cart_offset != NULL)
		{
			$this->db->limit(10,$cart_offset);
		}		
		$query = $this->db->get();		
		return $query->result() ;
	}
	/*	get cart attributes details by user_id */
	public function getCartAttrByUserId($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_cart_attr');
	    	$this->db->where('cart_attr_user_id', $user_id);		
		$query = $this->db->get();		
		return $query->result();
	}	
   	/*	delete wishlist  by user_id */
	public function deleteCartByUserId($cart_user_id,$cart_product_id)
	{
	    	$res = $this->db->delete('tbl_cart', array('cart_user_id' => $cart_user_id,'cart_product_id'=>$cart_product_id));		
	     	$res = $this->db->delete('tbl_cart_attr', array('cart_attr_user_id' => $cart_user_id,'cart_product_id'=>$cart_product_id));		
		return $res;	
	}

		/*	delete wishlist  by user_id */
	public function removeCartItemById($cart_id)
	{
    	$res = $this->db->delete('tbl_cart', array('cart_id' => $cart_id));		
     	$res = $this->db->delete('tbl_cart_attr', array('cart_id' => $cart_id));
		return $res;	
	}
	/**************************** END CART ***********************************/

	/*********************** START USER details ****************************/
	public function getUserAddress($user_id, $user_address_type)
 	{		
		$this->db->select('a.*, b.country_name, c.state_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b','a.user_address_country_id = b.country_id','INNER');
		$this->db->join('state c','a.user_address_state_id = c.state_id','INNER');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_address_type', $user_address_type);
		$query = $this->db->get();
		return $query->result() ;
 	} 
 	
 	public function getGuestUserAddress($user_id)
 	{		
		$this->db->select('a.*, b.country_name, c.state_name');
		$this->db->from('tbl_guest_user_address a');
		$this->db->join('country b','a.guest_user_country_id = b.country_id','INNER');
		$this->db->join('state c','a.guest_user_state_id = c.state_id','INNER');
		$this->db->where('a.guest_user_id', $user_id);
		$query = $this->db->get();
		return $query->result() ;
 	} 

 	public function showDefaultAddress($user_id)
 	{		
		$this->db->select('a.*, b.country_name, c.state_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b','a.user_address_country_id = b.country_id','INNER');
		$this->db->join('state c','a.user_address_state_id = c.state_id','INNER');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_address_default', '1');
		$query = $this->db->get();
		return $query->result() ;
 	} 

 	public function addUserAddress($post)
	{		
		$this->db->insert('tbl_user_address', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
 	public function getUserAddressByAddressID($user_id, $user_address_id)
 	{		
		$this->db->select('a.*, b.country_name, c.state_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b','a.user_address_country_id = b.country_id','INNER');
		$this->db->join('state c','a.user_address_state_id = c.state_id','INNER');
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.user_address_id', $user_address_id);
		$this->db->where('a.user_address_status', '1');
		$query = $this->db->get();
		return $query->result() ;
 	} 
 	public function updateUserAddressByAddressID($post)
 	{
 		$data['user_address_name'] = $post['user_address_name'];       
   		$data['user_address_phone'] = $post['user_address_phone'];       
   		$data['user_address_mobile'] = $post['user_address_mobile'];       
   		$data['user_address_1'] = $post['user_address_1'];       
   		$data['user_address_2'] = $post['user_address_2'];       
   		$data['user_address_country_id'] = $post['user_address_country_id'];       
   		$data['user_address_state_id'] = $post['user_address_state_id'];       
   		$data['user_address_city'] = $post['user_address_city'];       
   		$data['user_address_postalcode'] = $post['user_address_postalcode'];  
		$this->db->where('user_id', $post['user_id']);
		$this->db->where('user_address_id', $post['user_address_id']);
		$this->db->update('tbl_user_address', $data);
		return true;
 	}
 	public function updateDefaultAddressStatusN($post)
 	{
 		$data['user_address_default'] = '0';  
		$this->db->where('user_id', $post['user_id']);
		$this->db->where('user_address_id !=', $post['user_address_id']);
		$this->db->update('tbl_user_address', $data);
		return true;
 	}
 	public function updateDefaultAddressStatusY($post)
 	{
 		$data['user_address_default'] = '1';  
		$this->db->where('user_id', $post['user_id']);
		$this->db->where('user_address_id', $post['user_address_id']);
		$this->db->update('tbl_user_address', $data);
		return true;
 	}
 	public function deleteUserAddressByAddressID($post)
	{
	    	
	    	// $res = $this->db->delete('tbl_user_address', array('user_id' => $post['user_id'],'user_address_id'=>$post['user_address_id']));	
	    	$data['user_address_default'] = '0';  
	    	$data['user_address_status'] = '0';  
			$this->db->where('user_id', $post['user_id']);
			$this->db->where('user_address_id', $post['user_address_id']);
			$this->db->update('tbl_user_address', $data);
			return true;	
	     	return true;	
	}
 	public function getCountryList()
 	{		
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_status', '1');
		$this->db->where('country_id', '99');
		$query = $this->db->get();
		return $query->result() ;
 	} 
 	public function getStateList($country_id)
 	{		
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('country_id', $country_id);
		$this->db->where('state_status', '1');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result() ;
 	} 
	
	public function getPosUserList($user_type = NULL, $offset)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_type', $user_type);	
		$this->db->order_by('user_name', 'ASC');
		$this->db->limit(10,$offset);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result() ;
 	}

	public function addSocialUser($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
 	public function checkSocialUser($check)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $check['user_email']);
		$this->db->or_where('user_phone', $check['user_phone']);
		$query = $this->db->get();
		return $query->result() ;
 	} 

 	public function loginUser($post)
 	{		
		$user_email_phone = $post['user_email_phone'];
		$this->db->select('a.*,b.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('state b','a.user_state_id = b.state_id','left');		
		$this->db->where("(a.user_email = '".$user_email_phone."' OR a.user_phone = '".$user_email_phone."')");
		$this->db->where('a.user_password', $post['user_password']);
		$this->db->where('a.user_status', '1');
		$this->db->where('a.user_status_type', 'Approved');
		$query = $this->db->get();		

		return $query->result() ;
 	} 

 	public function loginPosUser($post)
 	{		
		$user_email_phone = $post['user_email_phone'];
		$this->db->select('a.*,b.state_name');
		$this->db->from('tbl_user a');
		$this->db->join('state b','a.user_state_id = b.state_id','left');		
		$this->db->where("(a.user_email = '".$user_email_phone."' OR a.user_phone = '".$user_email_phone."')");
		$this->db->where('a.user_password', $post['user_password']);
		$this->db->where('a.user_status', '1');		
		$this->db->where("(a.user_role_id = '1' OR a.user_role_id = '3')");
		$this->db->where('a.user_status_type', 'Approved');
		$query = $this->db->get();	

		return $query->result() ;
 	} 

 	public function showProfile($user_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$this->db->where('user_status', '1');
		$query = $this->db->get();
		return $query->result() ;
 	} 
 	public function updateProfile($post)
 	{
 		$data['user_name'] = $post['user_name'];
		$data['user_phone'] = $post['user_phone'];
		$data['user_dob'] = $post['user_dob'];
		$data['user_address_1'] = $post['user_address_1'];
		$data['user_address_2'] = $post['user_address_2'];
		$data['user_city'] = $post['user_city'];
		$data['user_state_id'] = $post['user_state_id'];
		$data['user_country_id'] = $post['user_country_id'];
		$data['user_postal_code'] = $post['user_postal_code'];
		$data['user_updated_date'] = $post['user_updated_date'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}
 	public function changePassword($post)
 	{
 		$data['user_password'] = $post['user_password'];
		$data['user_updated_date'] = $post['user_updated_date'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}
 	public function updateloginStatus($post)
 	{
 		$data['user_log_status'] = $post['user_log_status'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
 	}
 	/*********************************** END USER details *************************************/
 	
 	/*********************************** START Coupon ******************************************/
 	public function applyCouponCode($post)
 	{		
		$this->db->select('a.*');
		$this->db->from('tbl_coupon a');
		$this->db->join('tbl_coupon_send b','a.coupon_id = b.coupon_id','INNER');
		$this->db->where('b.user_email', $post['user_email']);		
		$this->db->where('b.send_coupon_status', '1');		
		$this->db->where('a.coupon_code', $post['coupon_code']);		
		$this->db->where('a.coupon_start_date <=', $post['coupon_date']);		
		$this->db->where('a.coupon_end_date >=', $post['coupon_date']);
		$query = $this->db->get();
		return $query->result() ;
 	} 
 	public function updateCouponCodeStatus($post)
	{		
		$data['send_coupon_status'] = 0;
		$this->db->where('user_email', $post['user_email']);
		$this->db->update('tbl_coupon_send', $data);
		return true;
	}
 	/************************************* END Coupon ******************************************/
 	
	/********************************* Start Guest Checkout **********************************/
 	
	public function addGuestUser($post)
	{
		$this->db->insert('tbl_guest_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	public function addGuestUserAddress($post)
	{
		$this->db->insert('tbl_guest_user_address', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}
	
	public function getGuestUser($user_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_guest_user');
		$this->db->where('guest_user_id', $user_id);	
		$query = $this->db->get();
		return $query->result() ;
 	} 	
 	/********************************* END Guest Checkout **********************************/
	
	public function getTaxDetailsById($tax_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_id', $tax_id);	
		$query = $this->db->get();
		return $query->row();
 	} 

 	public function getShippingDetailsById($shipping_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_shipping');
		$this->db->where('shipping_id', $shipping_id);	
		$query = $this->db->get();
		return $query->row() ;
 	} 
 	public function getDiscountDetailsById($discount_id)
 	{		
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_id', $discount_id);	
		$query = $this->db->get();
		return $query->row() ;
 	} 

 	public function getOrderDetailsList($user_id,$offset)
 	{
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where("(order_track_status = 'Delivered' OR order_track_status = 'Failed')");
		$this->db->where('order_user_id', $user_id);
		$this->db->order_by('order_id', 'DESC');
		$this->db->limit(10,$offset);
		$query = $this->db->get();
		return $query->result();
 	}

 	public function getOrderProductsList($order_id,$offset)
 	{
		$this->db->select('a.*,b.*,c.*,d.*');
		$this->db->from('tbl_order_product a');
		$this->db->join('tbl_cart b','a.cart_id = b.cart_id','inner');
		$this->db->join('tbl_product c','a.product_id = c.product_id','inner');
		$this->db->join('tbl_measurement d','c.measurement_id = d.measurement_id','inner');
		$this->db->where('a.order_id', $order_id);
		$this->db->order_by('a.order_product_id', 'DESC');
		$this->db->limit(10,$offset);
		$query = $this->db->get();
		return $query->result();
 	}

 	public function getOrderTrackingDetailsList($user_id,$offset)
 	{
		$this->db->select('*');
		$this->db->from('tbl_order');
		$this->db->where('order_track_status !=','Delivered');
		$this->db->where('order_track_status !=','Failed');
		$this->db->where('order_user_id', $user_id);
		$this->db->order_by('order_id', 'DESC');
		$this->db->limit(10,$offset);
		$query = $this->db->get();		
		return $query->result();
 	}

 	public function getOrderTrackingProductsList($order_id,$offset = NULL)
 	{
		$this->db->select('a.*,b.*,c.*,d.*');
		$this->db->from('tbl_order_product a');
		$this->db->join('tbl_cart b','a.cart_id = b.cart_id','inner');
		$this->db->join('tbl_product c','a.product_id = c.product_id','inner');
		$this->db->join('tbl_measurement d','c.measurement_id = d.measurement_id','inner');
		$this->db->where('a.order_id', $order_id);
		$this->db->order_by('a.order_product_id', 'DESC');
		if($offset != NULL)
		{
			$this->db->limit(10,$offset);
		}

		$query = $this->db->get();
		return $query->result();
 	}

 	public function getFinalOrderPriceList($user_id,$offset = NULL)
 	{
		$this->db->select('a.cart_id,cart_product_qty,b.*,c.*,d.*,e.*,f.*,g.*');
		$this->db->from('tbl_cart a');
		$this->db->join('tbl_product b','a.cart_product_id = b.product_id','inner');
		$this->db->join('tbl_discount c','b.product_discount_id = c.discount_id','left');
		$this->db->join('tbl_tax d','b.product_tax_id = d.tax_id','left');
		$this->db->join('tbl_shipping e','b.product_shipping_id = e.shipping_id','left');
		$this->db->join('tbl_brand f','b.product_brand_id = f.brand_id','left');
		$this->db->join('tbl_measurement g','b.measurement_id = g.measurement_id','inner');
		$this->db->where('a.cart_checkout_status', '0');
		$this->db->where('a.cart_status', '1');
		$this->db->where('a.cart_user_id', $user_id);
		$this->db->order_by('a.cart_id', 'DESC');
		if($offset != NULL)
		{
			$this->db->limit(10,$offset);
		}

		$query = $this->db->get();
		return $query->result();
 	}

 	public function getReorderProductById($order_id)
 	{
 		$this->db->select('*');
		$this->db->from('tbl_order_product');
		$this->db->where('order_id', $order_id);
		$query = $this->db->get();
		return $query->result();
 	}


 	public function getReorderCartDetailsById($cart_id)
 	{
 		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('cart_id', $cart_id);
		$query = $this->db->get();
		return $query->row();
 	}

 	public function getReorderProductDetailsById($product_id)
 	{
 		$this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		return $query->row();
 	}
	
	public function getUserByID($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->row();
	}

	public function updateUserDetails($user_id,$post)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}

	public function addBalanceSheet($post)
	{
		$this->db->insert('tbl_balance_sheet', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result;
	}

	public function getDueUserOrder($user_id,$offset = NULL)
	{
		if($offset != NULL)
		{
			$query = $this->db->query("SELECT * FROM(SELECT * FROM (SELECT DISTINCT order_id,order_total_amount,paid_amount,due_amount,amount_cr_date FROM `tbl_balance_sheet` WHERE user_id = $user_id ORDER BY balance_sheet_id DESC) as t GROUP BY t.order_id ORDER BY t.amount_cr_date DESC) as k WHERE k.due_amount>0 LIMIT $offset,10");
		}
		else
		{
			$query = $this->db->query("SELECT * FROM(SELECT * FROM (SELECT DISTINCT order_id,order_total_amount,paid_amount,due_amount,amount_cr_date FROM `tbl_balance_sheet` WHERE user_id = $user_id ORDER BY balance_sheet_id DESC) as t GROUP BY t.order_id ORDER BY t.amount_cr_date DESC) as k WHERE k.due_amount>0");
		}
		return $query->result();		
	}

	public function getPrvDueAmountById($user_id,$order_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_balance_sheet');
		$this->db->where('user_id', $order_id);
		$this->db->where('order_id', $user_id);
		$this->db->order_by('balance_sheet_id' , 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row();
	}
}
?>
