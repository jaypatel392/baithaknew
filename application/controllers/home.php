<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/homepage_model');
	}
	
	public function index()
	{

	   $this->data['categories'] = $this->homepage_model->getAllcategories();	  
	   $this->data['newProduct'] = $this->homepage_model->getNewProduct();
	   $this->data['brands'] = $this->homepage_model->getBrands();
	   $this->data['three_products_latest'] = $this->homepage_model->getThreeProductLatest();
	    $this->data['discountedProduct'] = $this->homepage_model->getDiscountedProduct();	  
	    $this->data['home_banner'] = $this->homepage_model->getHomeBanner();	  
	    $this->data['discount_banner'] = $this->homepage_model->getDiscountedBanner();	  
	    $this->data['deals_banner'] = $this->homepage_model->getDealsBanner();	  
	    $this->data['testimonials'] = $this->homepage_model->getTestimonials();	  
	    $this->data['sp_deals_banner'] = $this->homepage_model->getSpDealsBanner();	  
	   	$this->show_view_front('front/home',$this->data);
		
    }

    public function ThreeProductByCategoryId()
    {
       $category_id = $this->input->post('category_id');
       $products_res = $this->homepage_model->getThreeProductByCategoryId();
      
       $html = '';
	   if(!empty($products_res))
	   {
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';
			$j = 1;	
			foreach ($products_res as $value)
			{
				$cat_arr = explode(',', $value->product_category_levels);
				if(in_array($category_id,$cat_arr))
				{
					$products_imgs =  $this->homepage_model->getThreeProductImage($value->product_id);

					if($j <= 3)
					{
						$html .= '<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles"><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"><div class="agile_ecommerce_tab_left mobiles_grid"><div class="hs-wrapper hs-wrapper2"><img src="'.$value->product_thumb_img.'" alt=" " class="img-responsive" />';

						$products_imgs =  $this->homepage_model->getThreeProductImage($value->product_id);
						foreach ($products_imgs as $valueImg)
						{
							$html .= '<img src="'.$valueImg->product_img_name.'" alt=" " class="img-responsive" />';
						}
						$html .= '</div><h5><a href="'.base_url().'singleproduct/viewProductDetail/'.$value->product_id.'"> '.substr($value->product_title,0,15).'</a></h5><div class="simpleCart_shelfItem"><p><i class="item_price">';
					    
						//Get value of product Discount
						$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);
						$productAttributes = $this->homepage_model->getProductAttributes($value->product_id);						

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

									$attr_min_value = $this->homepage_model->getAttrvalueMinPrice($productAttributes[0]->attr_id);
									//print_r($attr_min_value);

									$attr_max_value = $this->homepage_model->getAttrvalueMaxPrice($productAttributes[0]->attr_id); 
									$html .= 'Rs '.$attr_min_value[0]->attr_price.' - '.$attr_max_value[0]->attr_price .' ';
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
						$html .= '</div><div class="mobiles_grid_pos"><h6>New</h6></div></a></div><br><br><br></div>';
					}
					$j++;
				}
				
			 }

				
			$html .= '<div class="clearfix"> </div></div>';

			echo $html;
			
		}
		else
		{

			echo $html;
		}   
	}
}

/* End of file */
?>