<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Legal Page<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Legal Page</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Legal Page Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/legalPage/addLegalPage/<?php echo $legal_page_result[0]->legal_page_id;?>" class="btn btn-info btn-sm">Edit</a>              
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
                        foreach($legal_page_result as $lp_value)
                        {
                         echo $lp_value->legal_page_description;
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
