<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Welcome	<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Welcome</li>
        </ol>
    </section>
    <div>
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
    <?php
        if(!empty($product_notify))
        {
          echo "<h1>Product Notification </h1><br>";
          
        }
    ?>
       
            <div class="box-body">
                <div>
                    <div id="msg_div">
                        <?php echo $this->session->flashdata('message');?>
                    </div>
                </div>      
                <?php
                if(!empty($product_notify))
                {
                ?>          
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Vendor Name</th>
                            <th>Product Id</th>
                            <th>Product Title</th>
                            <th>Product Quntity</th>                           
                            <th>Purchase Price</th>
                            <th>Sale price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                           
                                foreach($product_notify as $res)
                                {
                                    ?>
                                    <tr>
                                         <td> <img src="<?php echo $res->product_thumb_img; ?>" width='50'></td>
                                        <td><?php echo $res->user_name; ?></td>
                                        <td><?php echo $res->product_uid; ?></td>
                                        <td><?php echo $res->product_title; ?></td>
                                        <td><?php echo $res->product_qty; ?></td>
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
                           ?>
                       
                    </tbody>
                </table>
                <?php
                }
                else
                {
                ?>
                    <h4 style="color: red; text-align: center;">Notification Not Found!</h4>
                <?php
                }
                            
                        ?>
            </div>
            <!-- /.box-body -->
    </section>
    <!-- /.content -->

</aside>
<!-- /.right-side -->