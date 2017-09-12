
    <div class="container">
    <br><br>
      	<h3 style="text-align: center;">Order History</h3>
      	<br>
	<div class="table-responsive" style="width: 80%;margin: 0px auto;">
     
		<?php
		if(!empty($orders_list))
		{ 
	      foreach ($orders_list as $o_val) 	
	      {	

			$dateString = $o_val->order_date_time;
  			$newDateString = date_format(date_create_from_format('Y-m-d H:i:s', $dateString), 'd M Y H:i:s');
			?> 
				<table class="table table-bordered">

					<thead style="border-bottom: 1px solid #ddd;">
					<th colspan="2" style="border:0px solid;">Order Id : <?php echo $o_val->unic_order_id?><br>Order Date : <?php echo $newDateString; ?></th>
					<th><b>Status : </b>
					<?php  
					// if($po_val->product_status == 1){
					// 	echo "successfull";
					// }
					// else
					// {
					// 	echo "failed";
					// } 
					?>
					</thead>
					<tbody>
					<?php		      	
					$product_order_list = $this->products_model->getOrderProductById($o_val->order_id);        

					foreach ($product_order_list as $po_val)
					{						
					          
					?>
							<tr>

							<td style="border:0px solid;"><img style="width: 150px;height: 150px;float:left;margin-top: 0px;" src="<?php echo $po_val->product_thumb_img ?>"><p style="font-size: 16px;"></td>
							&nbsp;&nbsp;
							<td>
								<b><?php echo $po_val->product_title ?></b>&nbsp;&nbsp;
								<!-- <br>Color:Black</p> --><br>							
								<?php

								if($po_val->product_attr_id)
								{
									$attr_arry = explode(',',$po_val->product_attr_id);
									for ($j=0; $j < count($attr_arry); $j++)
									{ 
										$attr_arry_val = explode('_',$attr_arry[$j]);
										$attr_res = $this->products_model->getProductAttrDetails($attr_arry_val[0]);
										$attr_val_res = $this->products_model->getProductAttrValueDetails($attr_arry_val[1]);
										$k=0; 
										foreach ($attr_res as  $attr_val)
										{
											echo $attr_val->attr_name.' -> '.$attr_val_res[$k]->attr_value.' -> '.'Rs. '.$attr_val_res[$k]->attr_price.'<br>';
											echo 'Total Amount ->'.'Rs. '.$orders_list[0]->order_total_amt;
											$k++;
										}
									}
								}

								?>
							</td>
							<td style="text-align: center;border:0px solid;">
							<a href="javascript:void" data-toggle="modal" data-target="#myModal">Write Review</a><br>
								
							</td>
							
						</tr>	
						<?php
						}
						?>				   		

					</tbody>
				</table>
		    <?php
			}
		}
		    ?>
		
    </div>
    <div id="myModal" class="modal  fade" role="dialog">
		  <div class="modal-dialog" style="max-width: 400px;">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		      	<button type="button" class="close" data-dismiss="modal">&times;</button>
		      	<h4 class="modal-title text-center">Rate Our Products</h4>
		      </div>
		      <div class="modal-body text-center">
		        <p>*****</p>
		        <form>
		        	<textarea rows="5" style="width: 100%;padding: 15px;" placeholder="Write Your Comments Here..."></textarea>
		        </form>
		      </div>
		      <div class="modal-footer" style="text-align: center;">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
		      </div>
		    </div>

		  </div>
	</div>
  </div>
 

  