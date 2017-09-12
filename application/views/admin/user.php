<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Customer<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Customer</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Customer Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/user/addUser" class="btn btn-info btn-sm">Add New</a>              
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
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>                           
                            <th>Customer Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
            if(!empty($user_result))
            {
                foreach($user_result as $res)
                {
                    ?>
                    <tr>
                        <td><?php echo $res->user_name; ?></td>
                        <td><?php echo $res->user_email; ?></td>
                        <td><?php echo $res->user_phone; ?></td>
                        <td><?php echo $res->user_city; ?></td>
                        <td><?php echo $res->user_type; ?></td>
                        <td  width="10%">
                            <?php
                                if($res->user_status == '1')
                                {
                                    ?>
                                    <span class="text-success">Active</span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <span class="text-danger">Deactive</span>
                                    <?php
                                }
                            ?>
                        </td>                                       
                        <td width="15%">
                            <?php
                                foreach($getAllTabAsPerRole as $role)
                                {
                                    if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                                    {
                                        if($res->user_status == '0' && $res->user_type != 'Retailer')
                                        {
                                        ?>
                                         <a href="<?php echo base_url();?>admin/user/approveRejectUser/<?php echo $res->user_id; ?>/Approve"  title="Approve"><i class="fa fa-check fa-2x text-success" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                         <a href="<?php echo base_url();?>admin/user/approveRejectUser/<?php echo $res->user_id; ?>/Reject"  title="Reject"><i class="fa fa-remove text-danger fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                         <?php
                                         }
                                         ?>
                                            <a href="<?php echo base_url();?>admin/user/addUser/<?php echo $res->user_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;

                                        <?php
                                    }
                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                    {
                                        ?>
                                            <a class="confirm" onclick="return delete_user(<?php echo $res->user_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_user(user_id)
    {
        bootbox.confirm("Are you sure you want to delete user details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/user/delete_user/"+user_id;
            }
        });
    }    
</script>>