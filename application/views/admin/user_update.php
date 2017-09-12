<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Customer<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/user">Customer</a></li>
            <li class="active">Customer Update</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Customer Update</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/user" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php 
                    foreach ($user_edit as $u_res)
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
                                            <input disabled name="user_email" class="form-control" type="email" id="user_email" value="<?php echo $u_res->user_email; ?>" />
                                            <?php echo form_error('user_email','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                       
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <input name="user_name" class="form-control" type="text" id="user_name" value="<?php echo $u_res->user_name; ?>" />
                                            <?php echo form_error('user_name','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                                   
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Phone<span class="text-danger">*</span></label>
                                            <input name="user_phone" class="form-control" min="0" type="number" id="user_phone" value="<?php echo $u_res->user_phone; ?>" />
                                            <?php echo form_error('user_phone','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Status</label>
                                            <select name="user_status" id="user_status" class="form-control">
                                                <option value="1" <?php if($u_res->user_status == '1'){ echo "selected"; }?>>Active</option>
                                                <option value="0" <?php if($u_res->user_status == '0'){ echo "selected"; }?>>Deactive</option>
                                            </select>
                                            <?php echo form_error('user_status','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Drug Licence<span class="text-danger">*</span></label>
                                            <input name="drug_licence" class="form-control" type="text" id="drug_licence" value="<?php echo $u_res->drug_licence; ?>" />
                                            <?php echo form_error('drug_licence','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Shop Establishment Id<span class="text-danger">*</span></label>
                                            <input name="shop_establishment_id" class="form-control" type="text" id="shop_establishment_id" value="<?php echo $u_res->shop_establishment_id; ?>" />
                                            <?php echo form_error('shop_establishment_id','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>GST Number<span class="text-danger">*</span></label>
                                            <input name="gstn" class="form-control" min="0" type="text" id="gstn" value="<?php echo $u_res->gstn; ?>" />
                                            <?php echo form_error('gstn','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">       
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Country<span class="text-danger">*</span></label>
                                            <select class="form-control"  name="user_country_id" id="user_country_id" onchange="getStateList(this.value)">                                               
                                                <?php 
                                                    foreach ($country_list as $c_list)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $c_list->country_id; ?>" <?php if($u_res->user_country_id == $c_list->country_id){ echo "selected"; }?>><?php echo $c_list->country_name; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <?php echo form_error('user_country_id','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>    
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>State<span class="text-danger">*</span></label>
                                            <select class="form-control"  name="user_state_id" id="user_state_id">
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
                                            <?php echo form_error('user_state_id','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>City<span class="text-danger">*</span></label>
                                            <input name="user_city" class="form-control" type="text" id="user_city" value="<?php echo $u_res->user_city; ?>" />
                                            <?php echo form_error('user_city','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                   
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Address1<span class="text-danger">*</span></label>
                                            <textarea name="user_address_1" class="form-control" id="user_address_1" ><?php echo $u_res->user_address_1; ?></textarea>
                                            <?php echo form_error('user_address_1','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                   <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Address2</label>
                                            <textarea name="user_address_2" class="form-control" id="user_address_2" ><?php echo $u_res->user_address_2; ?></textarea>
                                        </div>
                                    </div> 
                                     <div class="form-group col-md-4">
                                        <div class="input text">
                                            <label>Postal Code<span class="text-danger">*</span></label>
                                            <input name="user_postal_code" class="form-control" type="text" id="user_postal_code" value="<?php echo $u_res->user_postal_code; ?>" />
                                            <?php echo form_error('user_postal_code','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <!-- /.box-body -->      
                            <div class="box-footer">
                                <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Submit</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/user">Cancel</a>
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
        var PAGE = '<?php echo base_url(); ?>admin/user/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                    $('#user_state_id').html(data);
                }
                else
                {
                    $('#user_state_id').html('<option value=""></option>');
                }
            } 
        });
    }
</script>