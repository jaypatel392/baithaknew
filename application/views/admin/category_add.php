<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Category<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/category">Category</a></li>
            <li class="active">Category Add</li>
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
                    <h3 class="box-title">Category Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/category" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Category Name<span class="text-danger">*</span></label>
                                <input name="category_name" class="form-control" type="text" id="category_name" value="<?php echo set_value('category_name'); ?>" />
                                <?php echo form_error('category_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div> 
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Parent Category</label>
                                <select name="category_id[]" id="category_parent_id" class="form-control" onchange="getParentSubCategory(this.value,'parent_sub')">
                                <option value="">None</option>
                                <?php
                                foreach ($parent_category_list as $pc_res) 
                                {
                                    ?>
                                    <option value="<?php echo $pc_res->category_id; ?>"><?php echo $pc_res->category_name; ?></option>
                                    <?php
                                }
                                ?>
                                 </select>
                            </div>
                        </div>  
                        <div id="parent_sub_category"></div>
                    </div>                   
                     <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Category Status</label>
                                <select name="category_status" id="category_status" class="form-control">                                   
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div> 
                          <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Category Image</label>
                                <input type="file" name="category_img" onchange="checkFiletype(this)">
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>                       
                    </div>
                    <div class="row">
                        <div class="form-group col-md-8">
                            <div class="input text">
                                <label>Category Description</label>
                                <textarea name="category_description" rows="4" class="form-control" type="text" id="category_description" ><?php echo set_value('category_description'); ?></textarea>
                            </div>
                        </div>                       
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/category">Cancel</a>
                </div>
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

    function getParentSubCategory(parent_id , parent_sub='')
    {
        if(parent_id != '')
        {
            if(parent_sub == 'parent_sub'){
                $('#parent_sub_category').html('');
            }         
         
            var str = 'parent_cat_id='+parent_id;
            var PAGE = '<?php echo base_url(); ?>admin/category/getParentSubCategory';
            
            jQuery.ajax({
                type :"POST",
                url  :PAGE,
                data : str,
                success:function(data)
                { 
                  if(data != "")
                  {
                        $('#parent_sub_category').append('<div class="form-group col-md-4"><div class="input text"><label>Sub Category</label><select onchange="getParentSubCategory(this.value)" name="category_id[]" id="category_sub_id" class="form-control" >'+data+'</select></div><div id="parent_sub_category"></div>');

                    }                   
                    
                } 
            });
        }
        if(parent_sub == 'parent_sub' && parent_id == "")
        {
            $('#parent_sub_category').html('');
        }
    }
  

</script>