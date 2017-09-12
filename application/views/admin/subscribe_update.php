<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            subscribe<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/subscribe">subscribe</a></li>
            <li class="active">subscribe Add</li>
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
                    <h3 class="box-title">subscribe Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/subscribe" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <?php
                foreach($subscribe_edit as $res)
                    {

                      ?>
                <!-- /.box-header -->
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Name<span class="text-danger">*</span></label>
                                <input name="subscribe_name" class="form-control" type="text" id="subscribe_name" value="<?php echo $res->subscribe_name; ?>" />
                                <?php echo form_error('subscribe_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Plan</label>
                                 <input type="text" id="subscribe_plan" name="subscribe_plan" class="form-control" value="<?php echo $res->subscribe_plan; ?>" >
                                  <?php echo form_error('subscribe_plan','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                      
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Limit<span class="text-danger">*</span></label>
                                <input name="subscribe_limit" class="form-control" type="text" id="subscribe_limit" value="<?php echo $res->subscribe_limit; ?>" />
                                <?php echo form_error('subscribe_limit','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Charge</label>
                                 <input type="text" id="subscribe_charge" name="subscribe_charge" class="form-control" value="<?php echo $res->subscribe_charge; ?>" >
                                  <?php echo form_error('subscribe_charge','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                      
                    </div>
                  
                     <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Status</label>
                                <select name="subscribe_status" id="subscribe_status" class="form-control">                                   
                                    <option <?php if($res->subscribe_status == '1'){ echo "selected"; } ?> value="1">Active</option>
                                    <option <?php if($res->subscribe_status == '0'){ echo "selected"; } ?> value="0">Deactive</option>
                                </select>
                            </div>
                        </div>                        
                    </div>
                   
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Subscribe Description</label>
                                <textarea name="subscribe_description" class="form-control" type="text" id="subscribe_description" ><?php echo $res->subscribe_description; ?>
                                </textarea>
                            </div>
                        </div>                      
                    </div>                  
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Update</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/subscribe">Cancel</a>
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
var subscribe_id = '<?php echo $res->subscribe_parent_id;?>';

    function show_parent_subscribe_wrapper(){
        $('cancel_change').show();
        $('#check_change_subscribe').val('1');
        var subscribe_type = '<?php echo $res->subscribe_type;?>';
        
        getParentsubscribe(subscribe_type);
        $('#change_parent_subscribe').show('medium');
    }

    function getParentsubscribe(subscribe_type)
    {
         
        var str = 'subscribe_type='+subscribe_type;
        var PAGE = '<?php echo base_url(); ?>admin/subscribe/getParentsubscribe';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            { 
               
                if(data != "")
                {
                    $('#subscribe_parent_id').html(data);

                }
                else
                {
                    $('#subscribe_parent_id').html('<option value=""></option>');
                   
                }
            } 
        });
    }
  

  function getParentSubsubscribe(parent_id , parent_sub='')
    {
        if(parent_sub == 'parent_sub'){
            $('#parent_sub_subscribe').html('');
        }         
        if(subscribe_id == parent_id){

            return false;
        }
        var str = 'parent_cat_id='+parent_id;        
        var PAGE = '<?php echo base_url(); ?>admin/subscribe/getParentSubsubscribe';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {               
               
                if(data != "")
                {

                    $('#parent_sub_subscribe').append('<div class="form-group col-md-6"><div class="input text"><label>Parent subscribe</label><select onchange="getParentSubsubscribe(this.value)" name="p_subscribe_id[]" id="subscribe_sub_id" class="form-control" >'+data+'</select></div><div id="parent_sub_subscribe"></div>');

                }
                
            } 
        });
    }
</script>
