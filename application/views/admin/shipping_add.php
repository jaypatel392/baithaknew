<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Shipping<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/shipping">shipping</a></li>
            <li class="active">shipping Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Shipping Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/shipping" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" onsubmit="return check_shipping()" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Shipping Name<span class="text-danger">*</span></label>
                                <input name="shipping_name" class="form-control" type="text" id="shipping_name" value="<?php echo set_value('shipping_name'); ?>" />
                                <?php echo form_error('shipping_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Shipping Value<span class="text-danger">*</span></label>
                                <input name="shipping_value" class="form-control" type="number" id="shipping_value" value="<?php echo set_value('shipping_value'); ?>" />
                                <?php echo form_error('shipping_value','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Shipping Type<span class="text-danger">*</span></label>
                                <select name="shipping_type"  id="shipping_type" class="form-control" onchange="show_multiply_value(this.value)">
                                    <option value=""></option>
                                    <option value="Percent">Percent</option>
                                     <option value="multiply">Multiply</option>
                                    <option value="Fix">Fix</option>
                                </select>
                                <?php echo form_error('shipping_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                       
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="shipping_status" id="shipping_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('shipping_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                
                    </div> 

                     <div class="row" style="display: none;" id="shipping_multiply_box" >   
                      <div class="form-group col-md-4" >
                            <div class="input text">
                                <label>Multiply Type<span class="text-danger">*</span></label>
                               
                               <select name="shipping_multiply_type" id="shipping_multiply_type" class="form-control">
                                   <option value=""></option>
                                   <option value="count">Count</option>
                                   <option value="weight">Weight</option>
                                   <option value="distance">Distance</option>
                               </select>
                               <span id="error_shipping_multiply_type" style="color: red;"></span>
                            </div>
                        </div>                  
                
                   <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Multiply value<span class="text-danger">*</span></label>
                               <input type="text" name="shipping_multiply_value" id="shipping_multiply_value" class="form-control">
                               <span id="error_shipping_multiply_value" style="color: red;"></span>
                            </div>
                        </div>                  
                  </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/shipping">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
 
 function show_multiply_value(str){

     if(str == 'multiply'){
        $('#shipping_multiply_box').show();        
     }else{
       $('#shipping_multiply_box').hide();
     }
 }

 function check_shipping(){

      if($('#shipping_type').val() == 'multiply'){

         if($('#shipping_multiply_type').val() == ''){
               $('#error_shipping_multiply_type').html('Multiply type is required');
               document.getElementById('shipping_multiply_type').style.border='1px solid red';
               return false;
           }else{
            $('#error_shipping_multiply_type').html('');
            document.getElementById('shipping_multiply_type').style.border='1px solid gray';
           
           }

          if($('#shipping_multiply_value').val() == ''){
               $('#error_shipping_multiply_value').html('Multiply value is required');
               document.getElementById('shipping_multiply_value').style.border='1px solid red';
               return false;
           }else{
            if (!$.isNumeric(multiply_value)){
                
                $('#error_shipping_multiply_value').html('Multiply value is must be numeric!');
               document.getElementById('shipping_multiply_value').style.border='1px solid red';
               return false;
            }else{
                
            $('#error_shipping_multiply_value').html('');
            document.getElementById('shipping_multiply_value').style.border='1px solid gray';
            return true;
             }
           }
    }else{      
        return true;
     }
}
</script>