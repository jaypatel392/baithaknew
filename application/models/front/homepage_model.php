<?php

class Homepage_model extends CI_Model
{
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
        $this->db->where('category_parent_id', '0');
        $this->db->where('featured_category', '1');        
        $query = $this->db->get();
        return $query->result();        
    }
    
    
    public function getProducts()
    {        
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->join('tbl_category', 'tbl_category.category_parent_id = tbl_product.product_parent_cat_id' , 'inner');     
        $query = $this->db->get();
        return $query->result();        
    }
    
    
    function getNewProduct()
    {        
        $this->db->select('*');
        $this->db->from('tbl_product');
        $this->db->order_by('product_updated_date', 'DESC');
        $this->db->where('product_status', '1');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    } 
        
    function getBrands()
    {        
        $this->db->select('*');
        $this->db->from('tbl_brand');
        $this->db->where('brand_status', '1');
        $query = $this->db->get();
        return $query->result();
    }   
    
    
    public function getThreeProductByCategoryId()
    {        
        $this->db->select('*');
        $this->db->from('tbl_product');
        // $this->db->where('product_parent_cat_id', $category_id);
        $this->db->where('product_status', '1');
        // $this->db->limit(3);
        $this->db->order_by('product_id', 'DESC');
        $query = $this->db->get();        
        return $query->result();
    }
    
    public function getThreeProductImage($product_id)
    {        
        $this->db->select('*');
        $this->db->from('tbl_product_img');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_img_status', '1');
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



    public function getThreeProductLatest()
    {        
        $this->db->select('*');
        $this->db->from('tbl_product');       
        $this->db->where('product_status', '1');
        $this->db->limit(3);
        $this->db->order_by('product_updated_date', 'DESC');
        $query = $this->db->get();        
        return $query->result();
    }    
    
    public function getTopcategories()    {
        
       $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_status', '1');        
        $this->db->where('category_parent_id', '0');
        $this->db->where('featured_category', '1');
        $this->db->order_by('category_position', 'ASC');       
        $query = $this->db->get();
        return $query->result();        
    }

     public function getSubCategories($parant_cat_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_category');
        $this->db->where('category_parent_id',$parant_cat_id);
        $query = $this->db->get();
        return $query->result();

    }

    public function getDiscountedProduct()
	{
		$today = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('tbl_product a');
		$this->db->join('tbl_discount b','a.product_discount_id = b.discount_id');
		$this->db->where('b.discount_end_date >',$today);
		$this->db->where('b.discount_status','1');
		$this->db->where('a.product_status','1');
		$this->db->where('b.discount_type','Percent');
		$this->db->order_by('b.discount_value','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
	    return $query->result();

	}	
    
        /*  Get all Country List  */
    public function getCountryList()
    {
        $this->db->select('*');
        $this->db->from('country');
        $this->db->where('country_status', '1');
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
        $this->db->select('*');
        $this->db->from('tbl_product_attr_val');        
        $this->db->select_min('attr_price');
        $this->db->where('attr_id',$attr_id);
        $query = $this->db->get();
        return $query->result();

      }
     public function getAttrvalueMaxPrice($attr_id)

     {      
        $this->db->select('*');
        $this->db->from('tbl_product_attr_val');
        $this->db->select_max('attr_price');       
        $this->db->where('attr_id',$attr_id);
        $query = $this->db->get();
        return $query->result();

      }

      public function getSubscribPlan()
      {
            $this->db->select('*');
            $this->db->from('tbl_subscribe');           
            $query = $this->db->get();
            return $query->result();
      }

    public function getHomeBanner()
    {
        $this->db->select('*');
        $this->db->from('tbl_home_banner');           
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getDiscountedBanner()
    {
        $this->db->select('*');
        $this->db->from('tbl_home_discount');           
        $query = $this->db->get();
        return $query->result();
    }
   
    public function getDealsBanner()
    {
        $this->db->select('*');
        $this->db->from('tbl_home_deals');           
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTestimonials()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonial');           
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getSpDealsBanner()
    {
        $this->db->select('*');
        $this->db->from('tbl_home_sp_deals');           
        $query = $this->db->get();
        return $query->result();
    }

}
?>