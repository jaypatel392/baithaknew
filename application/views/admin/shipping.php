<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			shipping<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">shipping</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">shipping Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/shipping/addShipping" class="btn btn-info btn-sm">Add New</a>              
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
                            <th>Shipping Name</th>
                            <th>Shipping type</th>
                            <th>Shipping value</th>
                            <th>Shipping Multiply Type</th>
                            <th>Shipping Multiply Value</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($shipping_result))
                            {
                                foreach($shipping_result as $res)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $res->shipping_name; ?></td>
                                        <td><?php echo $res->shipping_type; ?></td>
                                        <td><?php echo $res->shipping_value; ?></td>
                                        <td><?php echo $res->shipping_multiply_type; ?></td>
                                        <td><?php echo $res->shipping_multiply_value; ?></td>
                                        <td  width="10%">
                                            <?php
                                                if($res->shipping_status == '1')
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
                                        <td width="10%">

                                            <?php
                                                foreach($getAllTabAsPerRole as $role)
                                                {
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                                                    {
                                                        ?>
                                                            <a href="<?php echo base_url();?>admin/shipping/addShipping/<?php echo $res->shipping_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                                        <?php
                                                    }
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                                    {
                                                        ?>
                                                            <a class="confirm" onclick="return delete_shipping(<?php echo $res->shipping_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_shipping(shipping_id)
    {
        bootbox.confirm("Are you sure you want to delete shipping details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/shipping/delete_shipping/"+shipping_id;
            }
        });
    }    
</script>>