<!-- newsletter -->
	<div class="newsletter">
		<div class="container">
			<div class="col-md-6 w3agile_newsletter_left">
				<h3>Newsletter</h3>
				<p>Excepteur sint occaecat cupidatat non proident, sunt.</p>
			</div>
			<div class="col-md-6 w3agile_newsletter_right">
				<form action="#" method="post">
					<input type="email" name="Email" placeholder="Email" required="">
					<input type="submit" value="" />
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //newsletter -->
	<!-- footer -->
	<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-3 w3_footer_grid">
					<h3>Contact</h3>
					<p>Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>403,
						Pukhraj Corporate <span>Indore.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@abc.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>+1234 567 567</li>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Information</h3>
					<ul class="info"> 
						<!-- <li><a href="<?php echo base_url();?>about">About Us</a></li> -->
						<li><a href="<?php echo base_url();?>sendmail">Contact Us</a></li>
						<!-- <li><a href="#">Short Codes</a></li> -->
						<!-- <li><a href="#">FAQ's</a></li> -->						
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Category</h3>
					<ul class="info"> 
					<?php foreach ($topCategories as $value) { ?>
						
					
						
						<li><a href="<?php echo base_url().'products/productsBycategories/'.base64_encode($value->category_id);?>"><?php echo $value->category_name;?></a></li>

						<?php  } ?>
					</ul>
				</div>
				<div class="col-md-3 w3_footer_grid">
					<h3>Profile</h3>
					<ul class="info"> 
						<li><a href="<?php echo base_url();?>">Home</a></li>
						<!-- <li><a href="">Today's Deals</a></li> -->
					</ul>
					<h4>Follow Us</h4>
					<div class="agileits_social_button">
						<ul>
							<li><a href="#" class="facebook"> </a></li>
							<li><a href="#" class="twitter"> </a></li>
							<li><a href="#" class="google"> </a></li>
							<li><a href="#" class="pinterest"> </a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-copy">
			<div class="footer-copy1">
				<div class="footer-copy-pos">
					<a href="#home1" class="scroll"><img src="<?php echo base_url();?>webroot/front/images/arrow.png" alt=" " class="img-responsive" /></a>
				</div>
			</div>
			<div class="container">
				<p>&copy; 2017 Party-Shaarty. All rights reserved</p>
			</div>
		</div>
	</div>
	<!-- //footer --> 
	

    <script type="text/javascript">

    	function productAddToCart(product_id,category_id=''){

        <?php
         $session = $this->session->all_userdata();	
	  if(empty($session[0]))
	  {	 ?>
	    //$('#myModal88').modal('show');return false;
	<?php } ?>
        var str = 'product_id='+product_id;
        //alert(category_id); return false;
        var PAGE = '<?php echo base_url();?>products/productAddToCart';        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            cache: false,	     		     
            success:function(data)
            { 
             if(data){
               $('#add_crt_btn'+product_id).html('<a href="<?php echo base_url();?>products/viewCart"><button type="button" class="w3ls-cart">Go to cart</button></a>');
              }
            }
        });
    }

    function removeCartItem(cart_id){
      
    	var str = 'cart_id='+cart_id;        
        var PAGE = '<?php echo base_url();?>products/removeCartItem';        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            cache: false,		     
            success:function(data)
            { 
            	//alert(data); return false;
             if(data){
             	window.location.href='<?php echo base_url();?>products/viewCart';
             }
            }
        });
    }

   function updateCartProductqty(qty_value,cart_id,cart_product_price){

  // 	alert(cart_product_price);return false;
   	   var str = 'cart_id='+cart_id+'&qty_value='+qty_value;        
        var PAGE = '<?php echo base_url();?>products/updateCartProductqty';        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            cache: false,		     
            success:function(data)
            { 
            	//alert(data); return false;
             if(data){
                window.location.href='<?php echo base_url();?>products/viewCart'
             }
            }
        });

   }
 </script>
	<!-- //cart-js -->   
</body>
</html>