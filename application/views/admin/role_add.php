<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			Role<small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url();?>admin/role">Role</a></li>
            <li class="active">Role Add</li>
        </ol>
    </section>
    <div>
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title">Role Add</h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/role" class="btn btn-info btn-sm">Back</a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Role Name<span class="text-danger">*</span></label>
                                <input name="role_name" class="form-control" type="text" id="role_name" value="<?php echo set_value('role_name'); ?>" />
                                <?php echo form_error('role_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label>Role Status<span class="text-danger">*</span></label>
                                <select name="role_status" id="role_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <?php echo form_error('role_status','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <br/><br/>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-header">
                                <label>Permission</label> 
                            </div><!-- form start -->
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tab Name</th>
                                        <th>View</th>
                                        <th>Add</th>            
                                        <th>Edit</th>           
                                        <th>Delete</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($tab_list))
                                        {
                                            foreach($tab_list as $res)
                                            {
                                                ?>
                                                <tr>        
                                                    <td>
                                                        <?php echo $res->tabname; ?>
                                                    </td>
                                                    <td><input type="checkbox" name="view_<?php echo $res->tab_id; ?>" id="view_<?php echo $res->tab_id; ?>" value="1" ></td>
                                                    <td><input type="checkbox" name="add_<?php echo $res->tab_id; ?>" id="add_<?php echo $res->tab_id; ?>" value="1" ></td>
                                                    <td><input type="checkbox" name="edit_<?php echo $res->tab_id; ?>" id="edit_<?php echo $res->tab_id; ?>" value="1" ></td>
                                                    <td><input type="checkbox" name="delete_<?php echo $res->tab_id; ?>" id="delete_<?php echo $res->tab_id; ?>" value="1" ></td>
                                                </tr> 
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>        
                                                <td colspan="4" >No records found...</td>
                                            </tr> 
                                            <?php
                                        }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" >Submit</button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/role">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->