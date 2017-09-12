<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Special deals Banner<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i>Specialdeals</a></li>
            <li><a href="<?php echo base_url();?>admin/discount">Special deals Banner</a></li>
            <li class="active">Banner Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Banner Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/homeSetting/specialDealsBanner" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div>
                        <div id="msg_div">
                            <?php echo $this->session->flashdata('message');?>
                        </div>
                    </div>   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Banner Url<span class="text-danger">*</span></label>
                                <input name="home_sp_deals_url" class="form-control" type="text" id="home_sp_deals_url" value="<?php echo set_value('home_sp_deals_url'); ?>" />
                                <?php echo form_error('home_sp_deals_url','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Banner Image<span class="text-danger">*</span></label>
                               <input type="file" name="home_sp_deals_img_name">
                            </div>
                        </div>                      
                    </div>
                    <div class="row"> 
                       
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Status</label>
                                <select name="home_sp_deals_status" id="home_sp_deals_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('home_sp_deals_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                
                    </div>                   
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="add" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/homeSetting/homeBanner">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
