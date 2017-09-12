<!-- <div class="banner banner1">
   <div class="container">
   </div>
</div> -->
<!-- breadcrumbs -->
<div class="breadcrumb_dress">
   <div class="container">
      <ul>
         <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
         <li>Products</li>
      </ul>
   </div>
</div>
<!-- //breadcrumbs --> 
<!-- mobiles -->
<div class="mobiles">
<div class="container">
   <div class="w3ls_mobiles_grids">
      <div class="col-md-4 w3ls_mobiles_grid_left">
      
         <div class="w3ls_mobiles_grid_left_grid">
            <h3>Categories</h3>
             <input type="hidden" name="hiddenCategory" id="hiddenCategory" value="<?php echo $this->uri->segment(3);?>">
            <div class="w3ls_mobiles_grid_left_grid_sub">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php 
                     $i = 1;
                     foreach ($categories as $cat_val) 
                     {
                     	 $subCategories = $this->products_model->getSubCategories($cat_val->category_id);
	             		 if(!empty($subCategories))
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
										if(!empty($subCategories))
										{
											foreach ($subCategories as  $subCategory) 
											{
												$subCategories2 = $this->products_model->getSubCategories($subCategory->category_id);
												if(!empty($subCategories2))
												{										
											      ?>
											      <div class="panel panel-default" >
														<div class="panel-heading" role="tab" id="heading<?php echo $subCategory->category_id;?>">
															<h4 class="panel-title asd">
															<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $subCategory->category_id;?>" href="#collapse<?php echo $subCategory->category_id;?>" aria-expanded="false" aria-controls="collapse<?php echo $subCategory->category_id;?>">
															<span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $subCategory->category_name; ?>
															</a>
															</h4>
														</div>
														  <div id="collapse<?php echo $subCategory->category_id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $subCategory->category_id; ?>">
		                       							 <div class="panel-body panel_text">
															<ul>
																<?php	                                
																foreach ($subCategories2 as  $subCategory2)
																{
																?>
																	<li><a href="#topshow" onclick="getFilterProductBygetegoryId('<?php echo $subCategory->category_id;?>')"><?php echo $subCategory2->category_name;?></a></li>
																<?php
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
													<li><a href="#topshow" onclick="getFilterProductBygetegoryId('<?php echo $subCategory->category_id;?>')"><?php echo $subCategory->category_name;?></a></li>

												<?php
												}
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
			                                 $subCategories = $this->products_model->getSubCategories($cat_val->category_id);
												if(!empty($subCategories))
												{
													foreach ($subCategories as  $subCategory) 
													{

														$subCategories2 = $this->products_model->getSubCategories($subCategory->category_id);
														if(!empty($subCategories2))
														{										
													      ?>
													      <div class="panel panel-default" >
															<div class="panel-heading" role="tab" id="heading<?php echo $subCategory->category_id;?>">
																<h4 class="panel-title asd">
																<a class="pa_italic collapsed" role="button" data-toggle="collapse" data-parent="#accordion<?php echo $subCategory->category_id;?>" href="#collapse<?php echo $subCategory->category_id;?>" aria-expanded="false" aria-controls="collapse<?php echo $subCategory->category_id;?>">
																<span class="glyphicon glyphicon-plus" aria-hidden="true"></span><i class="glyphicon glyphicon-minus" aria-hidden="true"></i><?php echo $subCategory->category_name; ?>
																</a>
																</h4>
															</div>
															  <div id="collapse<?php echo $subCategory->category_id;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $subCategory->category_id; ?>">
			                       							 <div class="panel-body panel_text">
																<ul>
																	<?php	                                
																	foreach ($subCategories2 as  $subCategory2)
																	{
																	?>
																		<li><a href="#topshow" onclick="getFilterProductBygetegoryId('<?php echo $subCategory2->category_id;?>')"><?php echo $subCategory2->category_name;?></a></li>
																	<?php
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

														<li><a href="#topshow" onclick="getFilterProductBygetegoryId('<?php echo $subCategory->category_id;?>')"><?php echo $subCategory->category_name;?></a></li>
														<?php
													}
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
			                     }else{
			                     	?>
		                     	<div class="panel panel-default">
									<div class="panel-heading" role="tab">
										<h4 class="panel-title asd">
			                     		  <a href="#topshow" class="pa_italic" onclick="getFilterProductBygetegoryId('<?php echo $cat_val->category_id;?>')" role="button" ><i class="glyphicon glyphicon-minus"></i><?php echo $cat_val->category_name; ?></a>
			                     		  	</h4>

	                             	</div>
	                             </div>
			                     <?php 
			                 }
			                 }
			                 ?>
			                 <input type="hidden" id="category_multi_filter">
			               </div>
			            </div>
			         </div>
			           <!--  <div class="w3ls_mobiles_grid_left_grid">
			            <h3>Price</h3>
			            <div class="w3ls_mobiles_grid_left_grid_sub">
			               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			                  <ul class="panel_bottom">
								<li onclick="getProductByPrice('0','1000')"><a href="javascript:void(0)">Below INR 1000</a></li>
								<li onclick="getProductByPrice('1000','5000')"><a href="javascript:void(0)">INR 1000-5000</a></li>
								<li onclick="getProductByPrice('5000','10000')"><a href="javascript:void(0)">INR 5000-10000</a></li>
								<li onclick="getProductByPrice('10000','20000')"><a href="javascript:void(0)">INR 10000-20000</a></li>
								<li onclick="getProductByPrice('20000','0')" ><a href="javascript:void(0)">INR Above 20000</a></li>
			                  </ul>
			               </div>
			            </div>
			         </div> -->
			   </div>
		      <div class="col-md-8 w3ls_mobiles_grid_right" id="topshow">
		      	<div class="clearfix"> </div>
					<div class="w3ls_mobiles_grid_right_grid2">
							<div class="col-md-6 text-left">
								<h3 style="float: left;line-height: 26px;margin-right: 10px;">Search By City: </h3>
								 <input class="search_input" type="text" style="width: 40%;" onchange="getProductByCity(this.value)" name="search_city" id="search_city" class="form-control">
							</div>			
							<div class="col-md-6 text-right">
								<div class="w3ls_mobiles_grid_right_grid2_right">
									<select name="productsort" id ="sortProduct" class="select_item" onchange="sortProduct(this.value)">
										<option value =""selected="selected">Default sorting</option>
										<option value="rating">Sort by popularity</option>
										<option value ="rating">Sort by average rating</option>
										<option value = "newproduct">Sort by newness</option>
										<option value ="price_lowtohigh">Sort by price: low to high</option>
										<option value ="price_hightolow">Sort by price: high to low</option>
									</select>
								</div>
							</div>
					<div class="clearfix"> </div>
				</div>
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
		               <?php foreach ($productsBycat as $value) { ?>
		               <div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
		                  <div class="agile_ecommerce_tab_left mobiles_grid">
		                  <a href="<?php echo base_url();?>singleproduct/viewProductDetail/<?php echo $value->product_id;?>">
		                     <div class="hs-wrapper hs-wrapper2">
		                        <?php $products_imgs =  $this->products_model->getThreeProductImage($value->product_id);
		                           foreach ($products_imgs as $valueImg) { ?>
		                        <img src="<?php echo $valueImg->product_img_name;?>" alt=" " class="img-responsive" />
		                        <?php } ?>
		                       
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
		                              
		                              ?>  </i>
		                        </p>
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
		                  </a>
		               </div>
		               <?php }	?>				
		               <div class="clearfix"> </div>
 <div style="float: right; font-size: 17px;"><?php  echo $page_links;?></div>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
		<!-- Related Products -->
		<!-- new-products -->
			<div class="w3l_related_products">
		   <div class="container">
					<h3>Related Products</h3>
					<div class="agileinfo_new_products_grids">			
					<?php foreach ($newProduct as $value) 
					{ 
					?>				
					
						<div class="col-md-3 agileinfo_new_products_grid">
							<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
							<a href ="<?php echo base_url().'singleproduct/viewProductDetail/'.$value->product_id;?>">
								<div class="hs-wrapper hs-wrapper1">
									<img src="<?php echo $value->product_thumb_img;?>" alt=" " class="img-responsive" />							
									<?php  $three_products_img = $this->homepage_model->getThreeProductImage($value->product_id);

									foreach ($three_products_img as $new_img_value) 
									{ 
								    ?>
										<img src="<?php echo $new_img_value->product_img_name;?>" alt=" " class="img-responsive" />
									<?php
									 }
									?>
									
								</div> </a>
								<h5><a href ="<?php echo base_url().'singleproduct/viewProductDetail/'.$value->product_id;?>"><?php echo $value->product_title; ?></a></h5>
								<div class="simpleCart_shelfItem">
									<p> 
										<?php 
										//Get value of product Discount 
										$discount_list = $this->homepage_model->getProductDiscountById($value->product_discount_id);	
										if(!empty($discount_list))
										{
											foreach ($discount_list as $new_des_value) 
											{

												if($new_des_value->discount_type == "Percent")
												{
													echo "<span style='text-decoration: none;'>$des_value->discount_value% Off</span>";
												}
												else
												{
													echo "<span>Rs $des_value->discount_value </span>";
												} ?>
												<i class="item_price">
												<?php
												if($new_des_value->discount_type == "Percent")
												{
													echo 'Rs '.$discount_price = $value->product_sale_price - ($value->product_sale_price * ($new_des_value->discount_value / 100));
												}
												else
												{
													echo 'Rs '.$discount_price = $value->product_sale_price - $new_des_value->discount_value;
												}

											}
										}
										else
										{
											if(!empty($productAttributes))
											{

												if($value->product_sale_price == 0)
												{
													$totel_min_price ='';	
													foreach ($productAttributes as $attr_value)
													{
														$attr_min_value = $this->homepage_model->getAttrvalueMinPrice($attr_value->attr_id);
														$attr_max_value = $this->homepage_model->getAttrvalueMaxPrice($attr_value->attr_id);
													}
													echo 'Rs '.$attr_min_value[0]->attr_price.' - '.$attr_max_value[0]->attr_price ;
												}

											}
											else
											{
												echo 'Rs '.$value->product_sale_price;
											}
										}
										?>										
										</i>
										</p>						
								</div>					
							</div>
						</div>
					<?php
					}
					?>
				<div class="clearfix"> </div>
			  </div>
			</div>
		</div>
		<!-- //new-products -->
		<!-- //Related Products -->

		<script type="text/javascript">
			function getFilterProductBygetegoryId(category_id)
			{
				$.ajax({
				type: "post",
				url: "<?php echo base_url().'products/getProductsByCatId';?>",
				data: "cat_id="+ category_id,
				cache: false,
				beforeSend: function () {

					$('#showfilterProductBycategory').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');	        
				},   
				success: function(data) {					
					if(data)
					{
						$('#showfilterProductBycategory').html(data);
						$('#hiddenCategoriyId').val(category_id);
					}
					else
					{
						$('#showfilterProductBycategory').html('<br><br><h4 style="color:red; text-align:center;">Product Not Found!</h4>');
					}
				}
				});
			}

			function getProductByCity(str)
			{
				$.ajax({
				type: "post",
				url: "<?php echo base_url().'products/getProductByCity';?>",
				data: 'city_name='+str,
				cache: false,
				beforeSend: function () {
				$('#showfilterProductBycategory').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');	        
				},    
				success: function(data) {

					if(data){
					
						$('#showfilterProductBycategory').html(data);
					}
					else
					{
						  $('#showfilterProductBycategory').html('<br><br><h4 style="color:red; text-align:center;">Product Not Found!</h4>');
					}
				}
				});
			}

			function getProductByPrice(min_price,max_price){

			// alert(min_price); return false;
			var cat_id = $('#hiddenCategory').val();
			var dataString = 'cat_id=' + cat_id + '&min_price=' + min_price + '&max_price='+max_price; 	
			$.ajax({
			type: "post",
			url: "<?php echo base_url().'products/getProductsByCatIdAndPrice';?>",
			data: dataString,
			cache: false,
			beforeSend: function () {
			$('#showfilterProductBycategory').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');	        
			},    
			success: function(data) {

			if(data){
			//alert(data)
			$('#showfilterProductBycategory').html(data);
			$('#hiddenCategory').val(category_id);
			}else{
			$('#showfilterProductBycategory').html('<br><br><h4 style="color:red; text-align:center;">Product Not Found!</h4>');
			}
			}
			});

			}

			function sortProduct(productSortBy){
			var cat_id = $('#hiddenCategory').val();
			var dataString = 'sortingBy=' +productSortBy + '&cat_id=' + cat_id; 	
			$.ajax({
			type: "post",
			url: "<?php echo base_url().'products/getsortedProducts';?>",
			data: dataString,
			cache: false,
			beforeSend: function () {
			$('#showfilterProductBycategory').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');	        
			},  
			success: function(data) {

			if(data){
			//alert(data)
			$('#showfilterProductBycategory').html(data);
			$('#hiddenCategory').val(category_id);
			}else{
			$('#showfilterProductBycategory').html('<br><br><h4 style="color:red; text-align:center;">Product Not Found!</h4>');
			}
			}
			});

			}

		</script>
