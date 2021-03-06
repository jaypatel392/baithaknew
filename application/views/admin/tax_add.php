<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Tax<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/tax">Tax</a></li>
            <li class="active">Tax Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Tax Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/tax" class="btn btn-info btn-sm">Back</a>                           
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
                                <label>Tax Name<span class="text-danger">*</span></label>
                                <input name="tax_name" class="form-control" type="text" id="tax_name" value="<?php echo set_value('tax_name'); ?>" />
                                <?php echo form_error('tax_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Tax Value<span class="text-danger">*</span></label>
                                <input name="tax_value" class="form-control" type="text" id="tax_value" value="<?php echo set_value('tax_value'); ?>" />
                                <?php echo form_error('tax_value','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">  
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Tax Type<span class="text-danger">*</span></label>
                                <select name="tax_type" id="tax_type" class="form-control">
                                    <option value=""></option>
                                    <option value="Percent">Percent</option>
                                    <option value="Fix">Fix</option>
                                </select>
                                <?php echo form_error('tax_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="tax_status" id="tax_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('tax_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                
                    </div>                   
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/tax">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->