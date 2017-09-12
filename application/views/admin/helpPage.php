<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Help Page<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Help Page</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Help Page Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/helpPage/addHelpPage/<?php echo $help_page_result[0]->help_page_id;?>" class="btn btn-info btn-sm">Edit</a>              
                                <?php
                            }
                        }
                    ?>                    
                </div>
            </div>           
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <div id="msg_div">
                        <?php echo $this->session->flashdata('message');?>
                    </div>
                </div>                
               <div class="row">
                   <div class="col-md-12">
                       <span>
                       <?php
                        foreach($help_page_result as $hp_value)
                        {
                         echo $hp_value->help_page_description;
                        }
                       ?>                           
                       </span>
                   </div>
               </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
