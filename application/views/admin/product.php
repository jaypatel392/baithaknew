<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Product<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Product</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Product Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/product/addProduct" class="btn btn-info btn-sm">Add New</a>
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
                            <th>Product Image</th>
                            <th>Product Id</th>
                            <th>Product Title</th>
                            <th>Product Quntity</th>
                            <th>Product Category</th>
                            <th>Purchase Price</th>
                            <th>Sale price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(!empty($product_result))
                        {
                            foreach($product_result as $res)
                            {
                                ?>
                                <tr>
                                     <td> <img src="<?php echo $res->product_thumb_img; ?>" width='50'></td>
                                    <td><?php echo $res->product_uid; ?></td>
                                    <td><?php echo $res->product_title; ?></td>
                                    <td><?php echo $res->product_qty; ?></td>
                                    <td><?php echo $res->category_name; ?></td>
                                    <td><?php echo $res->product_purchase_price; ?></td>
                                    <td><?php echo $res->product_sale_price; ?></td>
                                    <td  width="10%">
                                    <?php

                                        if($res->product_status == '1')
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
                                            <a href="<?php echo base_url();?>admin/product/addproduct/<?php echo $res->product_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;
                                        <?php
                                        }
                                        if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                        {
                                            ?>
                                                <a class="confirm" onclick="return delete_product(<?php echo $res->product_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>
                                            <?php
                                        }
                                    }
                                    ?>  
                                    </td>
                                </tr>
                            <?php
                            }
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
    function delete_product(product_id)
    {
        bootbox.confirm("Are you sure you want to delete product details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/product/delete_product/"+product_id;
            }
        });
    }    
</script>>