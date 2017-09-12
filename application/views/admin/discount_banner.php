<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            Discount Banner<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Discount Banner</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Discount Banner Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                    $session = $this->session->all_userdata();
                      if(!empty($session))
                      {
                            if(!empty($dis_banner))
                            {
                                ?>
                                   <a href="<?php echo base_url();?>admin/homeSetting/addDiscountBanner/<?php echo $dis_banner[0]->discount_img_id ?>" class="btn btn-info btn-sm">Edit</a> 
                                <?php
                            }
                            else
                            {
                                ?>                                        <a href="<?php echo base_url();?>admin/homeSetting/addDiscountBanner" class="btn btn-info btn-sm">Add New</a> 
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
                            <th>Banner Image</th>                         
                            <th>Banner Url</th>                          
                            <th>Status</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($dis_banner))
                            {
                                foreach($dis_banner as $res)
                                {
                                    ?>
                                    <tr>
                                        <td> <img width="100" src="<?php echo base_url().$res->discount_img_name; ?>"></td>
                                        <td><?php echo $res->discount_img_url ; ?></td>                              
                                        <td  width="10%">
                                            <?php
                                                if($res->discount_img_status == '1')
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
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="10">No records found...</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
    function delete_home_Banner(home_banner_id)
    {
        bootbox.confirm("Are you sure you want to delete Home Banner details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/Home Banner/deleteHomeBanner/"+home_banner_id;
            }
        });
    }    
</script>>