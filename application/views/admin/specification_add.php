<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Specification<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/specification">Specification</a></li>
            <li class="active">Specification Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Specification Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/specification" class="btn btn-info btn-sm">Back</a>                           
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
                                <label>Specification Name<span class="text-danger">*</span></label>
                                <input name="specification_name" class="form-control" type="text" id="specification_name" value="<?php echo set_value('specification_name'); ?>" />
                                <?php echo form_error('specification_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Specification Type</label>
                                <select name="specification_type" id="specification_status" class="form-control">
                                   <option value=""></option>
                                    <option value="Event">Event</option>
                                    <option value="Product">Product</option>
                                </select>
                                <?php echo form_error('specification_type','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>           
                         <div class="form-group col-md-4">
                            <div class="input text">
                                <label>Status</label>
                                <select name="specification_status" id="specification_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <?php echo form_error('specification_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>                                 
                    </div>                   
                    
                    <button class="btn btn-success btn-sm" type="button" id="add_spacification_box" ><i class="fa fa-plus"></i>&nbsp; Add New</button>
                    <button class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="removeButton"><i class="fa fa-remove"></i></button>
                    <input type="hidden" id="owners_validate" >

                    <div id="TextBoxesGroup"> <br>           
                                                      
                    </div>            
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/specification">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
 $(document).ready(function()
 {

    var counter = 0;
    $("#add_spacification_box").click(function () {
        $('#owners_validate').val('1');
        $('#removeButton').show();
       
            var newTextBoxDiv = $(document.createElement('div'))
            .attr("id", 'TextBoxDiv' + counter);
            newTextBoxDiv.after().html(
            '<div class="row"><div class="form-group col-md-4"><div class="input text">'+
            '<label>Specification Value'+'</label><input name="specification_value[]" class="form-control" type="text" required id="specification_value"/></div></div></div>');

            newTextBoxDiv.appendTo("#TextBoxesGroup");        
            counter++;

        });

        $("#removeButton").click(function () {
        counter--;
        $("#TextBoxDiv" + counter).remove();         
        if(counter == 0){
        $('#removeButton').hide();
        $('#owners_validate').val('');
        }


        });
});
</script>