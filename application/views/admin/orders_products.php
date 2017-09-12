<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>  
         Orders<small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Orders</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="box">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title">Orders Details</h3>
            </div>
          
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div>
               <div id="msg_div">
                  <?php echo $this->session->flashdata('message');?>
               </div>
            </div>
          
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-5">
                   <div class="bg-custom-color">
                     <h4>Delivery Address</h4>
                  </div> 
                  
                    <div class="address_details"><?php echo 'Name: '.$delivery_address->user_address_name.'<br> Address: '.$delivery_address->user_address_1.','; if($delivery_address->user_address_2 != ''){ echo $delivery_address->user_address_2.','; } 
                    echo $delivery_address->user_address_city.',<br>'.$delivery_address->state_name.','.$delivery_address->user_address_postalcode.'<br>' ; ?>
                    Phone : <?php echo $delivery_address->user_address_mobile; ?><br>
                    GST Number : <?php echo $order_details->gstn; ?><br>
                    Drug Licence : <?php echo $order_details->drug_licence; ?><br>
                    Shop Establishment Id : <?php echo $order_details->shop_establishment_id; ?></div>                    
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                   <div class="bg-custom-color"><h4>Delivery Address</h4>
                  </div>   
                  
                  <div class="address_details">
                      <?php echo 'Name: '.$billing_address->user_address_name.'<br> Address: '.$billing_address->user_address_1.','; if($billing_address->user_address_2 != ''){ echo $billing_address->user_address_2.','; } 
                      echo $billing_address->user_address_city.',<br>'.$billing_address->state_name.','.$billing_address->user_address_postalcode.'<br>' ; ?>
                      Phone : <?php echo $billing_address->user_address_mobile; ?><br>
                      GST Number : <?php echo $order_details->gstn; ?><br>
                      Drug Licence : <?php echo $order_details->drug_licence; ?><br>
                      Shop Establishment Id : <?php echo $order_details->shop_establishment_id; ?>
                  </div>                       
                </div>
              </div>
            </div>
            <br>
            <table id="example2" class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th></th>
                    <th>Product Name</th>
                    <th>Qty.</th>
                    <th>Price (Exc. tax)</th>
                    <th>Price (Inc. tax)</th>
                    <th>Total Price (Exc. tax)</th>          
                  </tr>
               </thead>
               <tbody>
              <?php
             if(!empty($order_products))
             { 
                  $total_p_price= 0;
                  $sub_total = 0;
                  $tax_per_array = array();
                  $i = 0;
                 foreach($order_products as $op_res)
                 {  
                      $base_price = $op_res->main_price;
                      if($op_res->discount_value != 0)
                      {
                        if($op_res->discount_type == 'Fix')
                        {
                           $base_price = $op_res->main_price-$op_res->discount_value;
                        }
                        else
                        {
                           $base_price =  $op_res->main_price-($op_res->main_price * $op_res->discount_value)/100;
                        }
                      }    
                      $total_p_price = $base_price*$op_res->cart_product_qty;
                      $tax_per_array[] = $op_res->tax_value; 
                      $product_price[] = $base_price; 
                      $tax_price[] = $total_p_price+($total_p_price * $op_res->tax_value)/100-$total_p_price;  
                      $sub_total = $sub_total+$total_p_price;             
                      ?>
                    <tr>                
                    <td width="10%"><img width="80" src="<?php echo $op_res->product_thumb_img; ?>"></td>
                        <td><?php echo $op_res->product_title.' ('.$op_res->product_formula.')';
                          if($op_res->discount_value != 0)
                            {
                              ?>
                              <div style="margin-top: 5px; padding: 3px;">
                              (<?php
                              if($op_res->discount_type == 'Fix')
                              {
                                echo 'Rs. '.$op_res->discount_value;
                              }
                              else
                              {
                                echo $op_res->discount_value.'%';
                              }
                              ?> Discount)</div>
                              <?php
                            }
                           ?>
                        </td>       
                       <td><?php echo $op_res->cart_product_qty; ?></td>       
                       <td><?php echo 'Rs. '.number_format((float)$base_price, 2, '.', ''); ?></td>       
                        <td><?php echo 'Rs. '.number_format((float)$op_res->cart_total_price, 2, '.', ''); ?></td>
                       <td><?php echo 'Rs. '.number_format((float)$total_p_price, 2, '.', ''); ?></td>       
                      
                    </tr>
                    <?php
                    $i++;
                }
                $tax_unic_array = array_unique($tax_per_array); 
                foreach($tax_unic_array as $tu_val)
                {
                    $t_price = 0;
                    $count_arr = array_keys($tax_per_array,$tu_val);      
                    // $tax_group_array[] = $tu_val * sizeof($count_arr);
                foreach ($count_arr as $ak_val) 
                {
                    $t_price = $t_price+$tax_price[$ak_val];
                }
                    $main_array[] = array('Price'=>$t_price,'Tax_value'=>$tu_val); 
                }
           ?>
            </tbody>
            </table>
            <br>
            <table class="table">              
               <tbody>
                  <tr style="text-align: left; font-size: 15px; line-height: 27px;">
                    <td>
                       <div class="col-md-offset-8 col-md-4" style="background: #f3f4f5; padding: 5px; font-weight: 600; font-size: 16px;">
                        <div class="col-md-6" style="padding-left: 26px;">Subtotal : </div>
                        <div class="col-md-6" style="padding-left: 60px;"><?php echo 'Rs. '.number_format((float)$sub_total, 2, '.', ''); ?> </div>
                      </div> 
                      <?php $total_tax_price=0;

                      foreach ($main_array as $mtp_res) 
                      {        
                        $total_tax_price = $total_tax_price+$mtp_res['Price'];
                        if(1492 == $delivery_address->user_address_state_id)
                        {
                          for ($i=0; $i < 2; $i++) 
                          { 
                            if($i == 0)
                            {
                            ?>
                                <div class="col-md-offset-8 col-md-6" style="padding-right: 100px;">
                                  <div class="col-md-6" style="line-height: 30px;">CGST <?php echo '@'.$mtp_res['Tax_value']/2; ?>% :</div>
                                  <div class="col-md-6" style="line-height: 30px;"><?php echo 'Rs. '.number_format((float)$mtp_res['Price']/2, 2, '.', ''); ?></div>
                                </div>
                              <?php
                              }
                              else
                              {
                              ?> 
                                <div class="col-md-offset-8 col-md-6" style="padding-right: 100px;">
                                  <div class="col-md-6" style="line-height: 30px;">SGST <?php echo '@'.$mtp_res['Tax_value']/2; ?>% : </div>
                                  <div class="col-md-6" style="line-height: 30px;"><?php echo 'Rs. '.number_format((float)$mtp_res['Price']/2, 2, '.', ''); ?></div>
                                </div> 
                               <?php
                              }
                            }
                          }
                          else
                          {
                            ?>
                            <div class="col-md-offset-8 col-md-6" style="padding-right: 100px;">
                                  <div class="col-md-6" style="line-height: 30px;">IGST <?php echo '@'.$mtp_res['Tax_value']; ?>% : </div>
                                  <div class="col-md-6" style="line-height: 30px;"><?php echo 'Rs. '.number_format((float)$mtp_res['Price'], 2, '.', ''); ?></div>
                                </div> 
                            <?php
                          }      
                        }
                        $grand_total = $sub_total+$total_tax_price; 
                      ?>
                      <div class="col-md-offset-8 col-md-4" style="background: #3c8dbc; padding: 5px; color: #fff; font-weight: 600; font-size: 16px;">
                        <div class="col-md-6" style="padding-left: 26px;">Total : </div>
                        <div class="col-md-6" style="padding-left: 60px;"><?php echo 'Rs. '.number_format((float)$grand_total, 2, '.', ''); ?> /-</div>
                      </div>
                    </td>
                  </tr>
               </tbody>

            </table>
           <?php
          }
           ?>
         </div>
         <!-- /.box-body -->
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
   function delete_discount(discount_id)
   {
       bootbox.confirm("Are you sure you want to delete discount details",function(confirmed){
           if(confirmed)
           {
               location.href="<?php echo base_url();?>admin/discount/delete_discount/"+discount_id;
           }
       });
   }    
</script>>