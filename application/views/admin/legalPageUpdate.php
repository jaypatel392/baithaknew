<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Legal Page<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/legalPage">Legal Page</a></li>
            <li class="active">Legal Page Update</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Legal Page Update</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/legalPage" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php 
                    foreach ($legal_page_edit as $value)
                    {
                        ?>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div>
                                    <div id="msg_div">
                                        <?php echo $this->session->flashdata('message');?>
                                    </div>
                                </div>   
                                <div class="row">                                   
                                    <div class="form-group col-md-12">
                                        <div class="input text">
                                            <label>Page Description</label>
                                            <textarea id="legal_page_description" name="legal_page_description" class="form-control" rows="15">
                                                <?php echo $value->legal_page_description ?>
                                            </textarea>
                                            <?php echo form_error('legalPage_status','<span class="text-danger">','</span>'); ?>
                                        </div>
                                    </div>                
                                </div>                   
                            </div>
                            <!-- /.box-body -->      
                            <div class="box-footer">
                                <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Submit</button>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/legalPage">Cancel</a>
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
    $(function () {
       
        $('#legalPage_start_date').datetimepicker({
             format: 'Y-M-D'
        });  
         $('#legalPage_end_date').datetimepicker({
             format: 'Y-M-D'
        });    
    });
</script>
