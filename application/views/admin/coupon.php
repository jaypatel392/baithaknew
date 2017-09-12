<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Coupon<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Coupon</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Coupon Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/coupon/addCoupon" class="btn btn-info btn-sm">Add New</a>              
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
                            <th>Coupon code</th>
                            <th>Coupon type</th>
                            <th>Coupon value</th>
                            <th>Coupon Start Date</th>
                            <th>Coupon End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($coupon_result))
                            {
                                foreach($coupon_result as $res)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $res->coupon_code; ?></td>
                                        <td><?php echo $res->coupon_type; ?></td>
                                        <td><?php echo $res->coupon_value; ?></td>
                                        <td><?php echo $res->coupon_start_date; ?></td>
                                        <td><?php echo $res->coupon_end_date; ?></td>
                                        <td  width="10%">
                                            <?php
                                                if($res->coupon_status == '1')
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
                                                            <a href="<?php echo base_url();?>admin/coupon/addCoupon/<?php echo $res->coupon_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                                        <?php
                                                    }
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                                    {
                                                        ?>
                                                            <a class="confirm" onclick="return delete_coupon(<?php echo $res->coupon_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_coupon(coupon_id)
    {
        bootbox.confirm("Are you sure you want to delete coupon details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/coupon/delete_coupon/"+coupon_id;
            }
        });
    }    
</script>>