<div class="breadcrumb_dress">
   <div class="container">
      <ul>
         <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
         <li>Single Page</li>
      </ul>
   </div>
</div>
<!-- //breadcrumbs -->  
<!-- single -->
<form method="POST">
   <div class="single">
      <div class="container">
         <div class="col-md-4 single-left">
            <div class="flexslider">
               <ul class="slides">
                  <li data-thumb="<?php echo $productDetail[0]->product_thumb_img;?>">
                     <div class="thumb-image"> <img src="<?php echo $productDetail[0]->product_thumb_img;?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                  </li>
                  <?php foreach ($threeImg as $img_value) { ?>
                  <li data-thumb="<?php echo $img_value->product_img_name;?>">
                     <div class="thumb-image"> <img  src="<?php echo $img_value->product_img_name;?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                  </li>
                  <?php } ?>
               </ul>
            </div>
            <!-- flexslider -->
            <script defer src="<?php echo base_url().'webroot/front/js/jquery.flexslider.js';?>"></script>
            <link rel="stylesheet" href="<?php echo base_url().'webroot/front/css/flexslider.css';?>" type="text/css" media="screen" />
            <script>
               // Can also be used with $(document).ready()
               $(window).load(function() {
                 $('.flexslider').flexslider({
               	animation: "slide",
               	controlNav: "thumbnails"
                 });
               });
            </script>
            <!-- flexslider -->
            <!-- zooming-effect -->
            <script src="<?php echo base_url().'webroot/front/js/imagezoom.js';?>"></script>
            <!-- //zooming-effect -->
         </div>
         <div class="col-md-8 single-right">
            <h3><?php echo $productDetail[0]->product_title;?></h3>
            <input type="hidden" name="crt_product_id" value="<?php echo $productDetail[0]->product_id;?>">
            <input type="hidden" name="crt_product_title" value="<?php echo $productDetail[0]->product_title;?>">
            <input type="hidden" name="crt_product_thumb_img" value="<?php echo $productDetail[0]->product_thumb_img;?>">
            <?php
               if(!empty($productAttributes))
               {
                       if($productDetail[0]->product_sale_price == 0)
                       {
                            
                         $attr_vals1 = $this->singleproduct_model->getAttrvalue($productAttributes[0]->attr_id);
               
                       ?>
				            <input type="hidden" id="crt_product_price" name="crt_product_price" value="<?php echo $productDetail[0]->product_sale_price+$attr_vals1[0]->attr_price;?>">
				            <input type="hidden" id="crt_attr_val_id" name="crt_attr_val_id" value="<?php echo $productAttributes[0]->attr_id.'_'.$attr_vals1[0]->attr_val_id;?>">
				            <?php 
				            }else
                    {
				            ?>
				             <input type="hidden" id="crt_product_price" name="crt_product_price" value="<?php echo $productDetail[0]->product_sale_price;?>">
                     <?php
                     }
	            }
	            else
	            { ?>
	            <input type="hidden" id="crt_product_price" name="crt_product_price" value="<?php echo $productDetail[0]->product_sale_price;?>">
	            <?php 
	        	}
	               ?>
	            <div class="rating1">
	               <span class="starRating">
	               <input id="rating5" type="radio" name="" value="5">
	               <label for="rating5">5</label>
	               <input id="rating4" type="radio" name="" value="4">
	               <label for="rating4">4</label>
	               <input id="rating3" type="radio" name="" value="3" checked>
	               <label for="rating3">3</label>
	               <input id="rating2" type="radio" name="" value="2">
	               <label for="rating2">2</label>
	               <input id="rating1" type="radio" name="" value="1">
	               <label for="rating1">1</label>
	               </span>
	            </div>
	            <div class="description">
	               <h5><i>Description</i></h5>
	               <p><?php echo $productDetail[0]->product_description;?></p>
	            </div>
            <?php
               if(!empty($productAttributes))
               {
	                $aa = 0;
	               foreach ($productAttributes as $attr_value) 
	               {
	               ?>				
		            <div class="occasional p_total_price" >
		               <h5><?php echo $attr_value->attr_name;?>:</h5>
		               <?php 
		                  $attr_vals = $this->singleproduct_model->getAttrvalue($attr_value->attr_id);
		                  $i=0; 

		                  foreach ($attr_vals as  $valueAttr) 
		                  {  
		                  	if($i == 0 && $aa == 0)
		                  	{
		                  		$product_totel_price =0;
		                  		$product_totel_price = $valueAttr->attr_price;
		                  	}
		                  	?>
				               <div class="colr ert">
				                  <div class="check">
				                     <label class="checkbox" <?php if($valueAttr->attr_img){ ?> onmouseout="ShowPicture('attr_imglement<?php echo $valueAttr->attr_val_id;?>',0)" onmouseover="ShowPicture('attr_imglement<?php echo $valueAttr->attr_val_id;?>',1)" <?php } ?> >

				                     <input type="radio" <?php if($productDetail[0]->product_sale_price == 0) { if($i == 0 && $aa == 0){ echo "checked";  } }?> class="attr_attr_val" name="product_attr_value<?php echo $attr_value->attr_id;?>" id="<?php echo $attr_value->attr_id;?>_<?php echo $valueAttr->attr_val_id;?>" value="<?php echo $valueAttr->attr_price;?>"><i> </i><?php echo $valueAttr->attr_value;?>
				                     </label>

				                     <?php if($valueAttr->attr_img)
				                     { 
				                     	?> 
				                     <div id="attr_imglement<?php echo $valueAttr->attr_val_id;?>"  style="position:absolute; visibility:hidden;">							
				                        <img width="600" class="img-responsive" src="<?php echo base_url().$valueAttr->attr_img; ?>">
				                     </div>
				                     <?php
				                        }
				                        ?>
				                  </div>
				               </div>
			               <?php  
			               $i++; 
			               } 
			              ?>
		               <div class="clearfix"> </div>
		            </div>
	            <?php 
	            $aa++;
	        	}
	       }
	       else
	       {
	         $product_totel_price = $productDetail[0]->product_sale_price;
	       }
	      ?>
   		
            <div class="simpleCart_shelfItem">
               <p>
                  <i class="item_price">
                  <?php
                     //Get value of product Discount
                       $discount_list = $this->singleproduct_model->getProductDiscountById($productDetail[0]->product_discount_id);

                     if(!empty($discount_list))
                     {

                     
	                     foreach ($discount_list as $des_value)
	                     {
	                     
		                     if($des_value->discount_type == "Percent")
		                     {
		                     	echo "<span style='text-decoration: none;'>$des_value->discount_value% Off</span>";
		                     }
		                     else
		                     {
		                     	echo "<span>Rs $des_value->discount_value </span>";
		                     } ?>
		             		<i class="item_price">
		                     <?php
		                       if($des_value->discount_type == "Percent")
		                       {
		                                                                                            
									if($productDetail[0]->product_sale_price == 0)
									{

										echo 'Rs '.$discount_price = $product_totel_price - ($aproduct_price * ($des_value->discount_value / 100));
									}
									else
									{
										echo 'Rs '.$discount_price = $productDetail[0]->product_sale_price - ($productDetail[0]->product_sale_price * ($des_value->discount_value / 100));
									}

								}
								else
								{

									if($productDetail[0]->product_sale_price == 0)
									{

										echo 'Rs '.$discount_price = $product_totel_price - $des_value->discount_value;
									}
									else
									{
										echo 'Rs '.$discount_price = $productDetail[0]->product_sale_price - $des_value->discount_value;
									}     

		                        }
	                        
	                        }
                    }
                    else
                    {
						if($productDetail[0]->product_sale_price == 0)
						{
						?>
							<div id="product_totel_price">Rs <?php echo $product_totel_price ;?></div>
						<?php
						}
						else
						{
							?>
							<div id="product_totel_price">Rs <?php echo $productDetail[0]->product_sale_price ;?></div>
							<?php
						}    
                 	}
                  
                  ?>
                  </i>
                  </p>
           		<?php 									  
                  $cart_details = $this->cart->contents();
                   $check_cart=0;
                  foreach ($cart_details as $cart_value) {
                  	 if($cart_value['id'] == $this->uri->segment(3)){
                       $check_cart++;
                      }
                  }
                  if($check_cart){
                  ?>
               <a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>
               <?php }else{
                  ?>
               <div id="add_crt_btn<?php echo $this->uri->segment(3);?>">
                  <button type="submit" name="Add_cart" class="w3ls-cart">Add to cart</button>
               </div>
               <?php
                  }						  							  
                  ?>				
            </div>
         </div>
         <div class="clearfix"> </div>
      </div>
   </div>
</form>
<div class="additional_info">
   <div class="container">
      <div class="sap_tabs">
         <div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
            <ul>
               <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Information</span></li>
               <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Reviews</span></li>
            </ul>
            <div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
               <h3><?php echo $productDetail[0]->product_title;?></h3>
               <?php
                  if(!empty($specifications)){
                  	foreach ($specifications as $spc_value) { ?>
               <p>
                  <?php echo $spc_value->specification_name;?> : <?php echo $spc_value->specification_val;?>
               </p>
               <?php }
                  }
                   ?>
            </div>
            <div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
               <h4>Reviews</h4>
               <?php foreach ($reviews as $rew_value) { ?>
               <div class="additional_info_sub_grids">
                  <div class="col-xs-2 additional_info_sub_grid_left">
                     <img src="<?php echo base_url().'webroot/front/images/t1.png';?>" alt=" " class="img-responsive" />
                  </div>
                  <div class="col-xs-10 additional_info_sub_grid_right">
                     <div class="additional_info_sub_grid_rightl">
                        <a href="single.html"><?php echo $rew_value->user_name;?></a>
                        <h5><?php echo $rew_value->review_updated_date;?></h5>
                        <p><?php echo $rew_value->review_description;?></p>
                     </div>
                     <div class="additional_info_sub_grid_rightr">
                        <div class="rating">
                           <?php for ($i=1; $i <= $rew_value->review_value ; $i++) {?>
                           <div class="rating-left">
                              <img src="<?php echo base_url().'webroot/front/images/star-.png';?>" alt=" " class="img-responsive">
                           </div>
                           <?php } ?>
                           <div class="clearfix"> </div>
                        </div>
                     </div>
                     <div class="clearfix"> </div>
                  </div>
                  <div class="clearfix"> </div>
               </div>
               <?php } ?>			        					            	      
            </div>
         </div>
         <script src="<?php echo base_url().'webroot/front/js/easyResponsiveTabs.js';?>" type="text/javascript"></script>
         <script type="text/javascript">
            $(document).ready(function () {
            	$('#horizontalTab1').easyResponsiveTabs({
            		type: 'default', //Types: default, vertical, accordion           
            		width: 'auto', //auto or any width like 600px
            		fit: true   // 100% fit in a container
            	});
            });
         </script>
      </div>
   </div>
   <script src="<?php echo base_url().'webroot/front/js/easyResponsiveTabs.js';?>" type="text/javascript"></script>
   <script type="text/javascript">
      $(document).ready(function () {
      	$('#horizontalTab1').easyResponsiveTabs({
      		type: 'default', //Types: default, vertical, accordion           
      		width: 'auto', //auto or any width like 600px
      		fit: true   // 100% fit in a container
      	});
      });
   </script>
</div>
</div>
<script type="text/javascript">
   $('.p_total_price input[type="radio"]').click(function() { 
     var currScore = 0;
     var attr_val_id = '';

	var inputs = document.getElementsByClassName( 'attr_attr_val' );

	names  = [].map.call(inputs, function( input ) {
	return input.id;
	});
	var j = 0; 
	for(var i=0;i<names.length;++i)
	{

		if(document.getElementById(names[i]).checked)
		{
			
			if(j < 1)
			{
				attr_val_id = names[i];				
			}
			else
			{
				attr_val_id += ','+names[i];	
			}
			j++;
		}
	}
	$('#crt_attr_val_id').val(attr_val_id);


   $('.p_total_price input[type="radio"]:checked').each(function(i, val) {
  
     var value = $(this).val();			          
     currScore = parseInt(currScore) + parseInt(value);
     
   });
  
   $('#product_totel_price').html('Rs '+currScore);
   $('#crt_product_price').val(currScore);
   
                 
   });
   
</script>