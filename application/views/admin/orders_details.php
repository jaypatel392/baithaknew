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
            <table id="example2" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID</th>                   
                     <th>Order Date</th>
                     <th>Total Amount</th>
                     <th>User Name</th>                    
                     <th>Order Address</th>                    
                     <th>Payment Type</th>
                     <th>Payment Status</th>
                     <th>Order Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
              <?php
             if(!empty($orders_list))
             {
              $i=1;
                 foreach($orders_list as $o_val)
                 {
                    ?>
                  <tr>
                  <td><?php echo $o_val->unic_order_id; ?></td>
                  <td><?php echo $o_val->order_date_time; ?></td>
                     <td><?php echo 'Rs '.$o_val->order_final_amt; ?></td>
                    
                     <td><?php echo $o_val->user_name;?></td>
                     <td><?php echo $o_val->user_name;?></td>
                     <td><?php echo $o_val->order_pay_type;?></td>                   
                     <td><?php if($o_val->order_payment_status == 'done'){
                      ?>
                        <b class="text-success">Success</b>
                      <?php
                      } ?>
                      </td> 
                      <td>
                        <?php 
                        if($o_val->order_track_status == 'Pending')
                        {
                        ?>
                          <span class="label label-warning" style="font-size: 14px;"><?php echo $o_val->order_track_status ?></span>
                        <?php
                        }
                        else if($o_val->order_track_status == 'Dispatched')
                        {
                         ?>
                            <span class="label label-info" style="font-size: 14px;"><?php echo $o_val->order_track_status ?></span>                        
                        <?php
                        }
                        else if($o_val->order_track_status == 'In-progress')
                        {
                         ?>
                            <span class="label label-primary" style="font-size: 14px;"><?php echo "In Progress" ?></span>                        
                        <?php
                        }
                        else if($o_val->order_track_status == 'Canceled')
                        {
                         ?>
                          <span class="label label-danger" style="font-size: 14px;"><?php echo $o_val->order_track_status ?></span>
                        <?php
                        }                        
                        else if($o_val->order_track_status == 'Delivered')
                        {
                         ?>
                          <span class="label label-success" style="font-size: 14px;"><?php echo $o_val->order_track_status ?></span>
                        <?php
                        }
                        ?>
                      </td>
                    
                      <td>
                        <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                           
                           if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                          {
                            if($o_val->order_track_status != 'Delivered' AND $o_val->order_track_status != 'Canceled')
                            {
                          ?> 

                              &nbsp;&nbsp;<a href="<?php echo base_url();?>admin/orders/changeOrderStatus/<?php echo $o_val->order_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a> 
                            <?php
                            }
                          }

                          if($this->uri->segment(2) == $role->controller_name && $role->userView == '1')
                          {
                          ?>
                              <a href="<?php echo base_url();?>admin/orders/orderDetails/<?php echo $o_val->order_id; ?>" title="View"><i class="fa fa-eye fa-2x "></i></a>
                              &nbsp;&nbsp;                               
                               <a href="<?php echo base_url();?>admin/orders/orderInvoicePdf/<?php echo $o_val->order_id; ?>" title="PDF"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a>
                          <?php
                          }
                        }
                        ?>  
                      </td>
                  </tr>
                  <?php
                  $i++;
                     }
                     }
                     ?>
               </tbody>
            </table>
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