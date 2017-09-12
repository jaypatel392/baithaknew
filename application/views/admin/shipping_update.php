<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Shipping<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/shipping">Shipping</a></li>
            <li class="active">Shipping Update</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Shipping Update</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/shipping" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" onsubmit="return check_shipping()" accept-charset="utf-8" enctype="multipart/form-data">
                <?php 
                    foreach ($shipping_edit as $value)
                    {
                        ?>
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
                                            <input name="shipping_name" class="form-control" type="text" id="shipping_name" value="<?php echo $value->shipping_name; ?>" />
                                            <?php echo form_error('shipping_name','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>shipping Value<span class="text-danger">*</span></label>
                                            <input name="shipping_value" class="form-control" type="text" id="shipping_value" value="<?php echo $value->shipping_value; ?>" />
                                            <?php echo form_error('shipping_value','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">  
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>shipping Type<span class="text-danger">*</span></label>
                                             <select name="shipping_type"  id="shipping_type" class="form-control" onchange="show_multiply_value(this.value)">
                                                <option value=""></option>
                                                <option value="Percent" <?php if($value->shipping_type == 'Percent'){ echo "selected"; } ?>>Percent</option>
                                                 <option value="multiply" <?php if($value->shipping_type == 'multiply'){ echo "selected"; } ?>>Multiply</option>
                                                <option value="Fix" <?php if($value->shipping_type == 'Fix'){ echo "selected"; } ?>>Fix</option>
                                            </select>
                                            <?php echo form_error('shipping_type','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Status</label>
                                            <select name="shipping_status" id="shipping_status" class="form-control">
                                                <option value="1" <?php if($value->shipping_status == '1'){ echo "selected"; } ?>>Active</option>
                                                <option value="0" <?php if($value->shipping_status == '0'){ echo "selected"; } ?>>Deactive</option>
                                            </select>
                                            <?php echo form_error('shipping_status','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                
                                </div>    
                                 <div class="row" <?php if($value->shipping_type == 'multiply'){ echo "style='display: block;' "; }else{ echo "style='display: none;' "; } ?> id="shipping_multiply_box" >   
                                 <div class="form-group col-md-4" >
                                    <div class="input text">
                                        <label>Multiply Type<span class="text-danger">*</span></label>
                                       
                                       <select name="shipping_multiply_type" id="shipping_multiply_type" class="form-control">
                                           <option value=""></option>
                                           <option value="count" <?php if($value->shipping_multiply_type == 'count'){ echo "selected"; } ?>>Count</option>
                                           <option value="weight" <?php if($value->shipping_multiply_type == 'weight'){ echo "selected"; } ?>>Weight</option>
                                           <option value="distance" <?php if($value->shipping_multiply_type == 'distance'){ echo "selected"; } ?>>Distance</option>
                                       </select>
                                       <span id="error_shipping_multiply_type" style="color: red;"></span>
                                    </div>
                                </div>                  
                
                               <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Multiply value<span class="text-danger">*</span></label>
                                           <input type="text" name="shipping_multiply_value" id="shipping_multiply_value" value="<?php echo $value->shipping_multiply_value ;?>" class="form-control">
                                           <span id="error_shipping_multiply_value" style="color: red;"></span>
                                        </div>
                                    </div>                  
                              </div>               
                            </div>
                            <!-- /.box-body -->      
                            <div class="box-footer">
                                <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Submit</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/shipping">Cancel</a>
                            </div>
                        <?php
                    }
                ?>
                
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
    $(function () {
       
        $('#shipping_start_date').datetimepicker({
             format: 'Y-M-D'
        });  
         $('#shipping_end_date').datetimepicker({
             format: 'Y-M-D'
        });    
    });
</script>

<script type="text/javascript">
 
 function show_multiply_value(str){

     if(str == 'multiply'){
        $('#shipping_multiply_box').show();        
     }else{
       $('#shipping_multiply_box').hide();
       $('#shipping_multiply_type').val('');
       $('#shipping_multiply_value').val('');
     }
 }

 function check_shipping(){
  
      if($('#shipping_type').val() == 'multiply'){
       var multiply_value = $('#shipping_multiply_value').val();

         if($('#shipping_multiply_type').val() == ''){
               $('#error_shipping_multiply_type').html('Multiply type is required');
               document.getElementById('shipping_multiply_type').style.border='1px solid red';
               return false;
           }else{
            $('#error_shipping_multiply_type').html('');
            document.getElementById('shipping_multiply_type').style.border='1px solid gray';     
          }

          if(multiply_value == ''){
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