<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Profile<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
           <li class="active">Profile Update</li>
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
                    <h3 class="box-title">Profile Update</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/dashboard" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php 
                    foreach ($user_details as $value)
                    {
                        ?>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input text">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input name="user_email" disabled class="form-control" type="text" id="user_email" value="<?php echo $value->user_email; ?>" />
                                            <?php echo form_error('user_email','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div>  
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input text">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <input name="user_name" class="form-control" type="text" id="user_name" value="<?php echo $value->user_name; ?>" />
                                            <?php echo form_error('user_name','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input text">
                                            <label>Phone<span class="text-danger">*</span></label>
                                            <input name="user_phone" class="form-control" min="0" type="number" id="user_phone" value="<?php echo $value->user_phone; ?>" />
                                            <?php echo form_error('user_phone','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <div class="input text">
                                            <label>Password</label>
                                            <input name="user_password" class="form-control" type="password" id="user_password" value="<?php echo set_value('user_password'); ?>" />
                                            <?php echo form_error('user_password','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="input text">
                                            <label>Confirm Password</label>
                                            <input name="user_cpassword" class="form-control" type="password" id="user_cpassword" value="<?php echo set_value('user_cpassword'); ?>" />
                                            <?php echo form_error('user_cpassword','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div> 
                                </div>  
                            </div>
                            <!-- /.box-body -->      
                            <div class="box-footer">
                                <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Profile" >Update Profile</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/dashboard">Cancel</a>
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