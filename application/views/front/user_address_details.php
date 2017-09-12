  <div class="breadcrumb_dress">
    <div class="container">
      <ul>
        <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
        <li>Products</li>
      </ul>
    </div>
  </div>
  <!-- //breadcrumbs --> 
 <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>webroot/front/css/checkout_style.css">
    <!-- multistep form -->
      <form id="msform" method="POST">
         <!-- progressbar -->
         <ul id="progressbar">           
            <li class="active">Basic Info</li>
            <li id="delviery_title">Delivery Address</li>
            <li id="billing_title">Billing Address</li>           
            <li id="payment_title">Payment</li>           
            
         </ul>
         <!-- fieldsets -->
         <fieldset id="user_basic_info">
            <h2 class="fs-title" id="basic_title">Basic Information</h2>
            <!-- <h3 class="fs-subtitle">This is step 1</h3> -->

            <?php 
            if(!empty($user_defaultdel_address_details))
            {
                $user_name = explode(' ', $user_defaultdel_address_details[0]->user_address_name);
               ?>
                  <input type="text" name="user_fname" id="user_fname" placeholder="First Name" value="<?php echo $user_name[0];?>"  />
                  <span id="error_user_fname" style="color: red;"></span>
                  <input type="text" name="user_lname" id="user_lname" placeholder="Last Name" value="<?php if(isset($user_name[1])){ echo $user_name[1]; } ?>" />
                  <span id="error_user_lname" style="color: red;"></span>
                  <input type="text" name="user_email_id" id="user_email_id" placeholder="Email address" value="<?php echo $user_defaultdel_address_details[0]->user_address_email;?>" />
                  <span id="error_user_email_id" style="color: red;"></span>   
                  <input type="text" name="user_phone" id="user_phone" placeholder="Phone Number" value="<?php echo $user_defaultdel_address_details[0]->user_address_phone;?>"/>
                  <span id="error_user_phone" style="color: red;"></span>
                  <br>
                  <input type="button" name="next" id="next1" class="action-button" value="Next" />
                  
              <?php 
              
            }
              else
              {
               foreach ($user_details as $user_value) 
              {
                $user_name = explode(' ', $user_value->user_name);
                $user_num = explode('/', $user_value->user_phone);
               ?>
                  <input type="text" name="user_fname" id="user_fname" placeholder="First Name" value="<?php echo $user_name[0];?>"  />
                  <span id="error_user_fname" style="color: red;"></span>
                  <input type="text" name="user_lname" id="user_lname" placeholder="Last Name" value="<?php if(isset($user_name[1])){ echo $user_name[1]; } ?>" />
                  <span id="error_user_lname" style="color: red;"></span>
                  <input type="text" name="user_email_id" id="user_email_id" placeholder="Email address" value="<?php echo $user_value->user_email;?>" />
                  <span id="error_user_email_id" style="color: red;"></span>   
                  <input type="text" name="user_phone" id="user_phone" placeholder="Phone Number" value="<?php echo $user_num[0];?>"/>
                  <span id="error_user_phone" style="color: red;"></span>
                  <br>
                  <input type="button" name="next" id="next1" class="action-button" value="Next" />
                  
              <?php 
              }
            }
          ?>
         </fieldset>
        <fieldset id="delivery_address">
          <?php
        // print_r($user_defaultdel_address_details);
          if(!empty($user_defaultdel_address_details))
          {  
          ?>         
                <h2 class="fs-title">Delivery Address</h2>
                <!-- <h3 class="fs-subtitle">We will never sell it</h3> -->
                  
                 <button type="button" style="float: left; margin-bottom: 10px; display: none;" id="back_del_address" onclick="back_delivery_address()" class="btn btn-danger"><i class="fa fa-arrow-left"></i></button>  
                <button type="button" style="float: right; margin-bottom: 10px;" id="change_delivery_addrs_btn" onclick="show_change_delivery_address()" class="btn btn-success">Change</button>  
                <button type="button" style="float: right; margin-bottom: 10px; display: none;" id="add_delivery_addrs_btn" onclick="show_add_new_delivery_addrss()" class="btn btn-success" >Add New</button>
                <div id="delvivery_addrs">
                  <p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;">
                    <?php echo $user_defaultdel_address_details[0]->user_address_1.','.$user_defaultdel_address_details[0]->user_address_2.','.$user_defaultdel_address_details[0]->user_address_city.','.$user_defaultdel_address_details[0]->state_name.','.$user_defaultdel_address_details[0]->user_address_postalcode; ?>
                  </p>
                  <input type="hidden" id="same_bill_addrss1" value="<?php echo $user_defaultdel_address_details[0]->user_address_1; ?>">
                  <input type="hidden" id="same_bill_addrss2" value="<?php echo $user_defaultdel_address_details[0]->user_address_2; ?>">
                  <input type="hidden" id="same_bill_city" value="<?php echo $user_defaultdel_address_details[0]->user_address_city; ?>">
                  <input type="hidden" id="same_bill_postal" value="<?php echo $user_defaultdel_address_details[0]->user_address_postalcode; ?>">
                  <input type="hidden" id="same_bill_state_id" value="<?php echo $user_defaultdel_address_details[0]->user_address_state_id; ?>">
                  <input type="hidden" id="same_bill_country_id" value="<?php echo $user_defaultdel_address_details[0]->user_address_country_id; ?>">
                  <input type="hidden" id="user_address_id" value="<?php echo $user_defaultdel_address_details[0]->user_address_id; ?>">
                
                </div>           
                <div id="add_delivery_address" style="display: none;">
                    <?php foreach ($all_delivery_address as $all_del_addrs) 
                    { ?>
                        <br>
                        <div class="col-md-12" style="border: 1px solid;">
                          <div class="col-md-10" style="text-align: left;">
                          <br>
                            <span><?php echo $all_del_addrs->user_address_1.','.$all_del_addrs->user_address_2.','.$all_del_addrs->user_address_city.','.$all_del_addrs->state_name.','.$all_del_addrs->user_address_postalcode; ?></span><br><br>
                              <?php
                              if($all_del_addrs->user_address_default != '1' )
                              { 
                              ?>
                                <button  type="button" style="float: left; margin-bottom: 10px; margin-top: 20px;" id="set_us_defult_delivery" onclick="setUsDefaultDeliveryAddrs('<?php echo $all_del_addrs->user_address_id;?>')" class="btn btn-info btn sm">Set Us Defult</button>
                              <?php
                               }
                              ?>
                           </div>                         
                      </div>
                   <?php 
                   }
                   ?>
              </div>           
        
          <?php 
          }
          else
          { 
          ?>  
            <div id="not_del_addrs">    
             <button type="button" style="float: right; margin-bottom: 10px;" id="add_delivery_addrs_btn" onclick="show_add_new_delivery_addrss()" class="btn btn-success" >Add New</button>
             <br><br>
             <h4 style="color: red">Address Not Found! </h4><br>
             </div>
             <div id="add_delivery_address"></div>    
         <?php
          } 
         ?>         
          <!-- Modal -->
          <div class="modal fade" id="showdelmodel" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Delivery Address</h4><br>
                </div>
                <div class="modal-body">
                  <select onchange="getStateList(this.value)" id="user_country" name="user_country"> 
                 <option value="">Select Country</option>
                 <?php foreach ($country_list as $cntr_value) {
                   ?>
                   <option value="<?php echo $cntr_value->country_id;?>"><?php echo $cntr_value->country_name;?></option>
                  <?php
                  } ?>

                 </select>
                  <span id="error_user_country" style="color: red;"></span>
                  <select id="user_state" name="user_state"> 
                    <option value="">Select State</option> 
                 </select>
                  <span id="error_user_state" style="color: red;"></span>
                   <input type="text" name="user_city" id="user_city" placeholder="City"  />  
                   <span id="error_user_city" style="color: red;"></span>  
                  <input type="text" name="usre_postal_code" id="usre_postal_code" placeholder="Pin Code"  />  
                   <span id="error_user_pin_code" style="color: red;"></span>        
                   <textarea name="user_address_line_1" id="user_address_line_1" placeholder="Address Line 1"></textarea>
                    <span id="error_user_addrs_line1" style="color: red;"></span>
                   <textarea name="user_address_line_2" id="user_address_2" placeholder="Address Line 2"></textarea>
                    <button type="button" onclick="add_delivery_address_details()" class="btn btn-success">Add</button>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>              
          <input type="button" name="previous" id="previous2" class="action-button" value="Previous" />
            <input type="button" name="next" id="next2" class="next action-button" value="Next" />
         </fieldset>
         <fieldset id="billing_address">
           <?php
            if(!empty($user_defaultbil_address_details)){  ?>
         
            <h2 class="fs-title">Billing Address</h2>
            <!-- <h3 class="fs-subtitle">We will never sell it</h3> -->
              <div class="col-md-6" id="same_del_address_btn">
                <input type="checkbox" id="same_del_address" name="same_del_address" onclick="same_as_delivery_address()" style="height: 16px;" >
                <span>Same As Delivery Address</span>
              </div>                         
              
                <button type="button" style="float: left; margin-bottom: 10px; display: none;" id="back_bill_address" onclick="back_billing_address()" class="btn btn-danger"><i class="fa fa-arrow-left"></i></button>           
               
                  <button type="button" style="float: right; margin-bottom: 10px;" id="change_billing_addrs_btn" onclick="show_change_billing_address()" class="btn btn-success">Change</button>                 
                  <button type="button" style="float: right; margin-bottom: 10px; display: none;" id="add_billing_addrs_btn" onclick="show_add_new_billing_addrss()" class="btn btn-success" >Add New</button>                 
                
             
            <div id="same_del_bill_address">
            <div id="billing_addrs">
            <p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;"><?php echo $user_defaultbil_address_details[0]->user_address_1.','.$user_defaultbil_address_details[0]->user_address_2.','.$user_defaultbil_address_details[0]->user_address_city.','.$user_defaultbil_address_details[0]->state_name.','.$user_defaultbil_address_details[0]->user_address_postalcode; ?></p>
            
          </div>  
          </div>         
          <div id="add_billing_address" style="display: none;">
            <?php foreach ($all_billing_address as $all_bill_addrs) { ?>
            <br>
            <div class="col-md-12" style="border: 1px solid;">
            <div class="col-md-10" style="text-align: left;">
            <br>
             <span><?php echo $all_bill_addrs->user_address_1.','.$all_bill_addrs->user_address_2.','.$all_bill_addrs->user_address_city.','.$all_bill_addrs->state_name.','.$all_bill_addrs->user_address_postalcode; ?></span><br>
             <?php if($all_bill_addrs->user_address_default == 0){ ?>
              <button  type="button" style="float: left; margin-bottom: 10px; margin-top: 20px;" id="set_us_defult_billing" onclick="setUsDefaultBillingAddrs('<?php echo $all_bill_addrs->user_address_id;?>')" class="btn btn-info btn sm">Set Us Defult</button>
              <?php }else{ ?>
               <button  type="button" style="float: left; margin-bottom: 10px; margin-top: 20px;" id="set_us_defult_billing" onclick="setUsDefaultBillingAddrs('<?php echo $all_bill_addrs->user_address_id;?>')" class="btn btn-info btn sm">Set Us Defult</button>
              <br>
              <?php } ?>
             </div>
            </div>
           <?php } ?>
          </div>          
        <?php 
          }else{ 
         ?>   
                    
            <div class="col-md-6">
            <input type="checkbox" id="same_del_address" name="same_del_address" onclick="same_as_delivery_address()" style="height: 16px;" >
             <span>Same As Delivery Address</span>
            </div>
             <div class="col-md-4"></div>
            <div class="col-md-2">
               <button type="button" onclick="show_add_new_billing_addrss()" class="btn btn-success" >Add New</button><br><br>
            </div>

            <div id="same_del_bill_address">              
            </div>
            <div id="add_billing_address"></div>
            <div id="billing_addrs"></div>
         
         
         <?php } ?>
          <div class="modal fade" id="showbillmodel" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add New Billing Address</h4><br>
                </div>
                <div class="modal-body">
                  <select onchange="getBillStateList(this.value)" id="user_bill_country" name="user_bill_country"> 
                 <option value="">Select Country</option>
                 <?php foreach ($country_list as $cntr_value) {
                   ?>
                   <option value="<?php echo $cntr_value->country_id;?>"><?php echo $cntr_value->country_name;?></option>
                  <?php
                  } ?>

                 </select>
                  <span id="error_user_bill_country" style="color: red;"></span>
                  <select id="user_bill_state" name="user_bill_state"> 
                    <option value="">Select State</option> 
                 </select>
                  <span id="error_user_bill_state" style="color: red;"></span>
                   <input type="text" name="user_bill_city" id="user_bill_city" placeholder="City"  />  
                   <span id="error_user_bill_city" style="color: red;"></span>  
                  <input type="text" name="usre_bill_postal_code" id="usre_bill_postal_code" placeholder="Pin Code"  />  
                   <span id="error_user_pin_code" style="color: red;"></span>        
                   <textarea name="user_bill_address_line_1" id="user_bill_address_line_1" placeholder="Address Line 1"></textarea>
                    <span id="error_user_addrs_line1" style="color: red;"></span>
                   <textarea name="user_bill_address_2" id="user_bill_address_2" placeholder="Address Line 2"></textarea>
                    <button type="button" onclick="add_billing_address_details()" class="btn btn-success">Add</button>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
              
            </div>
          </div>  
           <input type="button" name="previous" id="previous3" class="action-button" value="Previous" />
            <input type="button" name="next" id="next3" class="next action-button" value="Next" />                 
         </fieldset>
          <fieldset id="payment_confirm">
             <div class="row">
               <br>
               <label>Choose Payment Type</label>
               <div class="col-md-12">
                  <br>
                  <div class="col-md-1">
                     <input type="radio" onclick="choose_payment_type('cod')" name="order_type" value="cod" />
                  </div>
                  <div class="col-md-4">
                     Cash On Delivery
                  </div>
                  <div class="col-md-1">
                     <input checked type="radio" onclick="choose_payment_type('online')" name="order_type" value="online" />
                  </div>
                  <div class="col-md-2">
                     Online
                  </div>
               </div>
              
            </div>
            </form>  
            <br>
            <div id="pay_online" >
               <form action="<?php echo base_url();?>products/verifyPayment" method="POST">
                  <script
                     src="https://checkout.razorpay.com/v1/checkout.js"
                     data-key="<?php echo $data['key']?>"
                     data-amount="<?php echo $data['amount']?>"
                     data-currency="INR"
                     data-name="<?php echo $data['name']?>"
                     data-image="<?php echo $data['image']?>"                    
                     data-prefill.name=""
                     data-prefill.email=""
                     data-prefill.contact=""
                     data-order_id="<?php echo $data['order_id']?>"
                     <?php if ($data['display_currency'] !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
                     <?php if ($data['display_currency'] !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
                     ></script>
                  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                  <input type="hidden" name="shopping_order_id" value="<?php echo time();?>">
               </form>
            </div>
            <div id="pay_cod" style="display: none;">
               <form action="<?php echo base_url();?>products/codOrderConfirm">
                  <input type="submit" value="Confirm" class="razorpay-payment-button">
               </form>
            </div>
             <div class="col-md-12">
                  <input type="button" name="previous" id="previous4" class="action-button" value="Previous" />
               </div>
          </fieldset>
          
      
      <!-- jQuery --> 
     
  <script src="<?php echo base_url();?>webroot/front/js/jquery.easing.min.js" type="text/javascript"></script> 
  <script>

  function choose_payment_type(type)
  {
    if(type == 'online')
    {
      $('#pay_online').show();
      $('#pay_cod').hide(); 
    }
    else
    {
      $('#pay_online').hide(); 
      $('#pay_cod').show();
    }
  }
    function same_as_delivery_address()
    {
      if(document.getElementById("same_del_address").checked)
      {
        var same_bill_addrss1 = $('#same_bill_addrss1').val();
        var same_bill_addrss2 = $('#same_bill_addrss2').val();
        var same_bill_city = $('#same_bill_city').val();
        var same_bill_postal = $('#same_bill_postal').val();
        var same_bill_state_id = $('#same_bill_state_id').val();
        var user_lname = $('#user_lname').val();
        var user_fname = $('#user_fname').val();
        var user_phone = $('#user_phone').val();
        var del_address_id = $('#user_address_id').val();
        // alert(del_address_id); return false;
        var same_bill_country_id = $('#same_bill_country_id').val();
         var str = 'user_country=' + same_bill_country_id + '&user_state=' + same_bill_state_id + '&user_city=' + same_bill_city + '&usre_postal_code=' + same_bill_postal + '&user_address_line_1=' + same_bill_addrss1 + '&user_fname=' + user_fname + '&user_lname=' + user_lname + '&user_phone=' + user_phone + '&user_address_2=' + same_bill_addrss2 + '&user_address_id=' + del_address_id;
             var PAGE = '<?php echo base_url(); ?>products/addNewBillingAddress';
                
                jQuery.ajax({
                    type :"POST",
                    url  :PAGE,
                    data : str,
                    beforeSend: function () {
                    $('#same_del_bill_address').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');          
                    },  
                    success:function(data)
                    {
                       //alert(data); return false;
                      if(data)
                      {
                         $('#same_del_bill_address').html('<p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;">'+same_bill_addrss1+','+same_bill_addrss1+','+same_bill_addrss2+','+same_bill_city+','+same_bill_postal+'</p><input type="hidden" id="remove_same_bill_address" value="'+data+'" />');
                      }else{

                         $('#same_del_bill_address').html('<p style="border: 1px solid #3C43A4; margin-top: 54px; padding: 20px;">'+same_bill_addrss1+','+same_bill_addrss1+','+same_bill_addrss2+','+same_bill_city+','+same_bill_postal+'</p><input type="hidden" id="remove_same_bill_address" value="'+data+'" />');

                      }
                                          
                    } 
                });

      }
      else
      {
          var bill_addrss_id = $('#remove_same_bill_address').val();
          var PAGE = '<?php echo base_url(); ?>products/removeSameBillingAddress';
        
            jQuery.ajax({
              type :"POST",
              url  :PAGE,
              data : 'same_bill_address_id='+bill_addrss_id,
              beforeSend: function () {
                    $('#same_del_bill_address').html('<br><center><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 60px;"></center>');          
              },  
              success:function(data)
              {  
                if(data)
                {
                  $('#same_del_bill_address').html('');              
                }                  
              }               
            });

      }
    }
    function setUsDefaultDeliveryAddrs(str){

      var PAGE = '<?php echo base_url(); ?>products/setDefaultDeladdress';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : 'address_id='+str,
            success:function(data)
            {  

               if(data)
               {
                  $('#delvivery_addrs').show();                 
                  $('#add_delivery_address').hide();
                  $('#add_delivery_addrs_btn').hide();
                  $('#change_delivery_addrs_btn').show();
                  $('#back_del_address').hide();
                  $('#delvivery_addrs').html(data);

               }
            } 
        });
      }

      function setUsDefaultBillingAddrs(str){

      var PAGE = '<?php echo base_url(); ?>products/setUsDefaultBillingAddrs';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : 'address_id='+str,
            success:function(data)
            {    
                 
               if(data){

                  $('#same_del_bill_address').show();  
                  $('#same_del_address_btn').show();  
                  $('#billing_addrs').show();
                  $('#add_billing_address').hide();                  
                  $('#add_billing_addrs_btn').hide();
                  $('#change_billing_addrs_btn').show();
                  $('#back_bill_address').hide();               
                  $('#billing_addrs').html(data);          

               }
            } 
        });
      }

    function add_delivery_address_details(){

        if($('#user_country').val() == ''){               
                $('#error_user_country').html('Country is required* <br>');
                $("#user_country").focus();                
                document.getElementById('user_country').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_country').html('');
              document.getElementById('user_country').style.border='1px solid green';
                
           }

            if($('#user_state').val() == ''){               
                $('#error_user_state').html('Last name is required*<br>');
                $("#user_state").focus();                
                document.getElementById('user_state').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_state').html('');
              document.getElementById('user_state').style.border='1px solid green';
                
           }

            if($('#user_city').val() == ''){               
                $('#error_user_city').html('Email address is required* <br>');
                $("#user_city").focus();                
                document.getElementById('user_city').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_city').html('');
              document.getElementById('user_city').style.border='1px solid green';
                
           }

           if($('#usre_postal_code').val() == ''){               
                $('#error_user_pin_code').html('Email address is required* <br>');
                $("#usre_postal_code").focus();                
                document.getElementById('usre_postal_code').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_pin_code').html('');
              document.getElementById('usre_postal_code').style.border='1px solid green';
                
           }

            if($('#user_address_line_1').val() == ''){               
                $('#error_user_addrs_line1').html('Phone number is required*<br>');
                $("#user_address_line_1").focus();                
                document.getElementById('user_address_line_1').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_addrs_line1').html('');
              document.getElementById('user_address_line_1').style.border='1px solid green';
          }

          var user_country = $('#user_country').val();         
          var user_state = $('#user_state').val();
          var user_state_name = $("#user_state option:selected").text();         
          var user_address_line_1 = $('#user_address_line_1').val();
          var user_address_2 = $('#user_address_2').val();
          var usre_postal_code = $('#usre_postal_code').val();         
          var user_fname = $('#user_fname').val();         
          var user_lname = $('#user_lname').val();         
          var user_email_id = $('#user_email_id').val();         
          var user_phone = $('#user_phone').val();         
          var user_city = $('#user_city').val();         
          var str = 'user_country=' + user_country + '&user_state=' + user_state + '&user_city=' + user_city + '&usre_postal_code=' + usre_postal_code + '&user_address_line_1=' + user_address_line_1 + '&user_fname=' + user_fname + '&user_lname=' + user_lname + '&user_phone=' + user_phone + '&user_address_2=' + user_address_2
             var PAGE = '<?php echo base_url(); ?>products/addNewDeliveryAddress';
                
                jQuery.ajax({
                    type :"POST",
                    url  :PAGE,
                    data : str,
                    success:function(data)
                    { 
                      if(data){
                        $('#user_country').val('');
                        document.getElementById('user_country').style.border='1px solid #ccc';                
                        $('#user_state').html('<option value="">Select State</option>');
                        document.getElementById('user_state').style.border='1px solid #ccc';
                        $('#user_city').val('');
                        document.getElementById('user_city').style.border='1px solid #ccc';
                        $('#usre_postal_code').val('');
                        document.getElementById('usre_postal_code').style.border='1px solid #ccc';
                        $('#user_address_line_1').val('');
                        document.getElementById('user_address_line_1').style.border='1px solid #ccc';
                        $('#user_address_2').val('');
                        document.getElementById('user_address_2').style.border='1px solid #ccc';
                        $('#showdelmodel').modal('hide');
                        $('#not_del_addrs').hide();
                        $('#add_delivery_address').append('<div class="col-md-12" style="border: 1px solid;"><div class="col-md-10" style="text-align: left;"><br><span>'+user_address_line_1+','+user_address_2+','+user_city+','+user_state_name+','+usre_postal_code+'</span><br><button  type="button" style="float: left; margin-bottom: 10px; margin-top: 20px; id="set_us_defult_delivery" onclick="setUsDefaultDeliveryAddrs('+data+')" class="btn btn-info btn sm">Set Us Defult</button></div></div>');


                      }
                    } 
                });         
           
       
      }

      function add_billing_address_details(){

        if($('#user_bill_country').val() == ''){               
                $('#error_user_bill_country').html('Country is required* <br>');
                $("#user_bill_country").focus();                
                document.getElementById('user_bill_country').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_bill_country').html('');
              document.getElementById('user_bill_country').style.border='1px solid green';
                
           }

            if($('#user_bill_state').val() == ''){               
                $('#error_user_bill_state').html('State is required*<br>');
                $("#user_bill_state").focus();                
                document.getElementById('user_bill_state').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_bill_state').html('');
              document.getElementById('user_bill_state').style.border='1px solid green';
                
           }

            if($('#user_bill_city').val() == ''){               
                $('#error_user_bill_city').html('City is required* <br>');
                $("#user_bill_city").focus();                
                document.getElementById('user_bill_city').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_bill_city').html('');
              document.getElementById('user_bill_city').style.border='1px solid green';
                
           }

           if($('#usre_bill_postal_code').val() == ''){               
                $('#error_user_bill_pin_code').html('Postal Code is required* <br>');
                $("#usre_bill_postal_code").focus();                
                document.getElementById('usre_bill_postal_code').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_bill_pin_code').html('');
              document.getElementById('usre_bill_postal_code').style.border='1px solid green';
                
           }

            if($('#user_bill_address_line_1').val() == ''){               
                $('#error_user_bill_addrs_line1').html('Address Line one is required*<br>');
                $("#user_bill_address_line_1").focus();                
                document.getElementById('user_bill_address_line_1').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_bill_addrs_line1').html('');
              document.getElementById('user_bill_address_line_1').style.border='1px solid green';
          }
          var user_country = $('#user_bill_country').val();         
          var user_state = $('#user_bill_state').val();
          var user_state_name = $("#user_bill_state option:selected").text();         
          var user_address_line_1 = $('#user_bill_address_line_1').val();
          var user_address_2 = $('#user_bill_address_2').val();
          var usre_postal_code = $('#usre_bill_postal_code').val();         
          var user_fname = $('#user_fname').val();         
          var user_lname = $('#user_lname').val();         
          var user_email_id = $('#user_email_id').val();         
          var user_phone = $('#user_phone').val();         
          var user_city = $('#user_bill_city').val();         
          var str = 'user_country=' + user_country + '&user_state=' + user_state + '&user_city=' + user_city + '&usre_postal_code=' + usre_postal_code + '&user_address_line_1=' + user_address_line_1 + '&user_fname=' + user_fname + '&user_lname=' + user_lname + '&user_phone=' + user_phone + '&user_address_2=' + user_address_2;
             var PAGE = '<?php echo base_url(); ?>products/addNewBillingAddress';
                
                jQuery.ajax({
                    type :"POST",
                    url  :PAGE,
                    data : str,
                    success:function(data)
                    { 
                      if(data){
                        $('#user_country').val('');
                        document.getElementById('user_country').style.border='1px solid #ccc';                
                        $('#user_state').html('<option value="">Select State</option>');
                        document.getElementById('user_state').style.border='1px solid #ccc';
                        $('#user_city').val('');
                        document.getElementById('user_city').style.border='1px solid #ccc';
                        $('#usre_postal_code').val('');
                        document.getElementById('usre_postal_code').style.border='1px solid #ccc';
                        $('#user_address_line_1').val('');
                        document.getElementById('user_address_line_1').style.border='1px solid #ccc';
                        $('#user_address_2').val('');
                        document.getElementById('user_address_2').style.border='1px solid #ccc';
                        $('#showbillmodel').modal('hide');
                        $('#same_del_bill_address').html();
                        $('#add_billing_address').append('<div class="col-md-12" style="border: 1px solid;"><div class="col-md-10" style="text-align: left;"><br><span>'+user_address_line_1+','+user_address_2+','+user_city+','+user_state_name+','+usre_postal_code+'</span><br></div></div>');

                      }
                    } 
                });         
           
       
      }


        function show_change_delivery_address(){
         
            $('#delvivery_addrs').hide();
            $('#change_delivery_addrs_btn').hide();
            $('#add_delivery_address').show();
            $('#add_delivery_addrs_btn').show();
            $('#back_del_address').show();

        }
        function back_delivery_address(){
         
            $('#delvivery_addrs').show();
            $('#change_delivery_addrs_btn').show();
            $('#add_delivery_address').hide();
            $('#add_delivery_addrs_btn').hide();
            $('#back_del_address').hide();

        }
        function back_billing_address(){
         
            $('#same_del_bill_address').show();
            $('#same_del_address_btn').show();
            $('#change_billing_addrs_btn').show();
            $('#add_billing_address').hide();
            $('#add_billing_addrs_btn').hide();
            $('#back_bill_address').hide();

        }
        function show_change_billing_address(){
         
            $('#same_del_bill_address').hide();
            $('#same_del_address_btn').hide();
            $('#change_billing_addrs_btn').hide();
            $('#add_billing_address').show();
            $('#add_billing_addrs_btn').show();
            $('#back_bill_address').show();

        }
        function show_add_new_delivery_addrss(){
            
            $('#showdelmodel').modal('show');         

        }
        function show_add_new_billing_addrss(){
            
            $('#showbillmodel').modal('show');         

        }



    $(document).ready(function(){

       $("#next1").click(function(){
        

           if($('#user_fname').val() == ''){               
                $('#error_user_fname').html('First name is required* <br>');
                $("#user_fname").focus();                
                document.getElementById('user_fname').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_fname').html('');
              document.getElementById('user_fname').style.border='1px solid green';
                
           }

            if($('#user_lname').val() == ''){               
                $('#error_user_lname').html('Last name is required*<br>');
                $("#user_lname").focus();                
                document.getElementById('user_lname').style.border='1px solid red';
                return false;
           }else{   

              $('#error_user_lname').html('');
              document.getElementById('user_lname').style.border='1px solid green';
                
           }

            if($('#user_email_id').val() == ''){               
                $('#error_user_email_id').html('Email address is required* <br>');
                $("#user_email_id").focus();                
                document.getElementById('user_email_id').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_email_id').html('');
              document.getElementById('user_email_id').style.border='1px solid green';
                
           }
            if($('#user_phone').val() == ''){               
                $('#error_user_phone').html('Phone number is required*<br>');
                $("#user_phone").focus();                
                document.getElementById('user_phone').style.border='1px solid red';
                return false;
            }else{   

              $('#error_user_phone').html('');
              document.getElementById('user_phone').style.border='1px solid green';
                
            }

            $('#user_basic_info').hide(); 
             $('#delviery_title').addClass('active');           
            $('#delivery_address').show();  
         
         });

        $("#next2").click(function(){

            $('#delivery_address').hide();
            $('#billing_title').addClass('active');           
            $('#billing_address').show();  

        }); 

        $("#next3").click(function(){

            $('#billing_address').hide();
            $('#payment_title').addClass('active');           
            $('#payment_confirm').show();  

        }); 

        $("#previous2").click(function(){

            $('#delivery_address').hide();
            $('#delviery_title').removeClass('active');  
            $('#user_basic_info').show();  

        });
         $("#previous3").click(function(){

            $('#billing_address').hide();
            $('#billing_title').removeClass('active');  
            $('#delivery_address').show();  

        });  

         $("#previous4").click(function(){

            $('#payment_confirm').hide();
            $('#payment_title').removeClass('active');  
            $('#billing_address').show();  

        });


    });
  </script>
  <script type="text/javascript">

   function getStateList(country_id)
    {

        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>products/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data != "")
                {
                 
                    $('#user_state').html(data);                  
                }
                else
                {
                    $('#user_state').html('<option value=""></option>');
                   
                }
            } 
        });
    }

    function getBillStateList(country_id)
    {

        var str = 'country_id='+country_id;
        var PAGE = '<?php echo base_url(); ?>products/getStateList';
        
        jQuery.ajax({
            type :"POST",
            url  :PAGE,
            data : str,
            success:function(data)
            {           
                if(data)
                {
                  //alert(data);
                   $('#user_bill_state').html(data);
                }
                else
                {
                    $('#user_bill_state').html('<option value=""></option>');
                }
            } 
        });
    }
</script>
