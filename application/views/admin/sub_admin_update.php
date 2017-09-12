<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Sub Admin<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/sub_admin">Sub Admin</a></li>
            <li class="active">Sub Admin Update</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Sub Admin Update</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/sub_admin" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php 
                    foreach ($sub_admin_edit as $u_res)
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
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input disabled name="sub_admin_email" class="form-control" type="email" id="sub_admin_email" value="<?php echo $u_res->user_email; ?>" />
                                            <?php echo form_error('sub_admin_email','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                        
                                                 
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <input name="sub_admin_name" class="form-control" type="text" id="sub_admin_name" value="<?php echo $u_res->user_name; ?>" />
                                            <?php echo form_error('sub_admin_name','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                                   
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Phone<span class="text-danger">*</span></label>
                                            <input name="sub_admin_phone" class="form-control" min="0" type="number" id="sub_admin_phone" value="<?php echo $u_res->user_phone; ?>" />
                                            <?php echo form_error('sub_admin_phone','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Status</label>
                                            <select name="sub_admin_status" id="sub_admin_status" class="form-control">
                                                <option value="1" <?php if($u_res->user_status == '1'){ echo "selected"; }?>>Active</option>
                                                <option value="0" <?php if($u_res->user_status == '0'){ echo "selected"; }?>>Deactive</option>
                                            </select>
                                            <?php echo form_error('sub_admin_status','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">                         
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Country<span class="text-danger">*</span></label>
                                            <select class="form-control"  name="sub_admin_country_id" id="sub_admin_country_id" onchange="getStateList(this.value)">
                                                <option value=""></option>
                                                <?php 
                                                    foreach ($country_list as $c_list)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $c_list->country_id; ?>" <?php if($u_res->user_country_id == $c_list->country_id){ echo "selected"; }?>><?php echo $c_list->country_name; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <?php echo form_error('sub_admin_country_id','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>    
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>State<span class="text-danger">*</span></label>
                                            <select class="form-control"  name="sub_admin_state_id" id="sub_admin_state_id">
                                                <option value=""></option> 
                                                <?php 
                                                    foreach ($state_list as $s_list)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $s_list->state_id; ?>" <?php if($u_res->user_state_id == $s_list->state_id){ echo "selected"; }?>><?php echo $s_list->state_name; ?></option>
                                                        <?php
                                                    }
                                                ?>                                 
                                            </select>
                                            <?php echo form_error('sub_admin_state_id','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>City<span class="text-danger">*</span></label>
                                            <input name="sub_admin_city" class="form-control" type="text" id="sub_admin_city" value="<?php echo $u_res->user_city; ?>" />
                                            <?php echo form_error('sub_admin_city','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Address1<span class="text-danger">*</span></label>
                                            <textarea name="sub_admin_address_1" class="form-control" id="sub_admin_address_1" ><?php echo $u_res->user_address_1; ?></textarea>
                                            <?php echo form_error('sub_admin_address_1','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                   <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Address2</label>
                                            <textarea name="sub_admin_address_2" class="form-control" id="sub_admin_address_2" ><?php echo $u_res->user_address_2; ?></textarea>
                                        </div>
                                    </div> 
                                     <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Postal Code<span class="text-danger">*</span></label>
                                            <input name="sub_admin_postal_code" class="form-control" type="text" id="sub_admin_postal_code" value="<?php echo $u_res->user_postal_code; ?>" />
                                            <?php echo form_error('sub_admin_postal_code','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <!-- /.box-body -->      
                            <div class="box-footer">
                                <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit">Submit</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/subAdmin">Cancel</a>
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
       
        $('#emp_dob_i').datetimepicker({
             format: 'Y-M-D'
        });    
    });

    function getStateList(country_id)
    {
        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>admin/subAdmin/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#sub_admin_state_id').html(data);
                }
                else
                {
                    $('#sub_admin_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>