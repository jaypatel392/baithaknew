<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Coupon<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/coupon">Coupon</a></li>
            <li class="active">Coupon Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Coupon Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/coupon" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-5">
                            <div class="input text">
                                <label>Coupon Code<span class="text-danger">*</span></label>
                                <input name="coupon_code" class="form-control" type="text" id="coupon_code" value="<?php echo set_value('coupon_code'); ?>" />
                                <?php echo form_error('coupon_code','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <div class="input text">
                                <label>Coupon Value<span class="text-danger">*</span></label>
                                <input name="coupon_value" class="form-control" type="text" id="coupon_value" value="<?php echo set_value('coupon_value'); ?>" />
                                <?php echo form_error('coupon_value','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Coupon Start Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='coupon_start_date'>
                                <input type="text" class="form-control" name="coupon_start_date" id="coupon_start_date" placeholder="" value="" onkeyup="validate_form_onchange('coupon_start_date', this.value)">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <?php echo form_error('coupon_start_date','<span class="text-danger">','</span>'); ?>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Coupon End Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='coupon_end_date'>
                                <input type="text" class="form-control" name="coupon_end_date" id="coupon_end_date" placeholder="" value="" onkeyup="validate_form_onchange('coupon_end_date', this.value)">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <?php echo form_error('coupon_end_date','<span class="text-danger">','</span>'); ?>
                        </div>                        
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-5">
                            <div class="input text">
                                <label>Coupon Type<span class="text-danger">*</span></label>
                                <select name="coupon_type" id="coupon_type" class="form-control">
                                    <option value=""></option>
                                    <option value="Percent">Percent</option>
                                    <option value="Fix">Fix</option>
                                </select>
                                <?php echo form_error('coupon_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                        <div class="form-group col-md-5">
                            <div class="input text">
                                <label>Send Code</label>
                                <select name="send_code_type" id="send_code_type" class="form-control">
                                    <option value="all">All User</option>
                                    <option value="custom">Selected User</option>
                                </select>
                            </div>
                        </div>                
                    </div>
                    <table class="table">
                        <tr>
                            <th style="width: 10px"><input type="checkbox" id="all_checked"></th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Contact no.</th>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="send_user_id[]"></td>
                            <td>Update software</td>
                            <td>                              
                            </td>
                            <td></td>
                        </tr>                      
                    </table>
                                          
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/coupon">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
    $(function () {          

       $('#coupon_start_date').datetimepicker({
           minDate:new Date(),
           format: 'Y-M-D'
       });
       $('#coupon_end_date').datetimepicker({
           useCurrent: false,
           format: 'Y-M-D'
       });
       $("#coupon_start_date").on("dp.change", function (e) {
           $('#coupon_end_date').data("DateTimePicker").minDate(e.date);
       });
       $("#coupon_end_date").on("dp.change", function (e) {
           $('#coupon_start_date').data("DateTimePicker").maxDate(e.date);
            
       });  
   });
</script>>