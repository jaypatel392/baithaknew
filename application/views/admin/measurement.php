<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>	

			Measurement<small>Control panel</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Measurement</li>

        </ol>
    </section> 
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Measurement Details</h3>
                </div>

                <div class="pull-right box-tools">
                    <?php

                        foreach($getAllTabAsPerRole as $role)
                        {
                            if($this->uri->segment(2) == $role->controller_name && $role->userAdd == '1')
                            {

                                ?>
                                    <a href="<?php echo base_url();?>admin/measurement/addmeasurement" class="btn btn-primary btn-sm">Add New</a>              

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
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>                            
                            <th>Measurement Name</th>
                            <th>Measurement Level</th>
                            <th>Measurement Level Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($measurement_result))
                            {
                                foreach($measurement_result as $res)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $res->measurement_name;?></td>
                                        <td width="5%"><?php echo $res->measurement_level;?></td>
                                        <td><?php $msm_level_arr = json_decode($res->measurement_level_value);
                                        for ($i=0; $i < count($msm_level_arr); $i++) 
                                        { 
                                            if($i == '0')
                                            {
                                                echo $msm_level_arr[$i];
                                            }
                                            else
                                            {
                                                echo ','.$msm_level_arr[$i];
                                            }
                                        } ?></td> 
                                       
                                        <td width="10%">
                                            <?php
                                                foreach($getAllTabAsPerRole as $role)
                                                {
                                                    if($this->uri->segment(2) == $role->controller_name && $role->userEdit == '1')
                                                    {
                                                        ?>
                                                            <a href="<?php echo base_url();?>admin/measurement/addMeasurement/<?php echo $res->measurement_id; ?>" title="Edit"><i class="fa fa-edit fa-2x "></i></a>&nbsp;&nbsp;                

                                                        <?php

                                                    }

                                                    if($this->uri->segment(2) == $role->controller_name && $role->userDelete == '1')

                                                    {

                                                        ?>

                                                            <a class="confirm" onclick="return delete_measurement(<?php echo $res->measurement_id;?>);" href="" title="Remove"><i class="fa fa-trash-o fa-2x text-danger" data-toggle="modal" data-target=".bs-example-modal-sm"></i></a>                                      

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
    function delete_measurement(msm_id)
    {        
        bootbox.confirm("Are you sure you want to delete measurement details",function(confirmed){
            if(confirmed)
            {
                location.href="<?php echo base_url();?>admin/measurement/deleteMeasurement/"+msm_id;
            }
        });
    }    
</script>>