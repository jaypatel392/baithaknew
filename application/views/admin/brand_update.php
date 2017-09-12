<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>	

			Brand<small>Control panel</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="<?php echo base_url();?>admin/brand">Brand</a></li>

            <li class="active">Brand Edit</li>

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

                    <h3 class="box-title">Brand Add</h3>

                </div>

                <div class="pull-right box-tools">

                    <a href="<?php echo base_url();?>admin/brand" class="btn btn-info btn-sm">Back</a>                           

                </div>

            </div>

            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">

             <?php

                    foreach($brand_edit as $res)

                    {

                        ?>

                <!-- /.box-header -->

                <div class="box-body">

                    <div class="row">

                        <div class="form-group col-md-6">

                            <div class="input text">

                                <label>Brand Name<span class="text-danger">*</span></label>

                                <input name="brand_name" class="form-control" type="text" id="brand_name" value="<?php echo $res->brand_name ; ?>" />

                                <?php echo form_error('brand_name','<span class="text-danger">','</span>'); ?>

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <div class="input text">

                                <label>Brand Description</label>

                                <textarea name="brand_description" class="form-control" type="text" id="brand_description" ><?php echo $res->brand_description ;?></textarea>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-3">

                            <div class="input text">

                               

                               <label>Brand Logo</label>

                                <input type="file" value="<?php echo base_url().'/webroot/admin/upload/brand/'.$res->brand_logo ;?>" name="brand_logo" onchange="checkFiletype(this)">
                                <span style="color: red;" id="image_error"></span>

                            </div>

                        </div>

                         <div class="form-group col-md-3">                        

                            <div class="input text">

                                 <label></label>

                               <img src="<?php echo base_url().'/webroot/admin/upload/brand/'.$res->brand_logo ;?>" width='80'>

                            </div>

                        </div>

                        <div class="form-group col-md-6">

                            <div class="input text">

                                <label>Brand Status</label>

                                <select name="brand_status" id="brand_status" class="form-control">                                   

                                    <option value="1">Active</option>

                                    <option value="0">Deactive</option>

                                </select>

                               

                            </div>

                        </div>

                        

                    </div>

                   

                </div>

                <!-- /.box-body -->      

                <div class="box-footer">

                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Update</button>

                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/brand">Cancel</a>

                </div>

            <?php } ?>

            </form>

        </div>

        <!-- /.box -->

    </section>

    <!-- /.content -->

</aside>

<!-- /.right-side -->
<script type="text/javascript">
    
    function checkFiletype(fun_obj)
    {      
        var filename = $(fun_obj).val();
        var file_obj = fun_obj; 
        var extension = filename.replace(/^.*\./, '');
        extension = extension.toLowerCase();
        var error_id = $(fun_obj).next().attr('id');
        if(extension == 'png' || extension == 'gif' || extension == 'jpe' || extension == 'jpe' || extension == 'jpeg' || extension == 'jpg')
        {  
          $('#'+error_id).html("");
          return true;             
        }
        else
        {
           $(fun_obj).val('');
           $('#'+error_id).html("<p></p>Invalid file type, please choose only image file!");
           return false; 
        }
    }
</script>
