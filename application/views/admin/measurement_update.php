<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            Measurement<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/measurement">Measurement</a></li>
            <li class="active">Measurement Edit</li>
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
                    <h3 class="box-title">Measurement Edit</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/measurement" class="btn btn-info btn-sm">Back</a>
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Measurement Type Name<span class="text-danger">*</span></label>
                                <input name="measurement_name" onkeyup="changeMsmName(this.value)" class="form-control" type="text" id="measurement_name" value="<?php echo set_value('measurement_name'); ?>" />
                                <?php echo form_error('measurement_name','<span class="text-danger">','</span>'); ?>
                                <span class="text-danger" id="error_msm_name"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Measurement Levels</label><br>
                                <span>1</span>&nbsp;<input class="msm_level" type="radio" name="measurement_level" value="1">&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>2</span>&nbsp;<input type="radio" class="msm_level" name="measurement_level" value="2">&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>3</span>&nbsp;<input type="radio" class="msm_level" name="measurement_level" value="3">
                            </div>                            
                        </div>            
                    </div>    
                    <div class="row" id="level_1" style="display: none;">
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input id="msm_type_name1" class="form-control msm_type_name" type="text" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level1[]" class="form-control req_msm_name_val1" type="text">
                            </div>
                        </div>                        
                    </div>
                     <div class="row" id="level_2" style="display: none;">
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="msm_type_name2" class="form-control msm_type_name" type="text" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level2[]" class="form-control req_msm_name_val2" type="text"  value=""; ?>
                            </div>
                        </div>    
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level2[]" class="form-control req_msm_name_val2" type="text" value=""; ?>
                            </div>
                        </div>                        
                    </div>  
                    <div class="row" id="level_3" style="display: none;">
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="msm_type_name3" class="form-control msm_type_name" type="text" value="" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level3[]" class="form-control req_msm_name_val3" type="text" value=""; ?>
                            </div>
                        </div>    
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level3[]" class="form-control req_msm_name_val3" type="text" value=""; ?>
                            </div>
                        </div>      
                        <div class="form-group col-md-3">
                            <div class="input text">        
                                <input name="measurement_level3[]" class="form-control req_msm_name_val3" type="text"  value=""; ?>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/measurement">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
function changeMsmName(str)
{
    var msm_type_name = $('#measurement_name').val();
    $('.msm_type_name').val(msm_type_name);
}

  $(document).ready(function(){
    $(".msm_level").click(function(){
        var msm_type_name = $('#measurement_name').val();
        if(msm_type_name == '')
        {
            this.checked = false;
            $('#error_msm_name').html('Measurement type name is required');
        }
        else
        {        
            $('#error_msm_name').html('');
            var msm_level = $(this).val();
            if(msm_level == '1')
            {
                $('#level_1').show();
                $('.req_msm_name_val1').attr("required", true);
                $('.req_msm_name_val2').removeAttr("required", true);
                $('.req_msm_name_val3').removeAttr("required", true);
                $('#level_2').hide();
                $('#level_3').hide();
                $('.msm_type_name').val(msm_type_name);
            }
            else if(msm_level == '2')
            {
                $('#level_1').hide();
                $('.req_msm_name_val2').attr("required", true);
                $('.req_msm_name_val1').removeAttr("required", true);
                $('.req_msm_name_val3').removeAttr("required", true);
                $('#level_2').show();
                $('#level_3').hide();
            }
            else if(msm_level == '3')
            {
                $('#level_1').hide();
                $('#level_2').hide();
                $('.req_msm_name_val3').attr("required", true);
                $('.req_msm_name_val2').removeAttr("required", true);
                $('.req_msm_name_val1').removeAttr("required", true);
                $('#level_3').show();
            }
        }
        
    });
}); 

</script>