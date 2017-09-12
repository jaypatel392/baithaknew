<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Event<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Event</li>
        </ol>
    </section>   
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Event Details</h3>
                </div>
                <div class="pull-right box-tools">
                    <?php
                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {
                                ?>
                                    <a href="<?php echo base_url();?>admin/event/addEvent" class="btn btn-info btn-sm">Add New</a>              
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
                            <th>Event Image</th>
                            <th>Event Title</th>
                            <th>Description</th>                           
                            <th>Event Price</th>      
                            <th>Total Seats</th>      
                            <th>Start Date</th>                            
                            <th>End Date</th>                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($event_result))
                            {
                                foreach($event_result as $res)
                                {
                                    ?>
                                    <tr>
                                         <td> <img src="<?php echo $res->event_image; ?>" width='50'></td>
                                        <td><?php echo $res->event_title; ?></td>
                                        <td><?php echo $res->event_description; ?></td>
                                        <td><?php echo $res->event_total_sheet; ?></td>
                                        <td><?php echo $res->event_base_price; ?></td>
                                        <td><?php echo $res->event_start_date; ?></td>
                                        <td><?php echo $res->event_end_Date; ?></td>
                                        <td  width="10%">
                                            <?php
                                                if($res->event_status == '1')
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
                                                            <a href="<?php echo base_url();?>admin/event/addevent/<?php echo $res->event_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                
                                                        <?php
                                                    }
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')
                                                    {
                                                        ?>
                                                            <a class="confirm" onclick="return delete_event(<?php echo $res->event_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      
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
    function delete_event(event_id)
    {
        bootbox.confirm("Are you sure you want to delete event details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/event/delete_event/"+event_id;
            }
        });
    }    
</script>>