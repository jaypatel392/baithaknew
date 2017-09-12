	<!-- banner -->
	<div class="banner">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->

    <ol class="carousel-indicators">
	<?php
		$j = 0;
		foreach ($home_banner as $hb_val) 
		{
		?>
			<li data-target="#myCarousel" data-slide-to="<?php echo $j;?>" class="<?php if($j == 0){ echo "active"; } ?>"></li>
			
		<?php 
		$j++;
		}
		?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    <?php
    $i = 1;
    foreach ($home_banner as $hb_val) 
    {
    	
    ?>
 
      <div class="item <?php if($i == 1){ echo "active"; } ?>">
         <a href="<?php echo $hb_val->home_banner_url; ?>">
        <img src="<?php echo base_url().$hb_val->home_banner_img_name; ?>" alt="Los Angeles" style="width:100%;height: 300px;">
      </a>
      </div>
      <?php
    	  $i++;
	  }
      ?>

    </div>

    <!-- Left and right controls -->
    <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a> -->
  </div>
		<!-- <div class="container">
			<h3>Electronic Store, <span>Special Offers</span></h3>
		</div> -->
	</div>
	<!-- //banner --> 
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="col-md-5 wthree_banner_bottom_left">
				<div class="video-img">
					<a class="play-icon popup-with-zoom-anim" href="#small-dialog">
						<span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
					</a>
				</div> 
					<!-- pop-up-box -->     
					<script src="<?php echo base_url();?>webroot/front/js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!--//pop-up-box -->
					<div id="small-dialog" class="mfp-hide">
						<iframe src="https://www.youtube.com/embed/ZQa6GUVnbNM"></iframe>
					</div>
					<script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
					</script>
			</div>
		<div class="col-md-7 wthree_banner_bottom_right">
			<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
					<?php foreach ($categories as $value) 
					{
					?>
						<li role="presentation" onclick="getProductByCategoryId('<?php echo $value->category_id;?>')"><a href="#" id="<?php echo $value->category_id;?>" role="tab" class ="presentation" data-toggle="tab" aria-controls="home"><?php echo $value->category_name;?></a></li>
					<?php 
					}
					?>						
				</ul>
					<div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
							<div class="agile_ecommerce_tabs">
                                                          							
							  <span id="productlimitthree">
							  <?php  foreach ($three_products_latest as $ltp_value) { ?>
							  	<div class="col-md-4 agile_ecommerce_tab_left">
									<a href="<?php echo base_url().'singleproduct/viewProductDetail/'.$ltp_value->product_id;?>">
									<div class="hs-wrapper">									
									<img src="<?php echo $ltp_value->product_thumb_img;?>" alt=" " class="img-responsive" />
									<?php  $three_products_img = $this->homepage_model->getThreeProductImage($ltp_value->product_id);
									if(!empty($three_products_img)){
									foreach ($three_products_img as $ltp_img_value) { ?>
										
										<img src="<?php echo $ltp_img_value->product_img_name;?>" alt=" " class="img-responsive" />
										<?php }
										}  ?>
										
									</div> 
									</a>
									<h5>
									<a href ="<?php echo base_url().'singleproduct/viewProductDetail/'.$ltp_value->product_id;?>"><?php echo substr($ltp_value->product_title, 0,19); ?></a></h5>
									<div class="simpleCart_shelfItem">
									<p> 
									<?php 
									//Get value of product Discount 
									$discount_list = $this->homepage_model->getProductDiscountById($ltp_value->product_discount_id);
									$productAttributes = $this->homepage_model->getProductAttributes($ltp_value->product_id);

									if(!empty($discount_list))
									{
										foreach ($discount_list as $des_value)
										{  ?>
										    <i class="item_price">
											<?php
											if($des_value->discount_type == "Percent")
											{
												echo "<span style='text-decoration: none;'>$des_value->discount_value% Off</span>";
												echo 'Rs '.$discount_price = $ltp_value->product_sale_price - ($ltp_value->product_sale_price * ($des_value->discount_value / 100));
											}
											else
											{
												echo 'Rs '.$discount_price = $ltp_value->product_sale_price - $des_value->discount_value;
											}

										}
									}
									else
									{
										if(!empty($productAttributes))
										{

											if($ltp_value->product_sale_price == 0)
											{

												$totel_min_price ='';	
												foreach ($productAttributes as $attr_value) 
												{

												$attr_min_value = $this->homepage_model->getAttrvalueMinPrice($attr_value->attr_id);
												$attr_max_value = $this->homepage_model->getAttrvalueMaxPrice($attr_value->attr_id);
												//print_r($attr_vals);
												}
												echo 'Rs '.$attr_min_value[0]->attr_price.' - '.$attr_max_value[0]->attr_price ;
											}
											else
											{
												echo 'Rs '.$ltp_value->product_sale_price;
											}

										}
										else
										{
											echo 'Rs '.$ltp_value->product_sale_price;
										}
									}
								   ?>										
								 </i>
								</p>
								<?php 									  
								$cart_details = $this->cart->contents();
								$check_cart=0;
								foreach ($cart_details as $cart_value) 
								{
									if($cart_value['id'] == $ltp_value->product_id)
									{
										$check_cart++;
									}
								}
								if($check_cart)
								{
								?>
									<a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>
								<?php 
								}
								else
								{
								?>
									<a href= "<?php echo base_url();?>singleproduct/viewProductDetail/<?php echo $ltp_value->product_id;?>" ><button type="button" class="w3ls-cart">Add to cart</button></a>
								<?php
								}	
								?>
					        </div>
					    </div>
						<?php } ?>
					  </span>
					</div>
				</div>
			</div>
		</div> 
	</div>
  <div class="clearfix"> </div>
</div>
</div>
	<!-- //banner-bottom --> 	
	<!-- banner-bottom1 -->
	<div class="banner-bottom1">
		<div class="agileinfo_banner_bottom1_grids">
			<?php
			if(!empty($discount_banner))
			{
				$dis_img = base_url().$discount_banner[0]->discount_img_name;
			  ?>
			  <a href="<?php echo $discount_banner[0]->discount_img_url; ?>">
				<div class="col-md-7 agileinfo_banner_bottom1_grid_left" style="background-image: url('<?php echo $dis_img; ?>');">
				</div>
				</a>
			<?php
			}

			if(!empty($deals_banner))
			{
				$deals_img = base_url().$deals_banner[0]->home_deals_img_name;
			  ?>
			  <a href="<?php echo $deals_banner[0]->home_deals_url; ?>">
			
				<div class="col-md-5 agileinfo_banner_bottom1_grid_right" style="background-image: url('<?php echo $deals_img; ?>');">
				<?php
				}
				?>
					<h4>hot deal</h4>
					<div class="timer_wrap">
						<div id="counter"> </div>
					</div>
					<script src="<?php echo base_url().'webroot/front/js/jquery.countdown.js';?>"></script>
					<script src="<?php echo base_url().'webroot/front/js/script.js';?>"></script>
				</div>
				</a>
			<div class="clearfix"> 
		</div>
	</div>
</div>
<!-- //banner-bottom1 --> 
<!-- special-deals -->
	<div class="special-deals">
		<div class="container">
			<h2>Special Deals</h2>
			<div class="w3agile_special_deals_grids">
				<div class="col-md-7 w3agile_special_deals_grid_left">
					<div class="w3agile_special_deals_grid_left_grid">
						<?php
						if(!empty($sp_deals_banner))
						{
						?>
							<img src="<?php echo base_url().$sp_deals_banner[0]->home_sp_deals_img_name;?>" alt=" " class="img-responsive" />
						<?php
						}
						?>
						
					</div>
					<div class="wmuSlider example1">
						<div class="wmuSliderWrapper">
						<?php
						foreach ($testimonials as $tes_val)
						{
						
						?>
							<article style="position: absolute; width: 100%; opacity: 0;"> 
								<div class="banner-wrap">
									<div class="w3agile_special_deals_grid_left_grid1">
										<img src="<?php echo base_url().$tes_val->testimonial_img;?>" alt=" " class="img-responsive" />
										<p><?php echo $tes_val->testimonial_description; ?></p>
										<h4><?php echo $tes_val->testimonial_name; ?></h4>
									</div>
								</div>
							</article>
							<?php
							}
							?>
							
						</div>
					</div>
						<script src="<?php echo base_url().'webroot/front/js/jquery.wmuSlider.js';?>"></script> 
						<script>
							$('.example1').wmuSlider();         
						</script> 
				</div>
				<div class="col-md-5 w3agile_special_deals_grid_right">
					<?php
						if(!empty($sp_deals_banner))
						{
						?>
							<img src="<?php echo base_url().$sp_deals_banner[0]->home_sp_deals_img_name;?>" alt=" " class="img-responsive" />
						<?php
						}
						?>
						
					
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //special-deals -->
	<!-- new-products -->
	<div class="new-products">
		<div class="container">
			<h3>New Products</h3>
			<div class="agileinfo_new_products_grids">			
			<?php foreach ($newProduct as $value) 
			{ 
			?>				
			
				<div class="col-md-3 agileinfo_new_products_grid">
					<div class="agile_ecommerce_tab_left agileinfo_new_products_grid1">
					<a href="<?php echo base_url().'singleproduct/viewProductDetail/'.$ltp_value->product_id;?>">
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
						</div> 
						</a>
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
<!-- top-brands -->
	<div class="top-brands">
		<div class="container">
			<h3>Top Brands</h3>
			<div class="sliderfig">
				<ul id="flexiselDemo1">
				<?php foreach ($brands as $value) { ?>				
					
					<li>
						<a href ="<?php echo base_url().'products/searchProductByBrand/'.$value->brand_id;?>"><img src="<?php echo base_url().'webroot/admin/upload/brand/'.$value->brand_logo;?>" alt="theBrand" class="img-responsive"/></a>
						
					</li>
					<?php } ?>
				</ul>
			</div>
			<script type="text/javascript">
					$(window).load(function() {
						$("#flexiselDemo1").flexisel({
							visibleItems: 4,
							animationSpeed: 1000,
							autoPlay: true,
							autoPlaySpeed: 3000,    		
							pauseOnHover: true,
							enableResponsiveBreakpoints: true,
							responsiveBreakpoints: { 
								portrait: { 
									changePoint:480,
									visibleItems: 1
								}, 
								landscape: { 
									changePoint:640,
									visibleItems:2
								},
								tablet: { 
									changePoint:768,
									visibleItems: 3
								}
							}
						});
						
					});
			</script>
			<script type="text/javascript" src="<?php echo base_url().'webroot/front/js/jquery.flexisel.js';?>"></script>			
		</div>
	</div>
	<!-- //top-brands --> 
	<script type="text/javascript">
			
    function getProductByCategoryId(category_id){

        var str = 'category_id='+category_id;
        //alert(str); return false;
        var PAGE = '<?php echo base_url();?>home/ThreeProductByCategoryId';        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            cache: false,
		    beforeSend: function () {
		    $('#productlimitthree').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');	        
		     },  
            success:function(data)
            { 
            	
               if(data)
               {
                  $('#productlimitthree').html(data);

               }else{

               	  $('#productlimitthree').html('<h5 style="color:red; text-align:center;">Product Not Found!</h5>');

               }
            }
        });
  }

  
   
</script>
