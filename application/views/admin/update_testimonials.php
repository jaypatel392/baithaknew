<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Testimonial<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/homeSetting/testimonials">Testimonial</a></li>
            <li class="active">Testimonial Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Testimonial Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/homeSetting/testimonials" class="btn btn-info btn-sm">Back</a>                           
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
                    <?php
                    foreach ($edit_testimonials as $t_val)
                    {
                     
                    ?>  
                    <div class="row">
                       <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Testimonials Title<span class="text-danger">*</span></label>
                               <input type="text" name="testimonial_name" value="<?php echo $t_val->testimonial_name; ?>" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Image<span class="text-danger">*</span></label>
                               <input type="file" name="testimonial_img">
                            </div>
                        </div>  
                         <div class="form-group col-md-6">
                            <div class="input text">
                               <img width="80" src="<?php echo base_url().$t_val->testimonial_img; ?>">
                            </div>
                        </div>                               
                    </div>
                    <div class="row"> 
                         <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Testimonial Description<span class="text-danger">*</span></label>
                               <textarea name="testimonial_description" rows="4" class="form-control"><?php echo $t_val->testimonial_description; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Status</label>
                                <select name="testimonial_status" id="testimonial_status" class="form-control">
                                    <option <?php if($t_val->testimonial_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($t_val->testimonial_status == '0'){ echo "selected"; } ?> value="0">Deactive</option>
                                </select>                              
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
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/homeSetting/testimonials">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
