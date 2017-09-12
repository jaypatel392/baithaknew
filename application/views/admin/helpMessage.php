<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Help Message<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Help Message</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Help Message Details</h3>
                </div>
                <div class="pull-right box-tools">
                              
                </div>
            </div>           
            <!-- /.box-header -->
            <div class="box-body">
                <div>
                    <div id="msg_div">
                        <?php echo $this->session->flashdata('message');?>
                    </div>
                </div> 
                 <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Help Message Name</th>
                            <th>Help Message Email</th>
                            <th>Help Message Phone</th>
                            <th>Help Message Description</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($help_msg_result))
                            {
                                foreach($help_msg_result as $res)
                                {
                                    ?>
                                    <tr>                                                                
                                        <td><?php echo $res->help_msg_name;?></td>
                                        <td><?php echo $res->help_msg_email; ?></td>
                                        <td><?php echo $res->help_msg_phone; ?></td>
                                        <td><?php echo $res->help_msg_massage; ?></td>   
                                        <td width="10%">
                                            <?php
                                                foreach($getAllTabAsPerRole as $role)
                                                {
                                                   if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                                    {
                                                        ?>
                                                            <a class="confirm" onclick="return delete_message(<?php echo $res->help_msg_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
                                                        <?php
                                                    }
                                                }
                                            ?>  
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="3">No records found...</td>
                                </tr>
                                <?php
                            }
                            
                        ?>                       
                    </tbody>
                </table>      
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
    function delete_message(msg_id)
    {
        bootbox.confirm("Are you sure you want to delete helpMessage details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/helpMessage/delete_message/"+msg_id;
            }
        });
    }    
</script>>