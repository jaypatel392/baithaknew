
    <div class="container">
    <br>
      	<h3>Order Details</h3>
      	<br>
		<div class="table-responsive">
      <table class="table table-bordered">
		<?php
		if(!empty($product_order_list))
		{    
		?> 
		    <thead>
		    	<th>Sr. No.</th>
		    	<th>Product image</th>
		    	<th>Product title</th>		    		    	
		    	<th>Shipping address</th>
		    	<th>Price</th>		    	
		    	<th>Sold By</th>		    	
		    	<!-- <th>Action</th>	 -->    	
		    	
		    </thead>
		    <tbody>
		    <?php   
		     $i = 1;  
		     $total_price = 0;	              
		       
		            foreach ($product_order_list as $po_val)
		            {
		            	$total_price = $po_val->product_sale_price+$total_price;
		            	?>
		            	<td><?php echo $i; ?></td>
		            	<td><img src="<?php echo $po_val->product_thumb_img; ?>" width="50" ></td>
		            	<td><a href=""><?php echo $po_val->product_title; ?></a></td>
		            	<td><?php echo $address_details[0]->country_name.' , '.$address_details[0]->state_name.' , '.$address_details[0]->user_address_city.','.$address_details[0]->user_address_1.','.$address_details[0]->user_address_2.','.$address_details[0]->user_address_postalcode; ?></td>
		            	<td><?php echo 'Rs.'.$po_val->product_sale_price; ?></td>
		            	<td><?php echo $po_val->user_name; ?></td>
		            	<!-- <td><a href="<?php echo base_url().'products/review/'.$po_val->product_id;?>"><button class="btn btn-primery btn-sm">Give Feedback</button></a></td> -->
		            	<?php
		            }            
		            ?>

						
					<?php
					$i++;					
				}
				?>	      		
		     
		    </tbody>
		    
		</table>
    </div>
  </div>
  <!-- //breadcrumbs --> 
  </div>

