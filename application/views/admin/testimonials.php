<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
           Testimonial<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Testimonial</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Testimonial Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                    $session = $this->session->all_userdata();
                      if(!empty($session))
                      {
                            ?>
                                     <a href="<?php echo base_url();?>admin/homeSetting/addTestimonials" class="btn btn-info btn-sm">Add New</a> 
                             <?php                             
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
                            <th>Image</th>          
                            <th>Title</th>    
                            <th>Description</th>    
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($testimonials_list))
                            {
                                foreach($testimonials_list as $res)
                                {
                                    ?>
                                    <tr>
                                        <td> <img width="80" src="<?php echo base_url().$res->testimonial_img; ?>"></td>
                                        <td><?php echo $res->testimonial_name ; ?></td>           <td><?php echo $res->testimonial_description ; ?></td>                              
                                        <td  width="10%">
                                            <?php
                                                if($res->testimonial_status == '1')
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
                                        <a href="<?php echo base_url();?>admin/homeSetting/addTestimonials/<?php echo $res->testimonial_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;
                                        <a class="confirm" onclick="return delete_testimonials(<?php echo $res->testimonial_id;?>);" href="" title="Remove">
                                        <i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i>
                                        </a>  
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
    function delete_testimonials(testimonial_id)
    {
        bootbox.confirm("Are you sure you want to delete Home Banner details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/homeSetting/deleteTestimonials/"+testimonial_id;
            }
        });
    }    
</script>>