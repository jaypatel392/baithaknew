<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Discount<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/discount">Discount</a></li>
            <li class="active">Discount Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Discount Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/discount" class="btn btn-info btn-sm">Back</a>                           
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
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Discount Name<span class="text-danger">*</span></label>
                                <input name="discount_name" class="form-control" type="text" id="discount_name" value="<?php echo set_value('discount_name'); ?>" />
                                <?php echo form_error('discount_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Discount Value<span class="text-danger">*</span></label>
                                <input name="discount_value" class="form-control" type="text" id="discount_value" value="<?php echo set_value('discount_value'); ?>" />
                                <?php echo form_error('discount_value','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Discount Type<span class="text-danger">*</span></label>
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option value=""></option>
                                    <option value="Percent">Percent</option>
                                    <option value="Fix">Fix</option>
                                </select>
                                <?php echo form_error('discount_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-4">                           
                            <label>Discount Start Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='discount_start_date'>
                                <input type="text" class="form-control" name="discount_start_date" id="discount_start_date" placeholder="" value="" onkeyup="validate_form_onchange('discount_start_date', this.value)">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <?php echo form_error('discount_start_date','<span class="text-danger">','</span>'); ?>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Discount End Date<span class="text-danger">*</span></label>
                            <div class='input-group date' id='discount_end_date'>
                                <input type="text" class="form-control" name="discount_end_date" id="discount_end_date" placeholder="" value="" onkeyup="validate_form_onchange('discount_end_date', this.value)">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <?php echo form_error('discount_end_date','<span class="text-danger">','</span>'); ?>
                        </div>  
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="discount_status" id="discount_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('discount_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                
                    </div>                   
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/discount">Cancel</a>
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
       
         

        $('#discount_start_date').datetimepicker({
            format: 'Y-M-D'
        });
        $('#discount_end_date').datetimepicker({
            useCurrent: false,
            format: 'Y-M-D'
        });
        $("#discount_start_date").on("dp.change", function (e) {
            $('#discount_end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#discount_end_date").on("dp.change", function (e) {
            $('#discount_start_date').data("DateTimePicker").maxDate(e.date);
        });  
    });
</script>