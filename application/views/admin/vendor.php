<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			User<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Vendor Details</h3>
                </div> 
                <div class="pull-right box-tools">
                
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/vendor/addVendor" class="btn btn-info btn-sm">Add New</a>              
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
                            <th>User Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($vendor_result))
                            {
                                foreach($vendor_result as $res)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $res->user_name; ?></td>
                                        <td><?php echo $res->user_email; ?></td>
                                        <td><?php echo $res->user_phone; ?></td>
                                        <td><?php echo $res->user_city; ?></td>
                                        <td><?php echo $res->user_type; ?></td>
                                        <td  width="10%" id="status<?php echo $res->user_id;?>">
                                            <?php
                                                if($res->user_status == '1')
                                                {
                                                    ?>
                                                    <a href="javascript:void(0)" onclick="change_status('0','<?php echo $res->user_id;?>')" class="text-success">Active</a>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <a href="javascript:void(0)" onclick="change_status('1','<?php echo $res->user_id;?>')" class="text-danger">Deactive</a>
                                                    <?php
                                                }
                                            ?>
                                        </td>                                       
                                        <td width="10%">

                                            <?php
                                                foreach($getAllTabAsPerRole as $role)
                                                {
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                                                    {
                                                        ?>
                                                            <a href="<?php echo base_url();?>admin/vendor/addVendor/<?php echo $res->user_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
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
                                <tr>
                                    <td colspan="10">No records found...</td>
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
    function delete_user(user_id)
    {
        bootbox.confirm("Are you sure you want to delete user details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/vendor/delete_vendor/"+user_id;
            }
        });
    }    

    function change_status(str,user_id)
    {
        var a = '"';      
        var dataString = 'user_status='+str + '&user_id=' + user_id;      
         $.ajax({
            type: "post",
            url: "<?php echo base_url().'admin/vendor/changeStatus';?>",
            data: dataString,
            cache: false,            
            success: function(data) {
                
                if(data)
                {              
                    if(str == '1')
                    {
                        $('#status'+user_id).html("<a href='javascript:void(0)' onclick='change_status("+a+"0"+a+","+a+user_id+a+")' class='text-success'>Active</a>");
                    }
                    else
                    {
                        $('#status'+user_id).html("<a href='javascript:void(0)' onclick='change_status("+a+"1"+a+","+a+user_id+a+")' class='text-danger'>Deactive</a>");
                    }
                }
            }
            });

    }
</script>>