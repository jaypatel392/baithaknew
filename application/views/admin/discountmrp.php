<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>	

			Discount-MRP<small>Control panel</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Discount-MRP</li>

        </ol>
    </section> 
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Discount-MRP Details</h3>
                </div>

                <div class="pull-right box-tools">
                    <?php
                    if(empty($discountmrp_result))
                    {
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {

                                ?>
                                    <a href="<?php echo base_url();?>admin/discountMrp/addDiscountMrp" class="btn btn-primary btn-sm">Add New</a>              

                                <?php

                            }

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
                <table id="" class="table table-bordered table-hover">
                    <thead>
                        <tr>                            
                            <th>Discount-MRP For DR.</th>
                            <th>Discount-MRP For Hospitalist</th>
                            <th>Discount-MRP For Pharma-wholseller</th>
                            <th>Discount-MRP For Chemist</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($discountmrp_result))
                            {
                                foreach($discountmrp_result as $res)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $res->discountmrp_for_dr;?></td>
                                        <td><?php echo $res->discountmrp_for_hospitalist;?></td>
                                        <td ><?php echo $res->discountmrp_for_pharma_wholseller;?></td>
                                        <td><?php echo $res->discountmrp_for_chemist;?></td>
                                       
                                        <td width="10%">
                                            <?php
                                                foreach($getAllTabAsPerRole as $role)
                                                {
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                                                    {
                                                        ?>
                                                            <a href="<?php echo base_url();?>admin/discountMrp/addDiscountMrp/<?php echo $res->discountmrp_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;

                                                        <?php
                                                    }
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                                    {
                                                        ?>
                                                            <a class="confirm" onclick="return delete_discountmrp(<?php echo $res->discountmrp_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      

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
    function delete_discountmrp(discountmrp_id)
    {        
        bootbox.confirm("Are you sure you want to delete discountmrp details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/discountMrp/deleteDiscountMrp/"+discountmrp_id;
            }
        });
    }    
</script>>