<div class="breadcrumb_dress">
    <div class="container">
        <h3>Order History</h3>
        <div class="cartt" style="padding: 35px 15px;">
            <?php foreach ($user_data as $u_value) { // echo "<pre>"; // print_r($u_value);die; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 form-group">
                        <div class="col-md-4">
                            <br>
                            <label>Name:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_name ?>" name="user_name" type="text" id="user_name">
                            <span id="error_user_name" style="color:red;"></span>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <br>
                            <label>Email:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_email ?>" name="user_email" type="email" onchange="check_user_email_address(this.value)" id="user_email">
                            <span id="error_user_email" style="color:red;"></span>
                        </div>
                        <br>


                        <div class="col-md-4">
                            <br>
                            <label>City:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_city ?>" name="user_city" type="email" onchange="check_user_email_address(this.value)" id="user_city">
                            <span id="error_user_city" style="color:red;"></span>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <br>
                            <label>State:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <select id="user_state_id" class="form-control" name="user_state_id">
                                <?php $state_list=$this->userlogin_model->getStateListByCountryId($user_data[0]->user_country_id); foreach ($state_list as $s_list) { ?>
                                <option value="<?php echo $s_list->state_id; ?>" <?php if($user_data[0]->user_state_id == $s_list->state_id){ echo "selected"; }?>>
                                    <?php echo $s_list->state_name; ?></option>
                                <?php } ?>
                            </select>
                            <span id="user_state_id" style="color:red;"></span>
                        </div>

                        <div class="col-md-4">
                            <br>
                            <label>Social Id:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <select name="user_country_id" class="form-control" onchange="getStateList(this.value)">
                                <option value="">Select Country</option>
                                <?php foreach ($country_list as $c_list) { ?>
                                <option <?php if($user_data[0]->user_country_id != 0 ){ if($user_data[0]->user_country_id == $c_list->country_id){ echo "selected"; } } ?> value="
                                    <?php echo $c_list->country_id; ?>">
                                    <?php echo $c_list->country_name; ?></option>
                                <?php } ?>
                            </select>
                            <span id="user_country_id" style="color:red;"></span>
                        </div>
                    </div>
                    <!--#######################-->

                    <input type="hidden" name="profile_user_id" id="profile_user_id" value="<?php echo $u_value->user_id; ?>">
                    <div class="col-md-6 form-group">
                        <div class="col-md-4">
                            <br>
                            <label>Phone:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_phone ?>" name="user_phone" type="text" id="user_phone">
                            <span id="error_user_phone" style="color:red;"></span>
                        </div>
                        <br>

                        <div class="col-md-4">
                            <br>
                            <label>Date Of Birth:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_dob ?>" name="user_dob" type="email" onchange="check_user_email_address(this.value)" id="user_dob">
                            <span id="error_user_dob" style="color:red;"></span>
                        </div>
                        <br>

                        <div class="col-md-4">
                            <br>
                            <label>Address Line 1:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_address_1; ?>" name="user_address_1" type="email" onchange="check_user_email_address(this.value)" id="user_address_1">
                            <span id="error_user_address_1" style="color:red;"></span>
                        </div>
                        <br>
                        <div class="col-md-4">
                            <br>
                            <label>Address Line 2:</label>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input class="form-control" value="<?php echo $u_value->user_address_2 ?>" name="user_address_2" type="email" onchange="check_user_email_address(this.value)" id="user_address_2">
                            <span id="error_user_address_2" style="color:red;"></span>
                        </div>
                        <br>

                    </div>
                    <br>
                    <div id="show_old_password" style="display: none;">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <br>
                                <label>old Password:</label>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <input class="form-control" name="old_password" type="text" id="old_password">
                                <span id="error_old_password" style="color:red;"></span>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="button" class="btn btn-success btn-sm" onclick="check_change_password()">Change</button>
                                <span id="error_old_pswd_submit" style="color:red;"></span>
                            </div>
                        </div>
                    </div>

                    <div id="show_new_pswd" style="display: none">
                        <label>Write New Password:</label>

                        <div class="col-md-12">
                            <div class="col-md-4">
                                <br>
                                <label>New Password:</label>
                            </div>
                            <div class="col-md-4">

                                <input class="form-control" value="" name="new_password" type="password" id="new_password">                               
                                <span id="error_new_password" style="color:red;"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-default btn-sm" onclick="cancel_change_new_password()" >Cancel</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="col-md-12">

                            <div class="col-md-4">
                                <br>
                                <label>Confirm Password:</label>
                            </div>
                            <br>
                            <div class="col-md-4">

                                <input class="form-control" value="" name="confirm_password" type="password" id="n_confirm_password">
                                <span id="error_conf_password" style="color:red;"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" name="submit" class="btn btn-primary btn-sm" onclick="confirm_change_new_password()">Update</button>

                            </div>
                        </div>
                    </div>

                    <div class="change_password">
                        <br>
                        <br>
                        <a href="javascript:void" onclick="show_change_password('1')">Change Password</a>

                    </div>
                    <center>
                        <br>
                        <span id="img_lodar" style=""></span>
                        <div class="sign-up">
                            <br>
                            <br>
                            <input type="submit" name="register" value="Update Acount" onclick="new_user_ragistration()" />
                        </div>
                    </center>
                    <?php } ?>




                </div>
            </div>
        </div>
    </div>
</div>


<!-- /.box-body -->

</form>
<script type="text/javascript">
    function show_change_password(str) 
    {
        if (str) 
        {
            $('#show_old_password').show();
            $('.change_password').hide();
        }
    }

   function cancel_change_new_password()
   {

   }

    function confirm_change_new_password()
    {
        var new_password = $('#new_password').val();
        var confirm_password = $('#n_confirm_password').val();
        var user_id = $('#profile_user_id').val();
        // alert(confirm_password); return false;

        if (new_password == "")
        {
            $('#error_new_password').html('Password is required*');
            $("#new_password").focus();
            document.getElementById('new_password').style.border = '1px solid red';
            return false;
        }
        else 
        {
            $('#error_new_password').html('');
            document.getElementById('new_password').style.border = '1px solid green';
        }

        if (confirm_password == "")
        {
            $('#error_conf_password').html('Please enter your confirm Password.');
            $("#error_conf_password").focus();
            document.getElementById('n_confirm_password').style.border = '1px solid red';
            return false;
        }
        else 
        {

            if (new_password == confirm_password) 
            {
                $('#error_conf_password').html('');
                document.getElementById('n_confirm_password').style.border = '1px solid green';
            }
            else
            {
                $('#error_conf_password').html('Password and confirm Password is not match.');
                $("#confirm_password").focus();
                document.getElementById('n_confirm_password').style.border = '1px solid red';
                return false;

            }
        }

        var PAGE = '<?php echo base_url();?>userlogin/changePassword';
        jQuery.ajax({
            type: "POST",
            url: PAGE,
            data: 'new_password='+new_password+'&user_id='+user_id,
            success: function(data) {
                alert(data); return false;
                if (data > 0) 
                {

                    $('#show_new_pswd').show();
                    $('#show_old_password').hide();
                    
                } else {
                    $('#error_old_password').html('Old Password Is invalid!');
                    return false;
                }
            }
        });
    }

    function check_change_password() 
    {
        var user_id = $('#profile_user_id').val();
        var old_password = $('#old_password').val();
        var datString = 'user_id=' + user_id + '&old_password=' + old_password;
        var PAGE = '<?php echo base_url();?>userlogin/checkChangePassword';

        jQuery.ajax({
            type: "POST",
            url: PAGE,
            data: datString,
            success: function(data) {
                if (data > 0) 
                {
                    $('#show_new_pswd').show();
                    $('#show_old_password').hide();
                    
                } else {
                    $('#error_old_password').html('Old Password Is invalid!');
                    return false;
                }
            }
        });
    }

    function getStateList(country_id) {
        var str = 'country_id=' + country_id;
        var PAGE = '<?php echo base_url(); ?>admin/user/getStateList';

        jQuery.ajax({
            type: "POST",
            url: PAGE,
            data: str,
            success: function(data) {
                if (data != "") {
                    $('#user_state_id').html(data);
                } else {
                    $('#user_state_id').html('<option value=""></option>');
                }
            }
        });
    }
    
</script>
