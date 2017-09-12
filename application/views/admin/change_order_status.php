<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>  
         Order<small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>admin/brand">Order</a></li>
         <li class="active">Order Update</li>
      </ol>
   </section>
   <div>
      <div id="msg_div">
         <?php echo $this->session->flashdata('message');?>
      </div>
   </div>
   <!-- Main content -->
   <section class="content">
      <div class="box">
         <div class="box-header">
            <div class="pull-left">
               <h3 class="box-title">Order Update</h3>
            </div>
            <div class="pull-right box-tools">
               <a href="<?php echo base_url();?>admin/brand" class="btn btn-info btn-sm">Back</a>                           
            </div>
         </div>
         <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <?php
            foreach($orders_details as $res)
            {

            ?>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label>Order ID</label>
                        <input type="text" disabled="disabled" class="form-control" value="<?php echo $res->unic_order_id; ?>" >
                     </div>
                  </div>
                  <div class="form-group col-md-6">
                     <div class="input text">
                        <label>Order Description</label>
                        <select class="form-control" name="order_track_status">
                            <option <?php if($res->order_track_status == 'Pending'){ echo "selected";} ?> value="Pending">Pending</option>
                            <option <?php if($res->order_track_status == 'In-progress'){ echo "selected";} ?> value="In-progress">In progress</option>
                            <option <?php if($res->order_track_status == 'Dispatched'){ echo "selected";} ?> value="Dispatched">Dispatched</option>
                            <option <?php if($res->order_track_status == 'Canceled'){ echo "selected";} ?> value="Canceled">Cancel</option>
                            <option <?php if($res->order_track_status == 'Delivered'){ echo "selected";} ?> value="Delivered">Delivered</option>
                        </select>
                     </div>
                  </div>
               </div>              
            <!-- /.box-body -->      
            <div class="box-footer">
               <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Update</button>
               <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/orders">Cancel</a>
            </div>
            <?php } ?>
         </form>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->