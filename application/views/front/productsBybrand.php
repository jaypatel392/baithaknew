<input type="hidden" name="hiddenBrand" id="hiddenBrand" value="<?php echo $this->uri->segment(3);?>">
	
	<!-- <div class="banner banner1">
		<div class="container">
			<h2>Great Offers on <span>Mobiles</span> Flat <i>35% Discount</i></h2> 
		</div>
	</div>  -->
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
						<h3>Price</h3>
						<div class="w3ls_mobiles_grid_left_grid_sub">
							<div class="ecommerce_color ecommerce_size">
								<ul>
									<li onclick="getProductByPrice('0','1000')"><a href="javascript:void(0)">Below INR 1000</a></li>
									<li onclick="getProductByPrice('1000','5000')"><a href="javascript:void(0)">INR 1000-5000</a></li>
									<li onclick="getProductByPrice('5000','10000')"><a href="javascript:void(0)">INR 5000-10000</a></li>
									<li onclick="getProductByPrice('10000','20000')"><a href="javascript:void(0)">INR 10000-20000</a></li>
									<li onclick="getProductByPrice('20000','0')" ><a href="javascript:void(0)">INR Above 20000</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 w3ls_mobiles_grid_right">
					
					
					<div class="clearfix"> </div>

					<div class="w3ls_mobiles_grid_right_grid2">
						<div class="w3ls_mobiles_grid_right_grid2_left">
							<h3>Showing Results: 0-1</h3>
						</div>
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
						<div class="clearfix"> </div>
					</div>
					<div id ="showfilterProductBycategory">
					<div class="w3ls_mobiles_grid_right_grid3">
					<?php foreach ($productsBybrand as $value) { ?>
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
												<a href="#" data-toggle="modal" data-target="#myModal9"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
											</li>
										</ul>
									</div>
								</div>
								<h5><a href ="<?php echo base_url().'singleproduct/viewProductDetail/'.base64_encode($value->product_id);?>"><?php echo $value->product_title;?></a></h5> 
								<div class="simpleCart_shelfItem">
									<p><span>$<?php echo $value->product_sale_price;?></span> <i class="item_price">$<?php echo $value->product_sale_price;?></i></p>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart" />
										<input type="hidden" name="add" value="1" /> 
										<input type="hidden" name="w3ls_item" value="Smart Phone" /> 
										<input type="hidden" name="amount" value="<?php echo $value->product_sale_price;?>"/>   
										<button type="submit" class="w3ls-cart">Add to cart</button>
									</form>
								</div> 
								<div class="mobiles_grid_pos">
									<h6>New</h6>
								</div>
							</div>
						</div>
						</a>
						<?php } ?>
						
						<div class="clearfix"> </div>
					</div>
					</div>
					
			</div>
		</div>
	</div>  
	
	<!-- Related Products -->
	<div class="top-brands">
		<div class="container">
			<h3>Top Brands</h3>
			<div class="sliderfig">
				<ul id="flexiselDemo1">
				<?php foreach ($brands as $value) { ?>
					
					
					<li>
						<a href ="<?php echo base_url().'products/searchProductByBrand/'.$value->brand_id;?>"><img src="<?php echo $value->brand_logo;?>" alt="theBrand" class="img-responsive"/></a>
						
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
	<!-- //Related Products -->
	<!-- newsletter -->
	<script type="text/javascript">


					
    
           	function getProductByPrice(min_price,max_price){
	   
	  // alert(min_price); return false;
 	   var brand_id = $('#hiddenBrand').val();
 	   var dataString = 'brand_id=' + brand_id + '&min_price=' + min_price + '&max_price='+max_price; 	
           	 $.ajax({
                type: "post",
                url: "<?php echo base_url().'products/getProductsByBrandIdAndPrice';?>",
                data: dataString,
                //dataType:"json",
                beforeSend:function(){

                	$('#showfilterProductBycategory').html('<img src ="<?php echo base_url().'webroot/clientloader.gif';?>" alt ="searching..." width="50">');
                } , 
                success: function(data) {
                	
                    if(data){
                    	//alert(data)
                       $('#showfilterProductBycategory').html(data);
                       $('#hiddenBrand').val(brand_id);
                    }else{

               	     $('#showfilterProductBycategory').html('<h5 style="color:red; text-align:center;">Product Not Found!</h5>');

               }
                }
            });
            
        }

   function sortProduct(productSortBy){
   		var brand_id = $('#hiddenBrand').val();
 	   var dataString = 'sortingBy=' +productSortBy + '&brand_id=' + brand_id; 	
           	 $.ajax({
                type: "post",
                url: "<?php echo base_url().'products/getsortedProductsbyBrand';?>",
                data: dataString,
                beforeSend: function(){

                	$('#showfilterProductBycategory').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');
                },
                //dataType:"json",  
                success: function(data) {
                	
                    if(data){
                    	//alert(data)
                       $('#showfilterProductBycategory').html(data);
                       $('#hiddenBrand').val(brand_id);
                    }else{

               	  $('#showfilterProductBycategory').html('<h4 style="color:red; text-align:center;">Product Not Found!</h4>');

               }
                }
            });
            
        }
   
   
</script>
<script src="<?php echo base_url().'webroot/front/js/jquery.flexisel.js';?>" type="text/javascript"></script>