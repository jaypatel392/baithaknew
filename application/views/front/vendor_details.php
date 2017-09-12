	<!-- banner -->
	<div class="banner banner2 vendor_banner">
		<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1 text-center">
							<img src="<?php echo base_url().$vendor_about[0]->vendor_profile_img;?>" alt=" " class="img-circle img-responsive"/>
							<?php $user_contact  = explode('/',$vendor_about[0]->user_phone); ?>
							<h2><?php echo $vendor_about[0]->user_name;?></h2>
							<h4>Joined : <?php echo $vendor_about[0]->user_updated_date;?><br>Contact : <?php echo $user_contact[0];?></h4>
						</div>
					</div>
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						<div class="w3ls_mobiles_grid_right_grid1">
							<img src="<?php echo base_url().$vendor_about[0]->vendor_banner_img;?>" alt=" " class="img-responsive" />
							
						</div>
					</div>
	</div> 
	
	<!-- mobiles -->
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">
				<div class="col-md-4 w3ls_mobiles_grid_left">
				<div class="w3ls_mobiles_grid_left_grid">
						<h3>Pages</h3>
						<div class="w3ls_mobiles_grid_left_grid_sub">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<ul class="panel_bottom">
									<li><a style="color: black;" href="<?php echo base_url();?>VendorDetails">All Products</a></li>
									<li><a href="<?php echo base_url();?>VendorDetails/aboutUs">About Us</a></li>
									<li><a href="<?php echo base_url();?>VendorDetails/gallery">Gallery</a></li>
									<li><a href="<?php echo base_url();?>VendorDetails/reviews">Reviews</a></li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="w3ls_mobiles_grid_left_grid">

						<h3>Categories</h3>

						<div class="w3ls_mobiles_grid_left_grid_sub">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<?php 
							$i = 1;
							foreach ($categories as $cat_val) 
							{
								if($i == 1)
								{
								?>
								<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
								  <h4 class="panel-title asd">
									<a class="pa_italic" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $cat_val->category_name; ?>
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body panel_text">
									<ul>
									<?php
									$subCategories = $this->vendor_model->getSubCategories($cat_val->category_id);
										if(!empty($subCategories))
										{
											foreach ($subCategories as  $subCategory) 
											{ ?>
										
												<li><a href="products.html"><?php echo $subCategory->category_name;?></a></li>
										<?php
											}
										}
										?>
									</ul>
								  </div>
								</div>
							  </div>
										
								<?php
								}
								else
								{
								?>
								<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading<?php echo $i;?>">
								  <h4 class="panel-title asd">
									<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>">
									  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $cat_val->category_name; ?>
									</a>
								  </h4>
								</div>
								<div id="collapse<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i;?>">
								   <div class="panel-body panel_text">
									<ul>
									<?php
									$subCategories = $this->vendor_model->getSubCategories($cat_val->category_id);
										if(!empty($subCategories))
										{
											foreach ($subCategories as  $subCategory) 
											{ ?>
										
												<li><a href="products.html"><?php echo $subCategory->category_name;?></a></li>
										<?php
											}
										}
										?>
									</ul>
								  </div>
								</div>
							  </div>
							
								<?php
								}
								$i++;
							}
							?>
							</div>						
						</div>
					</div>
				</div>
				<div class="col-md-8 w3ls_mobiles_grid_right">
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						
					</div>
					<div class="col-md-6 w3ls_mobiles_grid_right_left">
						
					</div>
					<div class="clearfix"> </div>

					<div class="w3ls_mobiles_grid_right_grid2">
						<div class="w3ls_mobiles_grid_right_grid2_left">
							<!-- <h3>Showing Results: 0-1</h3> -->
						</div>
						<div class="w3ls_mobiles_grid_right_grid2_right">
							
						</div>
						<div class="clearfix"> </div>
					</div>
					<div id ="showfilterProductBycategory">
					<div class="w3ls_mobiles_grid_right_grid3">
					<?php foreach ($vendor_products as $value) { ?>

							<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
							<div class="agile_ecommerce_tab_left mobiles_grid">
								<div class="hs-wrapper hs-wrapper2">
								<?php $products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
								foreach ($products_imgs as $valueImg) { ?>
									<img src="<?php echo $valueImg->product_img_name;?>" alt=" " class="img-responsive" />
								 <?php } ?>
									
									
									<div class="w3_hs_bottom w3_hs_bottom_sub1">
										<ul>
											<li>
												<a href="<?php echo base_url();?>singleproduct/viewProductDetail/<?php echo $value->product_id;?>" <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
											</li>
										</ul>
									</div>
								</div>
								<h5><a href="<?php echo base_url().'singleproduct/viewProductDetail/'.$value->product_id;?>"><?php echo substr($value->product_title,0,19);?></a></h5> 
								<div class="simpleCart_shelfItem">
									<p><i class="item_price">
									<?php
									//Get value of product Discount
									$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);
									$productAttributes = $this->products_model->getProductAttributes($value->product_id);

									if(!empty($discount_list)){

									foreach ($discount_list as $des_value) {

											if($des_value->discount_type == "Percent"){
											echo "<span style='text-decoration: none;'>$des_value->discount_value% Off</span>";
											}else{
											echo "<span>Rs $des_value->discount_value </span>";
											} ?>
											<i class="item_price">
											<?php
								
											if($des_value->discount_type == "Percent"){
				                                                                             
				                                  if($value->product_sale_price == 0){
				                                      
				                                      echo 'Rs '.$discount_price = $product_totel_price - ($aproduct_price * ($des_value->discount_value / 100));
				                                   }else{
				                                         echo 'Rs '.$discount_price = $productDetail[0]->product_sale_price - ($productDetail[0]->product_sale_price * ($des_value->discount_value / 100));
				                                    }

												
												}else{
						                          
						                            if($productDetail[0]->product_sale_price == 0){
						                                      
						                                    echo 'Rs '.$discount_price = $product_totel_price - $des_value->discount_value;
						                             }else{

						                                     echo 'Rs '.$discount_price = $productDetail[0]->product_sale_price - $des_value->discount_value;
						                              }     

												  }
											  }

										    }else{
									     	
										    if($value->product_sale_price == 0){

										     	if(!empty($productAttributes)){
			                                     $totel_min_price ='';

													    $attr_min_value = $this->products_model->getAttrvalueMinPrice($productAttributes[0]->attr_id);

													    $attr_max_value = $this->products_model->getAttrvalueMaxPrice($productAttributes[0]->attr_id); 
													    										
													
												  
												      echo 'Rs '.$attr_min_value[0]->attr_min_price.' - '.$attr_max_value[0]->attr_max_price ;
											   }else{
											   	echo 'Rs '.$value->product_sale_price;
											   }

									     }
									     else{

									     		echo 'Rs '.$value->product_sale_price;
									     }
									   }

									?>  </i></p>
									  <?php 									  
										  $cart_details = $this->cart->contents();
										   $check_cart=0;
										  foreach ($cart_details as $cart_value) {
										  	 if($cart_value['id'] == $value->product_id){
										       $check_cart++;
										      }
										  }
										  if($check_cart){
										  ?>
										  <a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>
										  <?php }else{
										  	?>
										 <a href= "<?php echo base_url();?>singleproduct/viewProductDetail/<?php echo $value->product_id;?>" ><button type="button" class="w3ls-cart">Add to cart</button></a>
										  	<?php
										  	}
										  							  
									    ?>					
									
									</div> 
									<div class="mobiles_grid_pos">
										<h6>New</h6>
									</div>
								</div>
				          	   <br><br><br>	
							</div>						
						<?php }	?>				
			 		  <div class="clearfix"> </div>
			 		 
				   </div>
				</div>
			</div>
		</div>
	</div>  
	<!-- Related Products -->
	<div class="w3l_related_products">
		<div class="container">
			<h3>Related Products</h3>			
				
		</div>
	</div>
	<!-- //Related Products -->