<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Vendor<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/vendor">vendor</a></li>
            <li class="active">Vendor Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Vendor Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/vendor" class="btn btn-info btn-sm">Back</a>                           
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
                                <label>Name<span class="text-danger">*</span></label>
                                <input name="vendor_name" class="form-control" type="text" id="vendor_name" value="<?php echo set_value('vendor_name'); ?>" />
                                <?php echo form_error('vendor_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Email<span class="text-danger">*</span></label>
                                <input name="vendor_email" class="form-control" type="email" id="vendor_email" value="<?php echo set_value('vendor_email'); ?>" />
                                <?php echo form_error('vendor_email','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Phone<span class="text-danger">*</span></label>
                                <input name="vendor_phone" class="form-control" min="0" type="number" id="vendor_phone" value="<?php echo set_value('vendor_phone'); ?>" />
                                <?php echo form_error('vendor_phone','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                    </div>
                    <div class="row">  
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Password<span class="text-danger">*</span></label>
                                <input name="vendor_password" class="form-control" type="password" id="vendor_password" value="<?php echo set_value('vendor_password'); ?>" />
                                <?php echo form_error('vendor_password','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Confirm Password<span class="text-danger">*</span></label>
                                <input name="vendor_cpassword" class="form-control" min="0" type="password" id="vendor_cpassword" value="<?php echo set_value('vendor_cpassword'); ?>" />
                                <?php echo form_error('vendor_cpassword','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                          
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="vendor_status" id="vendor_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('vendor_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">                         
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Country<span class="text-danger">*</span></label>
                                <select class="form-control"  name="vendor_country_id" id="vendor_country_id" onchange="getStateList(this.value)">
                                    <option value=""></option>
                                    <?php 
                                        foreach ($country_list as $c_list)
                                        {
                                            ?>
                                            <option value="<?php echo $c_list->country_id; ?>"><?php echo $c_list->country_name; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <?php echo form_error('vendor_country_id','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>    
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>State<span class="text-danger">*</span></label>
                                <select class="form-control"  name="vendor_state_id" id="vendor_state_id">
                                    <option value=""></option>                                   
                                </select>
                                <?php echo form_error('vendor_state_id','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>City<span class="text-danger">*</span></label>
                                <input name="vendor_city" class="form-control" type="text" id="vendor_city" value="<?php echo set_value('vendor_city'); ?>" />
                                <?php echo form_error('vendor_city','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                   
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Address1<span class="text-danger">*</span></label>
                                <textarea name="vendor_address_1" class="form-control" id="vendor_address_1" ><?php echo set_value('vendor_address_1'); ?></textarea>
                                <?php echo form_error('vendor_address_1','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                       <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Address2</label>
                                <textarea name="vendor_address_2" class="form-control" id="vendor_address_2" ><?php echo set_value('vendor_address_2'); ?></textarea>
                            </div>
                        </div> 
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Postal Code<span class="text-danger">*</span></label>
                                <input name="vendor_postal_code" class="form-control" type="text" id="vendor_postal_code" value="<?php echo set_value('vendor_postal_code'); ?>" />
                                <?php echo form_error('vendor_postal_code','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/vendor">Cancel</a>
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
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
        });    
    });

    function getStateList(country_id)
    {
        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>admin/vendor/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#vendor_state_id').html(data);
                }
                else
                {
                    $('#vendor_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>