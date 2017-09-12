<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            Measurement<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/discountMrp">Measurement</a></li>
            <li class="active">Measurement Add</li>
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
                    <h3 class="box-title">Measurement Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/discountMrp" class="btn btn-info btn-sm">Back</a>
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <?php
                foreach ($discountmrp_edit as $dismrp_res) 
                {
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <div class="input text">
                                <label>Percent For Dr.<span class="text-danger">*</span></label>
                                <input name="discountmrp_for_dr" onkeyup="changeMsmName(this.value)" class="form-control" type="text" id="discountmrp_for_dr" value="<?php echo $dismrp_res->discountmrp_for_dr ?>" placeholder="10.00%" />
                                <?php echo form_error('discountmrp_for_dr','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input text">
                                <label>Percent For Hospitalist</label><br>
                                <input type="text" name="discountmrp_for_hospitalist" id="discountmrp_for_hospitalist" value="<?php echo $dismrp_res->discountmrp_for_hospitalist; ?>" placeholder="10.00%"  class="form-control">
                                 <?php echo form_error('discountmrp_for_hospitalist','<span class="text-danger">','</span>'); ?>
                            </div>                            
                        </div>      

                        <div class="form-group col-md-3">
                            <div class="input text">
                                <label>Percent For Pharma-wholseller</label><br>
                                <input type="text" name="discountmrp_for_pharma_wholseller" id="discountmrp_for_pharma_wholseller" placeholder="10.00%" value="<?php echo $dismrp_res->discountmrp_for_pharma_wholseller; ?>" class="form-control">
                                 <?php echo form_error('discountmrp_for_pharma_wholseller','<span class="text-danger">','</span>'); ?>
                            </div>                            
                        </div>       
                        <div class="form-group col-md-3">
                            <div class="input text">
                                <label>Percent For Chemist</label><br>
                                <input type="text" name="discountmrp_for_chemist" id="discountmrp_for_chemist" value="<?php echo $dismrp_res->discountmrp_for_chemist; ?>" placeholder="10.00%" class="form-control">
                                 <?php echo form_error('discountmrp_for_chemist','<span class="text-danger">','</span>'); ?>
                            </div>                            
                        </div>            
                    </div>    
                </div>
                <!-- /.box-body -->     
                <?php
                }
                ?> 
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/discountMrp">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
