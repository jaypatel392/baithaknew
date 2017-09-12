<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Home Banner<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/discount">Home Banner</a></li>
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
                    <a href="<?php echo base_url();?>admin/homeSetting/homeBanner" class="btn btn-info btn-sm">Back</a>                           
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
                    <?php foreach ($edit_banner as $bn_val) 
                    {
                     ?>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Banner Url<span class="text-danger">*</span></label>
                                <input name="home_banner_url" class="form-control" type="text" id="home_banner_url" value="<?php echo $bn_val->home_banner_url;?>" />
                                <?php echo form_error('home_banner_url','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Banner Image<span class="text-danger">*</span></label>
                               <input type="file" name="home_banner_img_name">
                            </div>
                        </div>                      
                    </div>
                    <div class="row"> 
                       
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="home_banner_status" id="home_banner_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('home_banner_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>         

                           <div class="form-group col-md-4">
                            <div class="input text">
                               <img src="<?php echo base_url().$bn_val->home_banner_img_name; ?>" width="120">
                            </div>
                        </div>                
                    </div> 
                    <?php
                    }
                    ?>                  
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="edit" value="Edit" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/homeSetting/homeBanner">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
