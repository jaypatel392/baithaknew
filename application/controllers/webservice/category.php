<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('webservice/category_model');	
	}
	
	public function parentCategory()
	{
		$category_list = $this->category_model->getParentCategory();
		
		if(!empty($category_list))
		{
			echo json_encode(array("status"=>1,"category_list"=>$category_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 	
	
	public function subCategories()
	{
		$parent_id = $_POST['parent_category_id'];
		$category_list = $this->category_model->getSubCategories($parent_id);
		if(!empty($category_list))
		{
			echo json_encode(array("status"=>1,"category_list"=>$category_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 
		
	public function productByParentCategoryId()
	{
		$category_id = $_POST['category_id'];
		$offset = $_POST['offset'];
		$product_by_category = $this->category_model->productByParentCategoryId($category_id,$offset);
		
		if(!empty($product_by_category))
		{			
			echo json_encode(array("status"=>1,"product_by_category"=>$product_by_category));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 

	public function posProductDataList()
	{
		$offset = $_POST['offset'];
		$products_list = $this->category_model->posProductDataList($offset);
		if(!empty($products_list))
		{			
			echo json_encode(array("status"=>1,"products_list"=>$products_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 	

	public function searchProductBykey()
	{
		$offset = $_POST['offset'];
		$search_key = $_POST['search_key'];
		$products_list = $this->category_model->searchProductBykey($search_key,$offset);
		if(!empty($products_list))
		{			
			echo json_encode(array("status"=>1,"products_list"=>$products_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 	

	public function getAttributesByproductId()
	{
		$product_id = $_POST['product_id'];
		$attributes_list = $this->category_model->attributesByProductId($product_id);
		if(!empty($attributes_list))
		{

			$attr_min_value = $this->category_model->getAttrvalueMinPrice($attributes_list[0]->attr_id);
			$attr_max_value = $this->category_model->getAttrvalueMaxPrice($attributes_list[0]->attr_id);
		
			if(!empty($attributes_list))
			{
				echo json_encode(array("status"=>1,"min_price"=>$attr_min_value, "max_price"=>$attr_max_value));
			}
		}
		else
		{
			echo json_encode(array("status"=>0));
		}

	}
	public function productDetailByProductId()
	{
		$product_id = $_POST['product_id'];
		$product_detail = $this->category_model->productDetailByProductId($product_id);		
		$product_images = $this->category_model->productImagesByProductId($product_id);
		$discount_list = $this->category_model->discountList();
		$attributes_list = $this->category_model->attributesByProductId($product_id);
		$reviews_list = $this->category_model->getProductReviewsById($product_id);		
       	$attributes_value_list = $this->category_model->attributesValue();		
		if(!empty($product_detail))
		{
			echo json_encode(array("status"=>1,"product_detail"=>$product_detail, "product_images"=>$product_images, "discount_list"=>$discount_list, "attributes_list"=>$attributes_list, "attributes_value_list"=>$attributes_value_list,'reviews_list' => $reviews_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 
	public function showAllFilter()
	{
		$category_id = $_POST['category_id'];
		$brand_list = $this->category_model->getBrandList($category_id);
		$specification_list = $this->category_model->getSpecificationByCategory($category_id);
		$specification_value = $this->category_model->getSpecificationValue();
		
		if(!empty($brand_list) && !empty($specification_list))
		{
			echo json_encode(array("status"=>1, "brand_list"=>$brand_list, "specification_list"=>$specification_list, "specification_value"=>$specification_value ));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	}
	/**************************** Start Order product ************************/


	public function checkFinalCheckout()
	{
		$user_id = $_POST['user_id'];
		$remove = $_POST['remove'];
		$cart_details = $this->category_model->getCartByUserId($user_id);
		$error_msg = array();		
	   	foreach ($cart_details as $c_value) 
	   	{
			if($c_value->cart_product_qty > $c_value->product_qty)
			{
				if($remove == 0)
				{
					$error_msg[] = $c_value->product_title;
				}
				else
				{
					$remove_res = $this->category_model->removeCartItemById($c_value->cart_id);
				}
			}
		}
		 if(sizeof($error_msg) > 0)
		 {
		 	echo json_encode(array("status"=>0,'error_msg'=>$error_msg));
		 }
		 else
		 {
		 	if($remove != 0)
		 	{
		 		if($remove_res)
		 		{
		 			echo json_encode(array("status"=>1));
		 		}
		 		else
		 		{
		 			echo json_encode(array("status"=>0));
		 		}
		 	}
		 	else
		 	{
		 		echo json_encode(array("status"=>1));
		 	}
		 }

	}

	public function checkFinalOrderPrice()
	{
   		$user_id = $_POST['user_id'];
   		$user_type = $_POST['user_type'];
   		if(isset($_POST['offset']))
   		{
   			$offset = $_POST['offset'];
   		}
   		else
   		{
   			$offset = NULL;
   		}
   		$final_checkout_cart = $this->category_model->getFinalOrderPriceList($user_id,$offset);   		
   		if(!empty($final_checkout_cart))
		{
			$cart_list = $this->category_model->getCartByUserId($user_id);
	   		foreach ($cart_list as $value)
	   		{   		
	   			$product_details = $this->category_model->productDetailByProductId($value->cart_product_id);
				foreach ($product_details as $cp_res) 
			    {	   
		    		if($user_type == 'Hospitalist')
				 	{
				 		$cart_total_price = $cp_res->price_for_hospitalist;
				 	}
				 	else if($user_type == 'Dr')
				 	{
				 		$cart_total_price = $cp_res->price_for_doctor;
				 	}
				 	else if($user_type == 'Pharma-wholseller')
				 	{
				 		$cart_total_price = $cp_res->price_for_pharma;
				 	}
				 	else if($user_type == 'Chemist')
				 	{
				 		$cart_total_price = $cp_res->price_for_chemist;
				 	}
				 	else
				 	{
				 		$cart_total_price = $cp_res->product_sale_price; 
				 	}
					 
					$c_post['main_price'] = $cart_total_price;
			    	if($cp_res->product_discount_id)
			    	{
			    		$discount_details = $this->category_model->getDiscountDetailsById($cp_res->product_discount_id);
			    		if(!empty($discount_details))
			    		{
							$today = date("Y-m-d");
							$expire = $discount_details->discount_end_date;
							$start_date = $discount_details->discount_start_date;
							$today_time = strtotime($today);
							$expire_time = strtotime($expire);
							$start_time = strtotime($start_date);
							if($start_time <= $today_time && $expire_time >= $today_time) 
							{ 
								$c_post['discount_name'] = $discount_details->discount_name;
								$c_post['discount_type'] = $discount_details->discount_type;
								$c_post['discount_value'] = $discount_details->discount_value;
								if($discount_details->discount_type == 'Fix')
								{
								 $cart_total_price = $cart_total_price-$discount_details->discount_value;
								}
								else
								{
								 	 $cart_total_price = $cart_total_price-($cart_total_price * $discount_details->discount_value)/100;
								}
							}
			    		}

			    	}

			    	if($cp_res->product_tax_id)
			    	{
			    		$tax_details = $this->category_model->getTaxDetailsById($cp_res->product_tax_id);
			    		//print_r($tax_details); die;
			    		if(!empty($tax_details))
			    		{
			    			 $c_post['tax_name'] = $tax_details->tax_name;
			    			 $c_post['tax_value'] = $tax_details->tax_value;    			  
			    			 $cart_total_price = $cart_total_price+($cart_total_price * $tax_details->tax_value)/100;	    			 		 
			    		}
			    	}
			    	$product_shipping_id = $cp_res->product_shipping_id;
			    	$product_qty =  $cp_res->product_qty-$value->cart_product_qty;
	   				$this->category_model->updateProductQty($value->cart_product_id,$product_qty);
   					if($product_shipping_id)
				    {
			    		$shipping_details = $this->category_model->getShippingDetailsById($product_shipping_id);	    		
			    		if(!empty($shipping_details))
			    		{
							$c_post['shipping_name'] = $shipping_details->shipping_name;
							$c_post['shipping_type'] = $shipping_details->shipping_type;
							$c_post['shipping_value'] = $shipping_details->shipping_value;
							$c_post['shipping_multiply_type'] = $shipping_details->shipping_multiply_type;
							$c_post['shipping_multiply_value'] = $shipping_details->shipping_multiply_value;
							if($shipping_details->shipping_type == 'Fix')
							{
							 	$cart_total_price = $cart_total_price+$shipping_details->shipping_value;
							}
							else if($shipping_details->shipping_type == 'Percent')
							{
							 	$cart_total_price = $cart_total_price+($cart_total_price * $shipping_details->shipping_value)/100;
							}	
							else if($shipping_details->shipping_type == 'multiply')
							{
								$qty = $value->cart_product_qty;
								while($qty > 0)
								{
									$cart_total_price = $cart_total_price+$shipping_details->shipping_value;
									$qty = $qty-$shipping_details->shipping_multiply_value;
								}				 	
							}					
			    		}
				    }
			    }	
			    $c_post['cart_total_price'] =  $cart_total_price;
			    $c_post['cart_sub_total'] =  $cart_total_price * $value->cart_product_qty;
			    $c_post['cart_status'] = '1';
			    $c_post['cart_checkout_status'] = '0';
	   			$this->category_model->updateCartStatus($c_post , $value->cart_id);
	   			
	   		}
		  	echo json_encode(array("status"=>1, "final_checkout_cart"=>$final_checkout_cart));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}	
	}

	public function orderProduct()
   	{   
   		$post['order_date_time'] = $_POST['order_date_time'];       
   		$post['order_pay_type'] = $_POST['order_pay_type'];
   		$post['order_tansaction_id'] = $_POST['order_tansaction_id'];       
   		$post['order_payment_status'] = $_POST['order_payment_status'];       
   		$post['order_user_type'] = $_POST['order_user_type'];
   		$post['order_subtotal'] = $_POST['order_subtotal'];
   		$post['order_tax_total'] = $_POST['order_tax_total'];
   		$post['order_discount_total'] = $_POST['order_discount_total'];
   		$post['order_shipping_total'] = $_POST['order_shipping_total'];
   		$post['order_final_amt'] = $_POST['order_final_amt'];
   		$post['order_user_id'] = $_POST['order_user_id'];       
   	    $post['order_user_d_address_id'] = $_POST['order_user_d_address_id'];       
   		$post['order_user_b_address_id'] = $_POST['order_user_b_address_id'];   
   		$post['order_track_status'] = 'Pending';
   		$post['order_created_date'] = date('Y-m-d');
   		$post['order_updated_date'] = date('Y-m-d');
   		$user_type = $_POST['user_type'];
   		$order_id = $this->category_model->addOrder($post);
   		$unic_order_id = 'AT-'.substr(mt_rand(),0,5).'-'.$order_id;
   		$this->category_model->updateOrderDetails($order_id,$unic_order_id);   		
    	if($order_id)
		{
			$cart_list = $this->category_model->getCartByUserId($_POST['order_user_id']);
	   		foreach ($cart_list as $value)
	   		{
				$p_post['order_id'] = $order_id;
				$p_post['product_id'] = $value->cart_product_id;
				$p_post['cart_id'] = $value->cart_id;
				$order_product_id = $this->category_model->addOrderProduct($p_post);
			    $c_post['cart_status'] = '0';
			    $c_post['cart_checkout_status'] = '1';
	   			$this->category_model->updateCartStatus($c_post , $value->cart_id);
	   		}
		  	echo json_encode(array("status"=>1,'order_id'=> $order_id));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

 	public function productReOrder()
   	{
   		$order_id = $_POST['order_id'];
   		$reorder = $_POST['reorder'];
   		$check_reorder_qty = $this->category_model->getOrderTrackingProductsList($order_id);
		$error_msg = array();
		if($reorder == 0)
		{
			foreach ($check_reorder_qty as $c_value) 
		   	{
				if($c_value->cart_product_qty > $c_value->product_qty)
				{
					if($reorder == 0)
					{
						$error_msg[] = $c_value->product_title;
					}
				}
			}
			if(sizeof($error_msg) > 0)
			{
				echo json_encode(array("status"=>0,'error_msg'=>$error_msg));
			}
			else
			{		
				$reorder_list = $this->category_model->getReorderProductById($order_id);
				if(!empty($reorder_list))
				{

					foreach ($reorder_list as $ro_res) 
					{
						$cart_details = $this->category_model->getReorderCartDetailsById($ro_res->cart_id);
						$c_post['cart_product_id'] = $cart_details->cart_product_id;
						$c_post['cart_category_id'] = $cart_details->cart_category_id;
						$c_post['cart_user_id'] = $cart_details->cart_user_id;
						$c_post['cart_product_qty'] = $cart_details->cart_product_qty;
						$c_post['cart_created_date'] = date('Y-m-d');
						$cart_id = $this->category_model->addCart($c_post);
					}
					if($cart_id)
					{
						echo json_encode(array("status"=>1));
					}
					else
					{
						echo json_encode(array("status"=>0));
					}
				}
			}
		}
		else
		{
			$reorder_list = $this->category_model->getReorderProductById($order_id);
			if(!empty($reorder_list))
			{
				foreach ($reorder_list as $ro_res) 
				{
					$cart_details = $this->category_model->getReorderCartDetailsById($ro_res->cart_id);
					$product_details = $this->category_model->getReorderProductDetailsById($ro_res->product_id);
					if($cart_details->cart_product_qty <= $product_details->product_qty)
					{
						$c_post['cart_product_id'] = $cart_details->cart_product_id;
						$c_post['cart_category_id'] = $cart_details->cart_category_id;
						$c_post['cart_user_id'] = $cart_details->cart_user_id;
						$c_post['cart_product_qty'] = $cart_details->cart_product_qty;
						$c_post['cart_created_date'] = date('Y-m-d');
						$cart_id = $this->category_model->addCart($c_post);
					}
				}
				if($cart_id)
				{
					echo json_encode(array("status"=>1));
				}
				else
				{
					echo json_encode(array("status"=>0));
				}
			}		
		}		
   		
   	}

   	public function showOredreList()
   	{
   		$user_id = $_POST['user_id'];
   		$offset = $_POST['offset'];
   		$order_details = $this->category_model->getOrderDetailsList($user_id,$offset);
   		if(!empty($order_details))
		{
		  	echo json_encode(array("status"=>1, "order_details_list"=>$order_details));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}

   	}  	

   	public function showOredreProductsList()
   	{
   		$order_id = $_POST['order_id'];
   		$offset = $_POST['offset'];
   		$order_product_list = $this->category_model->getOrderProductsList($order_id,$offset);
   		if(!empty($order_product_list))
		{
		  	echo json_encode(array("status"=>1, "order_product_list"=>$order_product_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}

   	}

   	public function showOredreTrackingList()
   	{
   		$user_id = $_POST['user_id'];
   		$offset = $_POST['offset'];
   		$order_details = $this->category_model->getOrderTrackingDetailsList($user_id,$offset);
   		if(!empty($order_details))
		{
		  	echo json_encode(array("status"=>1, "order_details_list"=>$order_details));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}

   	}  	

   	public function showOredreTrackingProductsList()
   	{
   		$order_id = $_POST['order_id'];
   		$offset = $_POST['offset'];
   		$order_product_list = $this->category_model->getOrderTrackingProductsList($order_id,$offset);
   		if(!empty($order_product_list))
		{
		  	echo json_encode(array("status"=>1, "order_product_list"=>$order_product_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}

   	}
   	public function showOrderHistory()
   	{
   		$user_id = $_POST['user_id'];

   		$product_order_history = $this->category_model->getOrderHistory($user_id);
   		$product_order_attr = $this->category_model->getOrderProductAttr($user_id); 
   		if($product_order_history)
		{
		  	echo json_encode(array("status"=>1, "product_order_history"=>$product_order_history, "product_order_attr"=>$product_order_attr));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

	/***************************** START CART ************************************/ 
	public function addCart()
	{
		$post['cart_user_id'] = $_POST['user_id'];
		$post['cart_product_id'] = $_POST['product_id'];		
		$post['cart_category_id'] = $_POST['category_id'];
	    $post['cart_product_qty']= $_POST['cart_product_qty'];
	    $user_type = $_POST['user_type'];
	    $product_details = $this->category_model->productDetailByProductId($_POST['product_id']);
	     if(!empty($product_details) && $product_details[0]->product_qty >= $_POST['cart_product_qty'])
	    {		   
		    $post['cart_created_date'] =  date('Y-m-d');
			$cart_id = $this->category_model->addCart($post);
			if(!empty($cart_id))
			{			   	
				echo json_encode(array("status"=>1));
			}
			else
			{
				echo json_encode(array("status"=>0));
			}
		}
		else
		{
			echo json_encode(array("status"=>2));
		}
  	}   

   	public function getCartList()
	{		
		$user_id = $_POST['user_id'];
		$cart_offset = $_POST['offset'];
		$cart_details = $this->category_model->getCartByUserId($user_id,$cart_offset);	
	   	$total_price='';
	    $total_qty = '';
	   	foreach ($cart_details as $c_value) 
	   	{
        	 $total_price = $total_price + $c_value->cart_sub_total;
			 $total_qty = $total_qty + $c_value->cart_product_qty;
		}
		//echo $total_price;die;
		if(!empty($cart_details))
		{
			echo json_encode(array("status"=>1, "cart_details"=>$cart_details , 
				"total_price"=>$total_price, "total_qty"=>$total_qty));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 
   	public function deleteCart()
	{
		$user_id = $_POST['user_id'];
		$cart_product_id = $_POST['product_id'];	        
		$delete_cart_list = $this->category_model->deleteCartByUserId($user_id,$cart_product_id);
		
		if(!empty($delete_cart_list))
		{	  
			 echo json_encode(array("status"=>1));		
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 
	public function updateCartQty()
	{	
		$post['cart_user_id'] = $_POST['user_id'];
		$post['cart_product_id'] = $_POST['product_id'];
    	$post['cart_product_qty'] = $_POST['cart_product_qty'];
    	$product_details = $this->category_model->productDetailByProductId($_POST['product_id']);
    	$cart_details = $this->category_model->getCartDetailsById($_POST['user_id'],$_POST['product_id']);
    	if(!empty($product_details) && $product_details[0]->product_qty >= $_POST['cart_product_qty'])
	    {
	    	foreach ($product_details as $cp_res) 
		    {
		    	$product_shipping_id = $cp_res->product_shipping_id;
		    }
	    	$post['cart_sub_total'] = $cart_details->cart_total_price*$_POST['cart_product_qty'];

	    	if($product_shipping_id)
		    {
	    		$shipping_details = $this->category_model->getShippingDetailsById($product_shipping_id);	    		
	    		if(!empty($shipping_details))
	    		{
					$post['shipping_name'] = $shipping_details->shipping_name;
					$post['shipping_type'] = $shipping_details->shipping_type;
					$post['shipping_value'] = $shipping_details->shipping_value;
					$post['shipping_multiply_type'] = $shipping_details->shipping_multiply_type;
					$post['shipping_multiply_value'] = $shipping_details->shipping_multiply_value;
					if($shipping_details->shipping_type == 'Fix')
					{
					 	$post['cart_sub_total'] = $post['cart_sub_total']+$shipping_details->shipping_value;
					}
					else if($shipping_details->shipping_type == 'Percent')
					{
					 	$post['cart_sub_total'] = $post['cart_sub_total']+($post['cart_sub_total'] * $shipping_details->shipping_value)/100;
					}	
					else if($shipping_details->shipping_type == 'multiply')
					{
						$qty = $_POST['cart_product_qty'];
						while($qty > 0)
						{
							$post['cart_sub_total'] = $post['cart_sub_total']+$shipping_details->shipping_value;
							$qty = $qty-$shipping_details->shipping_multiply_value;
						}				 	
					}					
	    		}
		    }
	    	$update_cart_list = $this->category_model->updateCartQty($post);			
			if(!empty($update_cart_list))
			{			
				echo json_encode(array("status"=>1));
			}
			else
			{
				echo json_encode(array("status"=>0));
			}
		}
		else
		{
			echo json_encode(array("status"=>2));
		}		
		
	} 
	/************************************* END CART ******************************************/

  	/************************************* END SOCIAL LOGIN ***********************************/
  	public function countryList()
  	{
  		$country_list = $this->category_model->getCountryList();
  		if(!empty($country_list))
		{
			echo json_encode(array("status"=>1, "country_list"=>$country_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
  	}
  	
  	public function stateList()
  	{
  		$country_id = $_POST['country_id'];
  		$state_list = $this->category_model->getStateList($country_id);
  		if(!empty($state_list))
		{
			echo json_encode(array("status"=>1, "state_list"=>$state_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
  	}

  	public function allPosUserList()
  	{
  		$user_type = $_POST['user_type']; //Retailer || Wholesaler  	
  		$offset = $_POST['offset'];	 		
  		$user_list = $this->category_model->getPosUserList($user_type,$offset);
  		if(!empty($user_list))
		{
			echo json_encode(array("status"=>1, "user_list"=>$user_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
  	}

	public function addSocialUser()
	{		
        $post['user_type'] = $_POST['user_type'];
        if(isset($_POST['pos_registration']) && $_POST['pos_registration'] == 1)
        {
	        if($post['user_type'] == 'Retailer')
	        {
	        	 $post['user_status'] = '0';
	        	 $post['user_status_type'] = 'Pending';
	        } 
	        else
	        {
	        	$post['user_status'] = $_POST['user_status'];	        	
	        	$post['user_status_type'] = $_POST['user_status_type'];//Approved || Pending
	        }

        }
        else
        {
        	$post['user_status'] = '0';
	       	$post['user_status_type'] = 'Pending';
        }
        $post['user_name'] = $_POST['name'];
        $post['user_email'] = $_POST['email'];
        $post['user_phone'] = $_POST['phone'];
        $post['user_password'] = $_POST['password'];
        $post['user_address_1'] = $_POST['address_1'];
        $post['user_address_2'] = $_POST['address_2'];
        $post['user_city'] = $_POST['city'];
        $post['user_state_id'] = $_POST['state_id'];
        $post['user_country_id'] = '99';
        $post['user_postal_code'] = $_POST['postal_code'];
        $post['shop_establishment_id'] = $_POST['shop_establishment_id'];
        $post['drug_licence'] = $_POST['drug_licence'];
        $post['gstn'] = $_POST['gstn'];
        $post['login_type'] = 'N';
        $post['user_created_date'] = date('Y-m-d');
	    $post['user_updated_date'] = date('Y-m-d');	    
	    $check['user_email'] = $_POST['email'];
	    $check['user_phone'] = $_POST['phone'];	
		$check_user = $this->category_model->checkSocialUser($check);
		if(empty($check_user))
  		{       
		 	$login_id = $this->category_model->addSocialUser($post);
		  	if(!empty($login_id))
			{
			  	echo json_encode(array("status"=>1, "user_id"=>$login_id, "user_email"=>$_POST['email'], "user_name"=>$_POST['name']));
			}
			else
			{
				echo json_encode(array("status"=>0));
			}
    	}
   		else
    	{
    		echo json_encode(array("status"=>2));
    	}
    	
    	}

    	public function login()
    	{
	    	$post['user_email_phone'] = $_POST['user_email_phone'];
	    	$post['user_password'] = $_POST['user_password'];
	    	$user_detail = $this->category_model->loginUser($post);
	    	if(!empty($user_detail))
			{
				if($user_detail[0]->user_status == 0 && $user_detail[0]->user_status_type == 'Pending')
				{
					echo json_encode(array("status"=>2));
				}
				else if($user_detail[0]->user_status == 2 && $user_detail[0]->user_status_type == 'Rejected')
				{
					echo json_encode(array("status"=>4));
				}
				else if($user_detail[0]->user_status == 3 && $user_detail[0]->user_status_type == 'Bloked')
				{
					echo json_encode(array("status"=>3));
				}
				else if($user_detail[0]->user_status == 1 && $user_detail[0]->user_status_type == 'Approved')
				{
					$post['user_id'] = $user_detail[0]->user_id;
					$post['user_log_status'] = 1;
					$this->category_model->updateloginStatus($post);
				  	echo json_encode(array("status"=>1,'user_details'=>$user_detail));
				}

			}
			else
			{
				echo json_encode(array("status"=>0));
			}
    	}

    	public function logout()
		{		
			$post['user_id'] = $_POST['user_id'];
			$post['user_log_status'] = 0; 
			$res = $this->category_model->updateloginStatus($post);
			if($res=='1')
			{
				echo json_encode(array("status"=>1)); 
			}
			else
			{
				echo json_encode(array("status"=>0)); 
			}
		}

		public function showProfile()
		{
			$user_id = $_POST['user_id']; 
			$user_detail = $this->category_model->showProfile($user_id);
			if(!empty($user_detail))
			{
				echo json_encode(array("status"=>1, "user_detail"=>$user_detail)); 
			}
			else
			{
				echo json_encode(array("status"=>0)); 
			}
		}

    	public function profile()
    	{  
	    	$post['user_id'] = $_POST['user_id'];       
	    	$post['user_name'] = $_POST['name'];       
	        $post['user_phone'] = $_POST['phone'];
	        $post['user_dob'] = $_POST['user_dob'];
	        $post['user_address_1'] = $_POST['address_1'];
	        $post['user_address_2'] = $_POST['address_2'];
	        $post['user_city'] = $_POST['city'];
	        $post['user_state_id'] = $_POST['state_id'];
	        $post['user_country_id'] = $_POST['country_id'];
	        $post['user_postal_code'] = $_POST['postal_code'];
		    $post['user_updated_date'] = date('Y-m-d');
	    	$user_update = $this->category_model->updateProfile($post);
	    	$user_detail = $this->category_model->showProfile($post['user_id']);
	    	if($user_update == 'true')
		{
		  	echo json_encode(array("status"=>1, "user_id"=>$user_detail[0]->user_id, "user_email"=>$user_detail[0]->user_email, "user_name"=>$user_detail[0]->user_name, "user_type"=>$user_detail[0]->user_type));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
    	}
	public function changePassword()
    	{
    		$post['user_id'] = $_POST['user_id'];       
    		$post['user_password'] = $_POST['user_password'];  
	    	$post['user_updated_date'] = date('Y-m-d');
    		$user_detail = $this->category_model->changePassword($post);

    		if($user_detail == 'true')
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
    	}
   	public function showUserAllAddress()
   	{
   		$user_id = $_POST['user_id'];       
   		$user_address_type = $_POST['user_address_type'];    
   		$user_address = $this->category_model->getUserAddress($user_id, $user_address_type);
    		
    		if($user_address)
		{
		  	echo json_encode(array("status"=>1, "user_address"=>$user_address));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

   	public function addUserAddress()
   	{
   		$post['user_id'] = $_POST['user_id'];       
   		$post['user_address_type'] = $_POST['user_address_type'];       
   		$post['user_address_name'] = $_POST['user_address_name'];       
   		$post['user_address_phone'] = $_POST['user_address_phone'];       
   		$post['user_address_mobile'] = $_POST['user_address_mobile'];       
   		$post['user_address_1'] = $_POST['user_address_1'];       
   		$post['user_address_2'] = $_POST['user_address_2'];       
   		$post['user_address_country_id'] = $_POST['user_address_country_id'];       
   		$post['user_address_state_id'] = $_POST['user_address_state_id'];       
   		$post['user_address_city'] = $_POST['user_address_city'];       
   		$post['user_address_postalcode'] = $_POST['user_address_postalcode'];  
    		$user_address = $this->category_model->addUserAddress($post);   
    		$aaa = $this->category_model->getUserAddressByAddressID($post['user_id'], $user_address); 

    		if($user_address)
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

   	public function setDefaultAddress()
   	{
   		$post['user_id'] = $_POST['user_id'];       
   		$post['user_address_id'] = $_POST['user_address_id'];
		$this->category_model->updateDefaultAddressStatusN($post);
		$user_address = $this->category_model->updateDefaultAddressStatusY($post);

    		if($user_address == 'true')
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

   	public function showDefaultAddress()
   	{
   		$user_id = $_POST['user_id'];          		
		$user_address = $this->category_model->showDefaultAddress($user_id);

    		if($user_address)
		{
		  	echo json_encode(array("status"=>1, "user_address"=>$user_address));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}

   	public function showUserAddressByAddressID()
   	{
   		$user_id = $_POST['user_id'];       
   		$user_address_id = $_POST['user_address_id'];       
    		$user_address = $this->category_model->getUserAddressByAddressID($user_id, $user_address_id);

    		if($user_address)
		{
		  	echo json_encode(array("status"=>1, "user_address"=>$user_address));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}
   	public function updateUserAddressByAddressID()
   	{
   		$post['user_id'] = $_POST['user_id'];       
   		$post['user_address_id'] = $_POST['user_address_id'];       
   		$post['user_address_name'] = $_POST['user_address_name'];       
   		$post['user_address_phone'] = $_POST['user_address_phone'];       
   		$post['user_address_mobile'] = $_POST['user_address_mobile'];       
   		$post['user_address_1'] = $_POST['user_address_1'];       
   		$post['user_address_2'] = $_POST['user_address_2'];       
   		$post['user_address_country_id'] = $_POST['user_address_country_id'];       
   		$post['user_address_state_id'] = $_POST['user_address_state_id'];       
   		$post['user_address_city'] = $_POST['user_address_city'];       
   		$post['user_address_postalcode'] = $_POST['user_address_postalcode'];  

    		$user_address = $this->category_model->updateUserAddressByAddressID($post);

    		if($user_address == 'true')
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}
   	public function deleteUserAddressByAddressID()
   	{
   		$post['user_id'] = $_POST['user_id'];       
   		$post['user_address_id'] = $_POST['user_address_id'];       
   		$user_address = $this->category_model->deleteUserAddressByAddressID($post);

    	if($user_address)
		{
		  	echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
   	}
	/****************************** END SOCIAL USER ***************************************/
	
	/****************************** START COUPAN ***************************************/	
	public function applyCouponCode()
	{
		$post['coupon_date'] = $_POST['coupon_date']; 
		$post['user_email'] = $_POST['user_email'];		
		$post['coupon_code'] = $_POST['coupon_code'];		           
       
       		$coupon_res = $this->category_model->applyCouponCode($post);
      
		if(!empty($coupon_res))
		{
			$status = $this->category_model->updateCouponCodeStatus($post);
			if($status == 'true')
			{
				echo json_encode(array("status"=>1, "coupon_res"=> $coupon_res));
			}
			else
			{
				echo json_encode(array("status"=>2));
			}			
		}
		else
		{
     	   		echo json_encode(array("status"=>0));
		}	 	
  	}
	/****************************** END COUPAN ***************************************/

	/****************************** Start Guest Checkout ***************************************/
	public function guestCheckOut()
	{
		$post['guest_user_name'] = $_POST['guest_user_name']; 
		$post['guest_user_email'] = $_POST['guest_user_email'];		
		//$post['guest_user_phone'] = $_POST['guest_user_phone'];		
		$post['guest_user_mobile'] = $_POST['guest_user_mobile'];		           		
		$post['guest_user_type'] = 'GU';		           		
		$post['guest_user_created_date'] = date('Y-m-d');		           
		$post['guest_user_updated_date'] = date('Y-m-d');	
		$guest_user_id = $this->category_model->addGuestUser($post);
		
		$post_address['guest_user_address_type'] = 'B';		           
		$post_address['guest_user_id'] = $guest_user_id; 
		$post_address['guest_user_address1'] = $_POST['guest_user_address1'];		           
		$post_address['guest_user_address2'] = $_POST['guest_user_address2'];		           
		$post_address['guest_user_city'] = $_POST['guest_user_city'];		           
		$post_address['guest_user_country_id'] = $_POST['guest_user_country_id'];		        
		$post_address['guest_user_state_id'] = $_POST['guest_user_state_id'];		           
		$post_address['guest_user_postal_code'] = $_POST['guest_user_postal_code'];	           
		$this->category_model->addGuestUserAddress($post_address);   

		$post_address['guest_user_address_type'] = 'D';		           
		$post_address['guest_user_id'] = $guest_user_id; 
		$post_address['guest_user_address1'] = $_POST['guest_user_address1_s'];		           
		$post_address['guest_user_address2'] = $_POST['guest_user_address2_s'];		           
		$post_address['guest_user_city'] = $_POST['guest_user_city_s'];		           
		$post_address['guest_user_country_id'] = $_POST['guest_user_country_id_s'];		        
		$post_address['guest_user_state_id'] = $_POST['guest_user_state_id_s'];		           
		$post_address['guest_user_postal_code'] = $_POST['guest_user_postal_code_s'];	           
		$this->category_model->addGuestUserAddress($post_address);    
       
		if(!empty($guest_user_id))
		{
			echo json_encode(array("status"=>1, "user_id"=> $guest_user_id, "user_type"=> $post['guest_user_type'], "user_email"=> $post['guest_user_email'], "user_name"=> $post['guest_user_name']));		
		}
		else
		{
     	   		echo json_encode(array("status"=>0));
		}	 	
  	}
  	
  	public function showGuestUserAddress()
  	{
  		$user_id = $_POST['user_id'];       		
   		$user_address = $this->category_model->getGuestUserAddress($user_id);
   		$user_detail = $this->category_model->getGuestUser($user_id);    		
    	if($user_address)
		{
		  	echo json_encode(array("status"=>1, "user_address"=>$user_address, "user_detail"=>$user_detail));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
  	}

	/*************************** END Guest Checkout ***************************/

	// POS Order Confirm 

	public function posOrderConfirmed()
	{	

		$order_details = json_decode($_POST['order_details']);
		$cart_details = json_decode($_POST['cart_details']);
		$user_detail = $this->category_model->getUserByID($order_details->order_user_id);
		$o_post['order_pay_type'] = $order_details->order_pay_type;	
		$o_post['unic_order_id'] = $order_details->unic_order_id;	
		$o_post['order_date_time'] = $order_details->order_date_time;	
		$o_post['order_subtotal'] = $order_details->order_subtotal;	
		$o_post['order_tax_total'] = $order_details->order_tax_total;	
		$o_post['order_discount_total'] = $order_details->order_discount_total;	
		$o_post['order_final_amt'] = $order_details->order_final_amt;
		$o_post['order_due_amount'] = $order_details->order_due_amount;		
		$o_post['order_user_type'] = $order_details->order_user_type;		
		$o_post['order_track_status'] = 'Delivered';
		$o_post['order_paid_amount'] = $order_details->order_paid_amount;
		$o_post['order_payment_status'] = 'done';
		$o_post['order_user_id'] = $order_details->order_user_id;
		$o_post['order_created_date'] = date('Y-m-d');
		$o_post['order_updated_date'] = date('Y-m-d');
		$order_id = $this->category_model->addOrder($o_post);

		// $unic_order_id = 'AT-'.substr(mt_rand(),0,5).'-'.$order_id;
  		//$this->category_model->updateOrderDetails($order_id,$unic_order_id);		
		if($o_post['order_due_amount'] > 0)
		{
			$u_post['user_due_balance'] = $user_detail->user_due_balance+$o_post['order_due_amount'];
			$this->category_model->updateUserDetails($order_details->order_user_id,$u_post);
		}
		$bs_post['user_id'] = $order_details->order_user_id;
		$bs_post['order_id'] = $order_id;
		$bs_post['order_total_amount'] = $order_details->order_final_amt;
		$bs_post['due_amount'] = $order_details->order_due_amount;
		$bs_post['paid_amount'] = $order_details->order_paid_amount;
		$this->category_model->addBalanceSheet($bs_post);
		foreach ($cart_details as $value) 
		{ 
			$c_post['cart_product_id'] = $value->cart_product_id;			
			$c_post['cart_product_qty'] = $value->cart_product_qty;			
			$c_post['cart_user_id'] = $value->cart_user_id;			
			$c_post['discount_value'] = $value->discount_value;			
			$c_post['discount_name'] = $value->discount_name;			
			$c_post['discount_type'] = $value->discount_type;			
			$c_post['tax_name'] = $value->tax_name;			
			$c_post['tax_value'] = $value->tax_value;			
			$c_post['main_price'] = $value->main_price;			
			$c_post['cart_total_price'] = $value->cart_total_price;			
			$c_post['cart_sub_total'] = $value->cart_sub_total;			
			$c_post['cart_created_date'] = date('Y-m-d');			
			$c_post['cart_checkout_status'] = '1';			
			$c_post['cart_status'] = '0';			
			$cart_id = $this->category_model->addCart($c_post);
			$op_post['cart_id'] = $cart_id;
			$op_post['order_id'] = $order_id;
			$op_post['product_id'] = $value->cart_product_id;
			$order_product_id = $this->category_model->addOrderProduct($op_post);
			$product_details = $this->category_model->posProductDetailById($value->cart_product_id);			
			if($value->cart_product_id != 19)
			{
				$product_qty =  $product_details[0]->product_qty-$value->cart_product_qty;
				$this->category_model->updateProductQty($value->cart_product_id,$product_qty);
			}

		}
		if($order_id)
		{
			echo json_encode(array("status"=>1));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}	
	}

	public function allTaxList()
	{
		$tax_list = $this->category_model->taxList();    		
    	if($tax_list)
		{
		  	echo json_encode(array("status"=>1, "tax_list"=>$tax_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	} 

	public function posLogin()
	{
    	$post['user_email_phone'] = $_POST['user_email_phone'];
    	$post['user_password'] = $_POST['user_password'];
    	$user_detail = $this->category_model->loginPosUser($post);
    	if(!empty($user_detail))
		{
			if($user_detail[0]->user_status == 0 && $user_detail[0]->user_status_type == 'Pending')
			{
				echo json_encode(array("status"=>2));
			}
			else if($user_detail[0]->user_status == 2 && $user_detail[0]->user_status_type == 'Rejected')
			{
				echo json_encode(array("status"=>4));
			}
			else if($user_detail[0]->user_status == 3 && $user_detail[0]->user_status_type == 'Bloked')
			{
				echo json_encode(array("status"=>3));
			}
			else if($user_detail[0]->user_status == 1 && $user_detail[0]->user_status_type == 'Approved')
			{
				$post['user_id'] = $user_detail[0]->user_id;
				$post['user_log_status'] = 1;
				$this->category_model->updateloginStatus($post);
			  	echo json_encode(array("status"=>1,'user_details'=>$user_detail));
			}

		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	}

	public function dueUserOrderAmout()
	{
		$user_id = $_POST['user_id'];
		$offset = $_POST['offset'];
		$due_order_list = $this->category_model->getDueUserOrder($user_id,$offset); 
		if($due_order_list)
		{
		  	echo json_encode(array("status"=>1, "due_order_list"=>$due_order_list));
		}
		else
		{
			echo json_encode(array("status"=>0));
		}
	}

	public function crDueUserAmout()
	{		

		if (isset($_POST['cr_amount_with_order'])) 
		{
			$list_array = json_decode($_POST['cr_amount_with_order']);
			$total_due_amount = 0;		
			foreach ($list_array as $cr_res) 
			{
				$order_id  = $cr_res->order_id;
				$user_id  = $cr_res->user_id;
				$prv_due_amt = $this->category_model->getPrvDueAmountById($order_id,$user_id);
				if(!empty($prv_due_amt) && $prv_due_amt->due_amount > 0)
				{					
					$post['user_id'] = $cr_res->user_id;
					$post['order_id'] = $cr_res->order_id;
					$post['order_total_amount'] = $prv_due_amt->order_total_amount;
					$post['paid_amount'] = $prv_due_amt->due_amount;
					$post['due_amount'] = 0;
					$total_due_amount = $total_due_amount + $prv_due_amt->due_amount;
					$this->category_model->addBalanceSheet($post);
				}
			}
			$u_post['user_due_balance'] = $total_due_amount;
			$update_amt = $this->category_model->updateUserDetails($user_id,$u_post);
			if($update_amt)
			{
			  	echo json_encode(array("status"=>1));
			}
			else
			{
				echo json_encode(array("status"=>0));
			}
		}
		else if(isset($_POST['cr_amount']))
		{
			$list_array = json_decode($_POST['cr_amount']); 
			foreach ($list_array as $cr_res) 
			{				
				$user_id  = $cr_res->user_id;
				$all_due_amt = $this->category_model->getDueUserOrder($user_id);
				$cr_amt = $cr_res->cramount;
				$temp_amt = $cr_amt;
				$temp_amt1= 0;
				foreach ($all_due_amt as $due_res) 
				{
					//print_r($all_due_amt); die;			
					$temp_amt1 = $temp_amt - $due_res->due_amount;
					if($temp_amt1 >= 0)
					{
						$post['user_id'] = $user_id;
						$post['order_id'] = $due_res->order_id;
						$post['order_total_amount'] = $due_res->order_total_amount;
						$post['paid_amount'] = $due_res->due_amount;
						$post['due_amount'] = 0;				
						$this->category_model->addBalanceSheet($post);
					}

					if($temp_amt1 < 0)
					{
						$post['user_id'] = $user_id;
						$post['order_id'] = $due_res->order_id;
						$post['order_total_amount'] = $due_res->order_total_amount;
						$post['paid_amount'] = $temp_amt;
						$post['due_amount'] = $due_res->due_amount - $temp_amt;
						$this->category_model->addBalanceSheet($post);
						break;
					}
					$temp_amt = $temp_amt1;
					//if($cr_amt)
				}				
			}
			$u_post['user_due_balance'] = $cr_amt;
			$update_amt = $this->category_model->updateUserDetails($user_id,$u_post);
			if($update_amt)
			{
			  	echo json_encode(array("status"=>1));
			}
			else
			{
				echo json_encode(array("status"=>0));
			}
		}
		
	}



/* End of file */
}
?>