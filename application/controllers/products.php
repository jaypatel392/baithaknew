<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Products extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/products_model');
                 
	}
	
	public function productsBycategories()
	{
		$cat_id = $this->uri->segment(3);
		$config = array();
		$config["base_url"] = base_url() . "products/productsBycategories/".$cat_id;
		$config["total_rows"] = $this->products_model->getRecord_countProduct($cat_id);
		$config["per_page"] = 12;
		$config["uri_segment"] = 4;		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		$this->data["page_links"] = $this->pagination->create_links();
		$this->data['productsBycat'] = $this->products_model->getProductByCategoryId($config["per_page"],$page,$cat_id);		
	   	$this->data['categories'] = $this->products_model->getAllcategories();
        $this->data['newProduct'] = $this->homepage_model->getNewProduct();	
		$this->show_view_front('front/products',$this->data);		

		
    }

    public function getProductsByCatId()
	{
		$cat_id = $this->input->post('cat_id');
		$config = array();
		$config["base_url"] = base_url() . "products/productsBycategories/".$cat_id;
		$config["total_rows"] = $this->products_model->getRecord_countProduct($cat_id);
		$config["per_page"] = 12;
		$config["uri_segment"] = 4;		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		$page_links = $this->pagination->create_links();
		$products_res = $this->products_model->getProductByCategoryId($config["per_page"],$page,$cat_id);		
	   
	   	$html = '';
	   	if(!empty($products_res))
	   	{
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';		
			foreach ($products_res as $value)
			{
				$html .= '<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2"><img src="'.$value->product_thumb_img.'" alt=" " class="img-responsive" />';

				$products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
				foreach ($products_imgs as $valueImg)
				{
					$html .= '<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
				}
				$html .= '<div class="w3_hs_bottom w3_hs_bottom_sub1"></div></div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"> '.substr($value->product_title,0,19).'</a></h5><div class="simpleCart_shelfItem"><p><i class="item_price">';
			    
				//Get value of product Discount
				$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);
				$productAttributes = $this->products_model->getProductAttributes($value->product_id);

				if(!empty($discount_list))
				{

					foreach ($discount_list as $des_value)
					{

						if($des_value->discount_type == "Percent")
						{
						 	$html .= '<span style="text-decoration: none;">$des_value->discount_value% Off</span>';
						}else{
							
							$html .= '<span>Rs $des_value->discount_value </span>';
						} 
						$html .= '<i class="item_price">';	

						if($des_value->discount_type == "Percent")
						{

							if($value->product_sale_price == 0){

								$html .= 'Rs '.$discount_price = $product_totel_price - ($aproduct_price * ($des_value->discount_value / 100)).'';
							}
							else
							{
								$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - ($productDetail[0]->product_sale_price * ($des_value->discount_value / 100)).'';
							}


						}else{

							if($productDetail[0]->product_sale_price == 0)
							{

								$html .= ' Rs '.$discount_price = $product_totel_price - $des_value->discount_value.'';
							}
							else
							{

								$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - $des_value->discount_value.' ';
							}     

						}
					} //discount loop end

				}
				else
				{

					if($value->product_sale_price == 0)
					{

						if(!empty($productAttributes))
						{
							$totel_min_price ='';

							$attr_min_value = $this->products_model->getAttrvalueMinPrice($productAttributes[0]->attr_id);

							$attr_max_value = $this->products_model->getAttrvalueMaxPrice($productAttributes[0]->attr_id); 
							$html .= 'Rs '.$attr_min_value[0]->attr_min_price.' - '.$attr_max_value[0]->attr_max_price .' ';
						}
						else
						{
							$html .= 'Rs '.$value->product_sale_price.' ';
						}	
					}
					else
					{
						$html .= 'Rs '.$value->product_sale_price.' ';
					}
				}
				$html .= '</i></p>';								  
				$cart_details = $this->cart->contents();
				$check_cart = 0;
				foreach ($cart_details as $cart_value) 
				{
					if($cart_value['id'] == $value->product_id)
					{
						$check_cart++;
				    }
				}
				if($check_cart)
				{
					$html .= '<a href="'.base_url().'products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';	
				}
				else
				{	 
					$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"><button type="button" class="w3ls-cart">Add to cart</button></a>';
				}
				$html .= '</div><div class="mobiles_grid_pos"><h6>New</h6></div></div><br><br><br></div>';
			}
				
			$html .= '<div class="clearfix"> </div><div style="float: right; font-size: 17px;">'.$page_links.'</div></div>';
			 echo $html;
		}
	}

  	public function getProductsByCatIdAndPrice()
  	{

		$cat_id = $this->input->post('cat_id');
		$min_price = $this->input->post('min_price');
		$max_price = $this->input->post('max_price');
		$config = array();
		$config["base_url"] = base_url() . "products/productsBycategories/".$cat_id;
		$config["total_rows"] = $this->products_model->getRecord_countProduct($cat_id);
		$config["per_page"] = 12;
		$config["uri_segment"] = 4;		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		$page_links = $this->pagination->create_links();
		$products_res = $this->products_model->getProductByCategoryIdAndPrice($config["per_page"],$page,$cat_id,$min_price,$max_price);	
	   	$html = '';
	   	if(!empty($products_res)){
		$html .= '<div class="w3ls_mobiles_grid_right_grid3">';		
		foreach ($products_res as $value) {
			$html .= '<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"><div class="hs-wrapper hs-wrapper2">';
			$products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
			foreach ($products_imgs as $valueImg) {
			$html .= '<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
			}
			$html .= '</div></a><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"> '.substr($value->product_title,0,19).'</a></h5><div class="simpleCart_shelfItem"><p><i class="item_price">';
		    
			//Get value of product Discount
			$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);
			$productAttributes = $this->products_model->getProductAttributes($value->product_id);

			if(!empty($discount_list)){

				foreach ($discount_list as $des_value){

					if($des_value->discount_type == "Percent")
					{
					 	$html .= '<span style="text-decoration: none;">$des_value->discount_value% Off</span>';
					}else{
						
						$html .= '<span>Rs $des_value->discount_value </span>';
					} 
					$html .= '<i class="item_price">';	

					if($des_value->discount_type == "Percent"){

						if($value->product_sale_price == 0){

						$html .= 'Rs '.$discount_price = $product_totel_price - ($aproduct_price * ($des_value->discount_value / 100)).'';
						}else{
						$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - ($productDetail[0]->product_sale_price * ($des_value->discount_value / 100)).'';
						}


					}else{

						if($productDetail[0]->product_sale_price == 0){

						$html .= ' Rs '.$discount_price = $product_totel_price - $des_value->discount_value.'';
						}else{

						$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - $des_value->discount_value.' ';
						}     

				}
			}
			//discount loop end

			}else{

				if($value->product_sale_price == 0){

					if(!empty($productAttributes)){
						$totel_min_price ='';

						$attr_min_value = $this->products_model->getAttrvalueMinPrice($productAttributes[0]->attr_id);

						$attr_max_value = $this->products_model->getAttrvalueMaxPrice($productAttributes[0]->attr_id); 
						$html .= 'Rs '.$attr_min_value[0]->attr_min_price.' - '.$attr_max_value[0]->attr_max_price .' ';
					}
					else
					{
						$html .= 'Rs '.$value->product_sale_price.' ';
					}	
				}
				else
				{
					$html .= 'Rs '.$value->product_sale_price.' ';
				}
			}
			$html .= '</i></p>';								  
			$cart_details = $this->cart->contents();
			$check_cart = 0;
			foreach ($cart_details as $cart_value) 
			{
				if($cart_value['id'] == $value->product_id)
				{
					$check_cart++;
			    }
			}
			if($check_cart)
			{
				$html .= '<a href="'.base_url().'products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';	
			}
			else
			{	 
				$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"><button type="button" class="w3ls-cart">Add to cart</button></a>';
			}
				$html .= '</div><div class="mobiles_grid_pos"><h6>New</h6></div></div><br><br><br></div>';
			}
				
			$html .= '<div class="clearfix"> </div><div style="float: right; font-size: 17px;">'.$page_links.'</div></div>';

			 echo $html;		 
		}

	}


public function getsortedProducts(){
	//print_r($_POST);die();
	$cat_id = $this->input->post('cat_id');
		$config = array();
		$config["base_url"] = base_url() . "products/productsBycategories/".$cat_id;
		$config["total_rows"] = $this->products_model->getRecord_countProduct($cat_id);
		$config["per_page"] = 12;
		$config["uri_segment"] = 4;		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : '';
		$page_links = $this->pagination->create_links();
		$products_res = $this->products_model->getProductByCategoryId($config["per_page"],$page,$cat_id);		
	   
	   	// echo "<pre>";
	   	// print_r($products_res); die;
	   	$html = '';
	   	if(!empty($products_res)){
		$html .= '<div class="w3ls_mobiles_grid_right_grid3">';		
		foreach ($products_res as $value) {
			$html .= '<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2">';
			$products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
			foreach ($products_imgs as $valueImg) {
			$html .= '<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
			}
			$html .= '</div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"> '.substr($value->product_title,0,19).'</a></h5><div class="simpleCart_shelfItem"><p><i class="item_price">';
		    
			//Get value of product Discount
			$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);
			$productAttributes = $this->products_model->getProductAttributes($value->product_id);

			if(!empty($discount_list)){

				foreach ($discount_list as $des_value){

					if($des_value->discount_type == "Percent")
					{
					 	$html .= '<span style="text-decoration: none;">$des_value->discount_value% Off</span>';
					}else{
						
						$html .= '<span>Rs $des_value->discount_value </span>';
					} 
					$html .= '<i class="item_price">';	

					if($des_value->discount_type == "Percent"){

						if($value->product_sale_price == 0){

						$html .= 'Rs '.$discount_price = $product_totel_price - ($aproduct_price * ($des_value->discount_value / 100)).'';
						}else{
						$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - ($productDetail[0]->product_sale_price * ($des_value->discount_value / 100)).'';
						}


					}else{

						if($productDetail[0]->product_sale_price == 0){

						$html .= ' Rs '.$discount_price = $product_totel_price - $des_value->discount_value.'';
						}else{

						$html .= 'Rs '.$discount_price = $productDetail[0]->product_sale_price - $des_value->discount_value.' ';
						}     

				}
			}
			//discount loop end

			}else{

				if($value->product_sale_price == 0){

					if(!empty($productAttributes)){
						$totel_min_price ='';

						$attr_min_value = $this->products_model->getAttrvalueMinPrice($productAttributes[0]->attr_id);

						$attr_max_value = $this->products_model->getAttrvalueMaxPrice($productAttributes[0]->attr_id); 
						$html .= 'Rs '.$attr_min_value[0]->attr_min_price.' - '.$attr_max_value[0]->attr_max_price .' ';
					}
					else
					{
						$html .= 'Rs '.$value->product_sale_price.' ';
					}	
				}
				else
				{
					$html .= 'Rs '.$value->product_sale_price.' ';
				}
			}
			$html .= '</i></p>';								  
			$cart_details = $this->cart->contents();
			$check_cart = 0;
			foreach ($cart_details as $cart_value) {
				if($cart_value['id'] == $value->product_id)
				{
					$check_cart++;
			    }
			}
			if($check_cart)
			{
				$html .= '<a href="'.base_url().'products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';	
			}
			else
			{	 
				$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"><button type="button" class="w3ls-cart">Add to cart</button></a>';
			}
			$html .= '</div><div class="mobiles_grid_pos"><h6>New</h6></div></div><br><br><br></div>';
			}
				
			$html .= '<div class="clearfix"> </div><div style="float: right; font-size: 17px;">'.$page_links.'</div></div>';

			 echo $html;
		 
	}
  }


	public function viewCart(){
		
		if(isset($_POST['checkout'])){ 

				$cart_product_list = $this->cart->contents();
				$session = $this->session->all_userdata(); 
				
				foreach ($cart_product_list as $cart_res) 
				{

					$post['cart_product_id'] = $cart_res['id'];
					$post['cart_user_id'] = $session[0]->user_id;
					$post['cart_product_qty'] = $cart_res['qty'];
					$post['cart_discount_price'] = $cart_res['price'];
					$post['crt_attr_id'] = $cart_res['attr'];
					$post['cart_total_price'] = $this->cart->total();
					$post['cart_created_date'] = date('Y-m-d');
					

					$add_cart_res = $this->products_model->addCartproducts($post);
					if($add_cart_res){

						if(!empty($cart_res['attr'])){

							$a = explode(',', $cart_res['attr']);

							for ($i=0; $i < count($a); $i++) {
								$b = explode('_', $a[$i]);
								$attr_post['cart_id'] = $add_cart_res;          	
								$attr_post['cart_product_attr_id'] = $b[0];          	
								$attr_post['cart_product_attr_val_name'] = $b[1];
								$attr_post['cart_product_id'] =  $cart_res['id'];       	
								$attr_post['cart_attr_user_id'] = $session[0]->user_id;
								$add_cart_attr_res = $this->products_model->addCartproductsAttr($attr_post);  

						    }
						  }
					}

				}
				if($add_cart_res){
				  redirect(base_url().'products/userAddressDetails');				
				}   
		}else{

			$this->data['cart_list'] = $this->cart->contents();

			$this->show_view_front('front/viewcart',$this->data);
		}

	}
       public function removeCartItem(){

      	$cart_id = $this->input->post('cart_id');
      	$data = array(
				'rowid'   => $cart_id,
				'qty'     => 0
			);

			echo $removeres =$this->cart->update($data);
      }

      public function updateCartProductqty(){

      	$cart_id = $this->input->post('cart_id');
      	$qty_value = $this->input->post('qty_value');
      	$data = array(
				'rowid'   => $cart_id,
				'qty'     => $qty_value
			);
      	 echo $update_qty =$this->cart->update($data);
      }
      
      public function userAddressDetails()
      {


      			$session = $this->session->all_userdata();       		
      			require('application/config/razor_config.php');
				require('application/libraries/razorpay-php/Razorpay.php');				
				$api = new Api($keyId, $keySecret);

				
				$orderData = [
				'receipt'         => time(),
				'amount'          => $this->cart->total() * 100, // 2000 rupees in paise
				'currency'        => 'INR',
				'payment_capture' => 1 // auto capture
				];

				$razorpayOrder = $api->order->create($orderData);

				$razorpayOrderId = $razorpayOrder['id'];
				$session_data = $this->session->userdata('order_confirm');
				$session_data['razorpay_order_id'] = $razorpayOrderId;
				$this->session->set_userdata("order_confirm", $session_data);
				//$_SESSION['razorpay_order_id'] = $razorpayOrderId;

				$displayAmount = $amount = $orderData['amount'];

				if ($displayCurrency !== 'INR')
				{
					$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
					$exchange = json_decode(file_get_contents($url), true);

					$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
				}

				$checkout = 'automatic';
				$data = [
				"key"               => $keyId,
				"amount"            => $amount,
				"name"              => $session[0]->user_name,				
				"image"             => "http://localhost/partyShaarty/webroot/front/images/logo2.png",
				"prefill"           => [
				"name"              => $session[0]->user_name,
				"email"             => $session[0]->user_email,
				"contact"           => $session[0]->user_phone,
				],
				"theme"             => [
				"color"             => "#FF0000"
				],
				"order_id"          => $razorpayOrderId,
				];

				if ($displayCurrency !== 'INR')
				{
					$data['display_currency']  = $displayCurrency;
					$data['display_amount']    = $displayAmount;
				}

				$this->data['data'] = $data;

      			$this->data['user_details'] = $this->products_model->getUserDetailsById($session[0]->user_id);
      			$this->data['country_list'] = $this->products_model->getCountryList();
      			$this->data['user_defaultdel_address_details'] = $this->products_model->getUserDefultDeleveryAddres($session[0]->user_id);      			
      			$this->data['all_delivery_address'] = $this->products_model->getALLDeleveryAddres($session[0]->user_id);
      			$this->data['all_billing_address'] = $this->products_model->getAllBillingAdresses($session[0]->user_id);

      			$this->data['user_defaultbil_address_details'] = $this->products_model->getUserDefultBillingAddres($session[0]->user_id);
      			//print_r($this->data['user_defaultbil_address_details']); die;
      			
      			$this->show_view_front('front/user_address_details' , $this->data);

      		
      }

	public function verifyPayment()
	{

			require('application/config/razor_config.php');
			require('application/libraries/razorpay-php/Razorpay.php');	
			
			$success = true;
			$session = $this->session->all_userdata(); 
			$error = "Payment Failed";
			if (empty($_POST['razorpay_payment_id']) === false)
			{
				$api = new Api($keyId, $keySecret);

					try
					{
						
						$attributes = array(
						'razorpay_order_id' => $session['order_confirm']['razorpay_order_id'],
						'razorpay_payment_id' => $_POST['razorpay_payment_id'],
						'razorpay_signature' => $_POST['razorpay_signature']
						);

						$api->utility->verifyPaymentSignature($attributes);
					}
					catch(SignatureVerificationError $e)
					{
						$success = false;
						$error = 'Razorpay Error : ' . $e->getMessage();
					}
			}

			if ($success === true)
			{

				$del_addrs = $this->products_model->getUserDefultDeleveryAddres($session[0]->user_id);     
				$bill_addrs = $this->products_model->getUserDefultBillingAddres($session[0]->user_id);
				date_default_timezone_set("asia/kolkata");
    			$post['order_date_time'] = date('Y-m-d h:i:s');       
				$post['order_pay_type'] = 'online';
				$post['order_tansaction_id'] = $this->input->post('razorpay_payment_id');       
				$post['order_payment_status'] = 'success';       
				$post['order_user_type'] = 'registered';       
				$post['order_user_id'] = $session[0]->user_id;       
				$post['order_user_d_address_id'] = $del_addrs[0]->user_address_id;    

				$post['order_user_b_address_id'] = $bill_addrs[0]->user_address_id;
				$address_details = $this->products_model->getdelAddressById($post['order_user_d_address_id']);

				$order_id = $this->products_model->addOrder($post);
				if(!empty($order_id))
				{
					$unic['unic_order_id'] = $unique_id = time().$this->data['user_id'].$order_id;
					$unic['order_id'] = $order_id;
					$unnic_id = $this->products_model->updateOrderUnicId($unic);
					$ord_status['order_id'] = $order_id;
					$ord_status['order_unic_id'] = $unic['unic_order_id'];
					$ord_status['order_user_id'] = $this->data['user_id'];
					$ord_status['order_status'] = 0;
					$ord_status['order_status_created_date'] = date('Y-m-d');
					$ord_status['order_status_update_date'] = date('Y-m-d');
					$ord_status_id = $this->products_model->addOrderStatus($ord_status);
					$cart_list = $this->cart->contents();
					foreach ($cart_list as $crt_val)
					{	
						$p_post['order_id'] = $order_id;
						$p_post['product_id'] = $crt_val['id'];
						$p_post['product_attr_id'] = $crt_val['attr'];
						$order_product_id = $this->products_model->addOrderProduct($p_post);
					}
					if(!empty($order_product_id))
					{
						
						$this->cart->destroy();
						$message1 = '';
						$message2 = '';
						$subject1 = 'Party Shaarty Order';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$mail1 = $this->send_mail($session[0]->user_email, $subject1, $message1);	
						$message1 = 'Your Order id '.$unic['unic_order_id'];
						$subject2 = 'Party Shaarty Order';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$message2 .= 'Thankyou! Your Order Confirm successfully!';
						$mail2 = $this->send_mail($address_details[0]->user_address_email, $subject2, $message2); 						
							redirect(base_url().'products/orders');								
						
					}	
				}
				
			}
			else
			{
				$html = "<p>Your payment failed</p>
				<p>{$error}</p>";
			}
			
	}   
    
    public function codOrderConfirm()
    {
    	$generate_order_id  = hash('sha256', microtime() );
    	$session = $this->session->all_userdata();
    	$del_addrs = $this->products_model->getUserDefultDeleveryAddres($session[0]->user_id);     
				$bill_addrs = $this->products_model->getUserDefultBillingAddres($session[0]->user_id);
				date_default_timezone_set("asia/kolkata");
    			$post['order_date_time'] = date('Y-m-d h:i:s');       
				$post['order_pay_type'] = 'cod';
				$post['order_tansaction_id'] = $generate_order_id;       	
				$post['order_payment_status'] = 'success';       
				$post['order_user_type'] = 'registered';       
				$post['order_user_id'] = $session[0]->user_id;       
				$post['order_user_d_address_id'] = $del_addrs[0]->user_address_id;       
				$post['order_user_b_address_id'] = $bill_addrs[0]->user_address_id;
				$order_id = $this->products_model->addOrder($post);
				if(!empty($order_id))
				{
					$unic['unic_order_id'] = $unique_id = time().$this->data['user_id'].$order_id;
					$unic['order_id'] = $order_id;
					$unnic_id = $this->products_model->updateOrderUnicId($unic);
					$ord_status['order_id'] = $order_id;
					$ord_status['order_unic_id'] = $unic['unic_order_id'];
					$ord_status['order_user_id'] = $this->data['user_id'];
					$ord_status['order_status'] = 0;
					$ord_status['order_status_created_date'] = date('Y-m-d');
					$ord_status['order_status_update_date'] = date('Y-m-d');
					$ord_status_id = $this->products_model->addOrderStatus($ord_status);
					$cart_list = $this->cart->contents();
					
					foreach ($cart_list as $crt_val)
					{	
						$p_post['order_id'] = $order_id;
						$p_post['product_id'] = $crt_val['id'];	
						$p_post['product_attr_id'] = $crt_val['attr'];	
						$order_product_id = $this->products_model->addOrderProduct($p_post);
					}
						$this->cart->destroy();
						$message1 = '';
						$message2 = '';
						$subject1 = 'Party Shaarty Order';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$mail1 = $this->send_mail($session[0]->user_email, $subject1, $message1);	
						$message1 = 'Your Order id '.$unic['unic_order_id'];
						$subject2 = 'Party Shaarty Order';
						$message1 .= 'Thankyou! Your Order Confirm successfully!';
						$message2 .= 'Thankyou! Your Order Confirm successfully!';
						$mail2 = $this->send_mail($address_details[0]->user_address_email, $subject2, $message2);
						
							redirect(base_url().'products/orders');
													

 			   }
}

    /* Get State List */
	public function getStateList()
	{
		$country_id = $this->input->post('country_id');
		$state_list = $this->products_model->getStateListByCountryId($country_id);

		$html = '';
		if(count($state_list) > 0)
		{
			foreach ($state_list as $s_list) 
			{
				$html .= '<option value="'.$s_list->state_id.'">'.$s_list->state_name.'</option>';
			}
			
			echo $html; 
		}
		else
		{
			echo $html;
		}
	}

     public function searchProductByBrand()
	{
		$brand_id = $this->uri->segment(3);
	 	  	$this->data['productsBybrand'] = $this->products_model->getProductBybrandId($brand_id);
	 	$this->data['brands'] = $this->products_model->getAllbrands();
	 	  	//echo '<pre>';
	   	//print_r($this->data['productsBybrand']);die();
		$this->show_view_front('front/productsBybrand',$this->data);
		

		
    }


   public function getProductsByBrandIdAndPrice()
   {
		//print_r($_POST);die();
		$brand_id = $this->input->post('brand_id');
		$min_price = $this->input->post('min_price');
		$max_price = $this->input->post('max_price');
		$products = $this->products_model->getProductByBrandIdAndPrice($brand_id,$min_price,$max_price);		
		$html ='';
	    if(!empty($products)){
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';
	   	        foreach ($products as $value) {
					$html .='<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2">';
						 $products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
						foreach ($products_imgs as $valueImg) { 
						$html .='<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
						} 
						$html .= '<div class="w3_hs_bottom w3_hs_bottom_sub1"><ul><li><a href="#" data-toggle="modal" data-target="#myModal9"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></li></ul></div></div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'">'.$value->product_title.'</a></h5> <div class="simpleCart_shelfItem"><p><i class="item_price">Rs '.$value->product_sale_price.'</i></p>';
														  
						$cart_details = $this->cart->contents();
						$check_cart=0;
						foreach ($cart_details as $cart_value) {
						if($cart_value['id'] == $value->product_id){
						$check_cart++;
						}
						}
						if($check_cart){
						
						$html .= '<a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';
						}else{
					
						$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.';?>" ><button type="button" class="w3ls-cart">Add to cart</button></a>';
						
						}
										

						$html .= '</div></div></div>';
				}
					
					$html .= '<div class="clearfix"> </div>
				</div>';
				 echo $html;
			}else{
			echo $html;
		}
	}

public function getProductByCity()
{
	$city_name = $this->input->post('city_name');
	$products = $this->products_model->getProductByCity($city_name);
		$html ='';
		
			 if(!empty($products)){
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';
	   	        foreach ($products as $value) {
					$html .='<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2">';
						 $products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
						foreach ($products_imgs as $valueImg) { 
						$html .='<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
						} 
						$html .= '<div class="w3_hs_bottom w3_hs_bottom_sub1"><ul><li><a href="#" data-toggle="modal" data-target="#myModal9"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></li></ul></div></div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'">'.$value->product_title.'</a></h5> <div class="simpleCart_shelfItem"><p><i class="item_price">Rs '.$value->product_sale_price.'</i></p>';
														  
						$cart_details = $this->cart->contents();
						$check_cart=0;
						foreach ($cart_details as $cart_value) {
						if($cart_value['id'] == $value->product_id){
						$check_cart++;
						}
						}
						if($check_cart){
						
						$html .= '<a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';
						}else{
					
						$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.';?>" ><button type="button" class="w3ls-cart">Add to cart</button></a>';
						
						}
										

						$html .= '</div></div></div>';
				}
					
					$html .= '<div class="clearfix"> </div>
				</div>';
				 echo $html;
			}else{
			echo $html;
		}

}

public function getsortedProductsbyBrand(){
	
	$sortBy = $this->input->post('sortingBy');
	$brand_id = $this->input->post('brand_id');
	$products = $this->products_model->getsortedProductsbyBrand($brand_id,$sortBy);
		$html ='';
		
			 if(!empty($products)){
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';
	   	        foreach ($products as $value) {
					$html .='<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2">';
						 $products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
						foreach ($products_imgs as $valueImg) { 
						$html .='<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
						} 
						$html .= '<div class="w3_hs_bottom w3_hs_bottom_sub1"><ul><li><a href="#" data-toggle="modal" data-target="#myModal9"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></li></ul></div></div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'">'.$value->product_title.'</a></h5> <div class="simpleCart_shelfItem"><p><i class="item_price">Rs '.$value->product_sale_price.'</i></p>';
														  
						$cart_details = $this->cart->contents();
						$check_cart=0;
						foreach ($cart_details as $cart_value) {
						if($cart_value['id'] == $value->product_id){
						$check_cart++;
						}
						}
						if($check_cart){
						
						$html .= '<a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>';
						}else{
					
						$html .= '<a href= "'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.';?>" ><button type="button" class="w3ls-cart">Add to cart</button></a>';
						
						}
										

						$html .= '</div></div></div>';
				}
					
					$html .= '<div class="clearfix"> </div>
				</div>';
				 echo $html;
			}else{
			echo $html;
		}
     }

      /*chekout cart area */

     public function getAlldeleveryAdresses()
     {

     	$userId = $this->input->post('user_id');
     	$adressId = $this->input->post('address_id');
     	$allDelAdress = $this->products_model->getAlldeleveryAdresses($userId,$adressId);
     	$html = '';
     	$html .= '<input type="button" name="next" class="next action-button" value="Add New" id ="addNewDelForm" onclick="openToogleDelFrom()"/>';
     	if($allDelAdress){

     		foreach ($allDelAdress as $delAddress) {
     			$user_country = $this->products_model->getCountryName($delAddress->user_address_country_id);
     			$user_state = $this->products_model->getStateName($delAddress->user_address_state_id);

     			$html  .= "";
     			$html .= '<div class ="col-md-6">'.$delAddress->user_address_1. ','.$delAddress->user_address_2. ','.$delAddress->user_address_city.' ,'.$user_state[0]->state_name.', '.$user_country[0]->country_name.' ,'.$delAddress->user_address_postalcode;
     			$html .= '<br><a href ="javascript:void()" onclick ="setDelfaultdeladd 	(this.id,'.$userId.')" class ="setdeladdrs" id ="'.$delAddress->user_address_id.'">Set Default Adress</a></div>';
     			 		}
     	}

     	else{

     		$html .= '<Not Any Other Adress Found>';
     	}

     	print_r($html);

     }

  public function addNewDeliveryAddress()
  {  

  		$session = $this->session->all_userdata();
    	$post['user_address_type'] = 'D';
    	$post['user_id'] = $session[0]->user_id;
    	$removeDefaut = $this->products_model->removeDefultsdelAdress($post['user_id']);
     	if($removeDefaut)
     	{
	    	$post['user_address_name'] = $this->input->post('user_fname').' '.$this->input->post('user_lname');
	    	$post['user_address_phone'] = $this->input->post('user_phone');
	    	$post['user_address_email'] = $this->input->post('user_email_id');
	    	$post['user_address_country_id'] = $this->input->post('user_country');
	    	$post['user_address_state_id'] = $this->input->post('user_state');
	    	$post['user_address_city'] = $this->input->post('user_city');
	    	$post['user_address_postalcode'] = $this->input->post('usre_postal_code');
	    	$post['user_address_1'] = $this->input->post('user_address_line_1');
	    	$post['user_address_2'] = $this->input->post('user_address_2');    	
	    	$post['user_address_default'] = 1; 
	    	$del_res = $this->products_model->addNewAddress($post);
	    	echo $del_res;
	    }
  }

  public function addNewBillingAddress()
  {  
  		$session = $this->session->all_userdata();
    	$post['user_address_type'] = 'B';
    	$post['user_id'] = $session[0]->user_id;
    	$check_same_bill_addrs = '';
    	if(isset($_POST['user_address_id']))
    	{
    		$post['same_as_delivery_address'] = $this->input->post('user_address_id');
    		$check_same_bill_addrs = $this->products_model->checkSameBillingAddress($post['user_id'],$post['same_as_delivery_address']);
    	}
    	
     	if($check_same_bill_addrs == false)
     	{
	    	$removeDefaut = $this->products_model->removeDefultsbillAdress($post['user_id']);
	     	if($removeDefaut)
	     	{
		    	$post['user_address_name'] = $this->input->post('user_fname').' '.$this->input->post('user_lname');
		    	$post['user_address_phone'] = $this->input->post('user_phone');
		    	$post['user_address_email'] = $this->input->post('user_email_id');
		    	$post['user_address_country_id'] = $this->input->post('user_country');
		    	$post['user_address_state_id'] = $this->input->post('user_state');
		    	$post['user_address_city'] = $this->input->post('user_city');
		    	$post['user_address_postalcode'] = $this->input->post('usre_postal_code');
		    	$post['user_address_1'] = $this->input->post('user_address_line_1');
		    	$post['user_address_2'] = $this->input->post('user_address_2');    	
		    	$post['user_address_default'] = 1;     		
		    	$del_res = $this->products_model->addNewAddress($post);
		    	echo $del_res;
	    	}
	    }else{

	    	$removeDefaut = $this->products_model->removeDefultsbillAdress($post['user_id']);
	     	if($removeDefaut)
	     	{
	    		$setDefault = $this->products_model->setDefaultSameBillingaddress($post['same_as_delivery_address']); 
	    	}  
	    }
  }

   public function setDefaultDeladdress()
   {
     	$session = $this->session->all_userdata();   	
     	$address_id = $this->input->post('address_id');
     	$user_id = $session[0]->user_id;
     	$removeDefaut = $this->products_model->removeDefultsdelAdress($user_id);
     	if($removeDefaut){

     		$setDefault = $this->products_model->setDefaultDeladdress($address_id);
             $html ='';
     		if($setDefault)
     		{
     			$user_defaultdel_address_details = $this->products_model->getUserDefultDeleveryAddres($user_id);      			
     			$state_name = $this->products_model->getStateName($user_defaultdel_address_details[0]->user_address_state_id);			
     			
     			$html .= '<p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;">'.$user_defaultdel_address_details[0]->user_address_1.','.$user_defaultdel_address_details[0]->user_address_2.','.$user_defaultdel_address_details[0]->user_address_city.','.$state_name[0]->state_name.','.$user_defaultdel_address_details[0]->user_address_postalcode.'</p><input type="hidden" id="same_bill_addrss1" value="'.$user_defaultdel_address_details[0]->user_address_1.'"><input type="hidden" id="same_bill_addrss2" value="'.$user_defaultdel_address_details[0]->user_address_2.'"><input type="hidden" id="same_bill_city" value="'. $user_defaultdel_address_details[0]->user_address_city.'"><input type="hidden" id="same_bill_postal" value="'. $user_defaultdel_address_details[0]->user_address_postalcode.'"><input type="hidden" id="same_bill_state_id" value="'. $user_defaultdel_address_details[0]->user_address_state_id.'"><input type="hidden" id="same_bill_country_id" value="'. $user_defaultdel_address_details[0]->user_address_country_id.'"><input type="hidden" id="user_address_id" value="'.$user_defaultdel_address_details[0]->user_address_id.'">';
     			echo $html;
     		}
     	    else
     	    {
     	    	echo $html;
            }
        }    
   }

   public function setUsDefaultBillingAddrs()
   {
     	$session = $this->session->all_userdata();
     	$address_id = $this->input->post('address_id');
     	$user_id = $session[0]->user_id;
     	$removeDefaut = $this->products_model->removeDefultsbillAdress($user_id);
     	if($removeDefaut){

     		$setDefault = $this->products_model->setDefaultDeladdress($address_id);
             $html ='';
     		if($setDefault)
     		{
     			$user_defaultbil_address_details = $this->products_model->getUserDefultBillingAddres($user_id);      			
     			$state_name = $this->products_model->getStateName($user_defaultbil_address_details[0]->user_address_state_id);			
     			
     			$html .= '<p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;">'.$user_defaultbil_address_details[0]->user_address_1.','.$user_defaultbil_address_details[0]->user_address_2.','.$user_defaultbil_address_details[0]->user_address_city.','.$state_name[0]->state_name.','.$user_defaultbil_address_details[0]->user_address_postalcode.'</p>';

     			echo $html;
     		}
     	    else
     	    {
              	echo $html;                
     	    }
        }
    }

    public function removeSameBillingAddress()
    {
    	$same_bill_id = $this->input->post('same_bill_address_id');
    	$remove_bill_addrs = $this->products_model->removeSameBillingAddress($same_bill_id); 
    	echo $remove_bill_addrs;
    }   

	public function Orders() 
	{        
		if($this->checkSessionAdmin())
		{
	       
	        $user_id = $this->user_id;	       
	        $this->data['orders_list'] = $this->products_model->getAllUserOrdersById($user_id);	        
		   	$this->show_view_front('front/order_history',$this->data);
		}
		else
		{
			redirect(base_url());
		}
    }

    public function orderDetails($order_id = '')
    {
    	if($this->checkSessionAdmin())
		{  
	        $this->data['product_order_list'] = $this->products_model->getOrderProductById($order_id);
	         $user_id = $this->user_id;
	        $orders_list = $this->products_model->getAllUserOrdersById($user_id);	
	        $this->data['address_details'] = $this->products_model->getdelAddressById($orders_list[0]->order_user_d_address_id);	       
		   	$this->show_view_front('front/order_details',$this->data);
		}
		else
		{
			redirect(base_url());
		}
    }
    
 }
/* End of file */
?>