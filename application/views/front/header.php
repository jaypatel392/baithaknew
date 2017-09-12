<!DOCTYPE html>
<html lang="en">
<head>
<title>Party-Shaarty</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Electronic Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!-- Custom Theme files -->
<link href="<?php echo base_url().'webroot/front/css/bootstrap.css';?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url().'webroot/front/css/style.css" rel="stylesheet" type="text/css';?>" media="all" />
<link href="<?php echo base_url().'webroot/front/css/fasthover.css';?>" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url().'webroot/front/css/popuo-box.css';?>" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="<?php echo base_url().'webroot/front/css/font-awesome.css';?>" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="<?php echo base_url().'webroot/front/js/jquery.min.js';?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'webroot/front/css/jquery.countdown.css';?>" /> <!-- countdown --> 
<!-- //js -->  
<!-- web fonts --> 
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //web fonts -->  
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>

<!-- //end-smooth-scrolling --> 
</head> 
<body>
	<!-- for bootstrap working -->
	<script type="text/javascript" src="<?php echo base_url().'webroot/front/js/bootstrap-3.1.1.min.js';?>"></script>
	<!-- //for bootstrap working -->
	<!-- header modal -->
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">Don't Wait, Login now!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" id="tab_1" aria-controls="tab_item-0"><span>Sign in</span></li>
										<li class="resp-tab-item" id="tab_2" aria-controls="tab_item-1"><span>Sign up</span></li>
										<li class="resp-tab-item" id="tab_2" aria-controls="tab_item-1"><span>Sign up Vendor</span></li>

									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">							<span id="register_success_msg"></span>			
													<input name="user_email" placeholder="Email Address" id="user_email" type="text" >	
													<span id="error_user_email" style="color:red;"></span>			
													<input id="user_password" placeholder="Password" type="password" name ="user_password" >
													<span id="error_user_pass" style="color:red;"></span>
													<center><span id="login_img_lodar" style=""></span></center>			
													<div class="sign-up">
														<input type="submit" name ="login" value="Login" onclick="user_login()" />
													</div>
												
											</div>
										</div> 
									</div>	 
									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
														
													<input placeholder="Name" name="user_name" type="text" id="user_name">
													<span id="error_user_name" style="color:red;"></span>					
													<input placeholder="Email Address" name="user_ragister_email" type="email" onchange="check_user_email_address(this.value)" id="user_ragister_email">	
													<span id="error_user_Rmail" style="color:red;"></span>		
													<input placeholder="Password" name="user_Rpassword" id="user_Rpassword" type="password" >
													<span id="error_user_Rpassword" style="color:red;"></span>	
													
													<input placeholder="confirm Password" name="confirm_password" id="confirm_password" type="password" >
                                                    <span id="error_user_Rcon_password" style="color:red;"></span>    
                                                    <center><span id="img_lodar" style=""></span></center>
													<div class="sign-up">
														<input type="submit" name="register" value="Creat Acount" onclick="new_user_ragistration()" />
													</div>
													
											</div>

										</div>
									</div>
									<div class="tab-3 resp-tab-content" aria-labelledby="tab_item-2">
									<div class="facts">
										<div class="register">
														
													<input placeholder="Name" name="vendor_name" type="text" id="vendor_name">
													<span id="error_vendor_name" style="color:red;"></span>					
													<input placeholder="Email Address" name="vendor_ragister_email" type="email" onchange="check_vendore_email_address(this.value)" id="vendor_ragister_email">	
													<span id="error_vndr_email" style="color:red;"></span>	
													<input placeholder="Contact Number" name="vendor_contact_number" id="vendor_contact_number" type="text">
													<span id="error_vndr_contact" style="color: red;"></span>
													<input placeholder="City" name="vendore_city" id="vendore_city" type="text">
													<span id="error_vendore_city" style="color: red;"></span>

												 <select onchange="getStateList(this.value)" id="vendore_country" name="vendore_country"> 
										           <option value="">Select Country</option>
										           <?php
										           $country_list= $this->homepage_model->getCountryList(); 
										           foreach ($country_list as $cntr_value) {
										             ?>
										             <option value="<?php echo $cntr_value->country_id;?>"><?php echo $cntr_value->country_name;?></option>
										            <?php
										            } ?>

										           </select>
										            <span id="error_vendore_country" style="color: red;"></span>
										            <select id="vendore_state" name="vendore_state"> 
										              <option value="">Select State</option> 
										           </select>
										            <span id="error_vendore_state" style="color: red;"></span>
										            <input type="text" name="vendore_postal_code" id="vendore_postal_code" placeholder="Pin Code"  />  
										             <span id="error_vendore_pin_code" style="color: red;"></span>
										             <textarea name="vendore_address_line_1" id="vendore_address_line_1" placeholder="Address Line 1"></textarea>
										              <span id="error_vendore_addrs_line1" style="color: red;"></span>
										             <textarea name="vendore_address_line_2" id="vendore_address_line_2" placeholder="Address Line 2"></textarea>
													<input placeholder="Password" name="vendor_Rpassword" id="vendor_Rpassword" type="password" >
													<span id="error_vendor_Rpassword" style="color:red;"></span>	
													
													<input placeholder="confirm Password" name="vendor_confirm_password" id="vendor_confirm_password" type="password" >
                                                    <span id="error_vendor_Rcon_password" style="color:red;"></span>   
										           <select id="subscribe_plan_id" name="subscribe_plan_id"> 
										           <option value="">Select Subscribe Plan</option>
										           <?php
										          
										           foreach ($subscribe_list as $subs_value) 
										           {
										             ?>
										             <option title="<?php echo 'Plan Name : '.$subs_value->subscribe_name.', products limit : '.$subs_value->subscribe_limit.' , Plan valid : '.$subs_value->subscribe_plan; ?>" value="<?php echo $subs_value->subscribe_id;?>"><?php echo 'Rs.'.$subs_value->subscribe_charge;?></option>
										            <?php
										            }
										            ?>

										           </select>
										            <span id="error_vendore_subs" style="color: red;"></span>
										            <br><br>
										            <input type="checkbox" name="vendore_agree_tc" id="vendore_agree_tc" value="1"><label>&nbsp;&nbsp;&nbsp; I agree terms & condition</label><a href="<?php echo base_url();?>termsCondition">&nbsp;&nbsp;&nbsp; See terms & condition</a><br>
										             <span id="error_vendore_tc" style="color: red;"></span>
                                                    <center><span id="vendore_img_lodar"></span></center>
													<div class="sign-up">
														<input type="submit" name="register" value="Creat Acount" onclick="new_vendor_ragistration()" />
													</div>
													
											</div>

										</div>
									</div> 	            	      
								</div>	
							</div>
							<script src="<?php echo base_url().'webroot/front/js/easyResponsiveTabs.js';?>" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
								});
							</script>
							<div id="OR" class="hidden-xs">OR</div>
						</div>
						<div class="col-md-4 modal_body_right modal_body_right1">
							<div class="row text-center sign-with">
								<div class="col-md-12">
									<h3 class="other-nw">Sign in with</h3>
								</div>
								<div class="col-md-12">
									<ul class="social">
										<li class="social_facebook"><a href="#" class="entypo-facebook"></a></li>
										<li class="social_dribbble"><a href="#" class="entypo-dribbble"></a></li>
										<li class="social_twitter"><a href="#" class="entypo-twitter"></a></li>
										<li class="social_behance"><a href="#" class="entypo-behance"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	<?php
     $session = $this->session->all_userdata();	
	  if(empty($session[0]))
	  {	 ?>
	 //$('#myModal88').modal('show');
	<?php } ?>
	</script>  
	<!-- header modal -->
	<!-- header -->
	<div class="header" id="home1">
		<div class="container">		
			
			<?php
             $session = $this->session->all_userdata();	
			  if(empty($session[0]))
			  {	 ?>
				<div class="w3l_login">
					<a href="#" data-toggle="modal" data-target="#myModal88"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>
				</div>
			<?php
			}
			else
			{
			 ?>						
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $session[0]->user_name; ?><b class="caret"></b></a>
							<ul class="dropdown-menu multi-level">
								<li><a href="<?php echo base_url() ?>userlogin/profile">Profile</a></li>                            
								<li><a href="<?php echo base_url() ?>orders">Orders</a></li> 
							</ul>
						</li>
					</ul>
				</div>
	           <?php	
	           }
	           ?>
			
			<div class="w3l_logo">
				<h1><a href="<?php echo base_url()?>"><!-- Electronic Store<span>Your stores. Your place.</span> --><img style="height:100px;" class="img-responsive" src="<?php echo base_url().'webroot/front/images/logo2.png';?>"></a></h1>
			</div>
			<div class="search">
				<input class="search_box" type="checkbox" id="search_box">
				<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
				<div class="search_form">
					<form action="<?php echo base_url().'products/searchByKeywords';?>" method="post">
						<input type="text" name="keyword" placeholder="Search...">
						<input type="submit" value="Send">
					</form>
				</div>
			<div class="cart cart box_1"> 
				<?php
                           //print_r($this->cart->contents()); 
			 if(!empty($this->cart->contents())){
				?>
				<a href="<?php echo base_url();?>products/viewCart"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button></a>
				<?php } ?>  
			</div>  
		</div>
	</div>
	<!-- //header -->
	<!-- navigation -->
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
				<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
									
						<?php
						foreach ($topCategories as $value)
						{ 
							$sub_categories = $this->homepage_model->getSubCategories($value->category_id);
							if(!empty($sub_categories))
							{
							?>
							<li>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $value->category_name;?><b class="caret"></b></a>
								  <ul class="dropdown-menu multi-level">
									
									<?php
										foreach ($sub_categories as $subCategory) 
										{
											$sub_categories1 = $this->homepage_model->getSubCategories($subCategory->category_id);
											if(!empty($sub_categories1))
											{

											?>
											<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $subCategory->category_name;?></a>
											<ul class="dropdown-menu">
											<?php
											
												foreach ($sub_categories1 as $s1_val) 
												{
													?>
													
														<li><a tabindex="-1" href="<?php echo base_url().'products/productsBycategories/'.$s1_val->category_id;?>"><?php echo $s1_val->category_name;?></a>
														</li>
													
													<?php
												}?>
												</ul>
												
												<?php 
											}
											else
											{
												?>
												
													<li><a tabindex="-1" href="<?php echo base_url().'products/productsBycategories/'.$subCategory->category_id;?>"><?php echo $subCategory->category_name;?> </a></li>
												<?php
											}
											?>
											</li>
										<?php
										}
										?>										
									
									
								</ul>
							</li>	
							
							
                         	<?php 
                         	}
                         	else
                         	{ 
                         		?>
       							<li>
								<a href="<?php echo base_url().'products/productsBycategories/'.$value->category_id;?>"><?php echo $value->category_name;?> </a></li>
                          		<?php  
                          	}
                        } 
                        ?>                 
                      <li>

						<?php
			             $session = $this->session->all_userdata();	
						  if(!empty($session[0]))
						  {	 ?>
						<li><a href="<?php echo base_url();?>userlogin/logout">Log Out</a></li>
						<?php 
						if($session[0]->user_role_id == 2)
						  {	 ?>					
							<li><a href="<?php echo base_url();?>admin">Manage A/C</a></li>
							<li><a href="<?php echo base_url().'VendorDetails';?>">Vendor</a></li>
						<?php } 
						}
						?>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->


<script type="text/javascript">
		
function user_login(){
 
	var user_email = $('#user_email').val();	
	var user_password = $('#user_password').val();
	
	if(user_email == ""){
         
       $('#error_user_email').html('Email address is required*');
         $("#user_email").focus();
        document.getElementById('user_email').style.border='1px solid red';
        return false;
    }else{
    
	    if(validateEmail(user_email) == false){

		    $('#error_user_email').html('Please enter Valid email address.');
		    $("#user_email").focus();
		    document.getElementById('user_email').style.border='1px solid red';
		    return false;

	   }else{  

      	  $('#error_user_email').html('');
	      document.getElementById('user_email').style.border='1px solid green';
	        
	   }
   }

	if(user_password == ""){
         
       $('#error_user_pass').html('Password is required*');
       $("#user_password").focus();
        document.getElementById('user_password').style.border='1px solid red';
        return false;

    }else{

        $('#error_user_pass').html('');
        document.getElementById('user_password').style.border='1px solid green';     
    
	}
	var action_user_login = 'user_login';
    var dataString = 'action_user_login=' + action_user_login + '&user_email=' + user_email + '&user_password=' + user_password;

     var login_page = '<?php echo base_url();?>userlogin/checkUserLogin'; 
	   $.ajax({
	       type: "POST",
	       url: login_page,
	       data: dataString,
	       cache: false,
	       beforeSend: function () {
	       $('#login_img_lodar').html('<br><br><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="text-align: center; width: 40px;">');	        
	       },   
	       success: function(data){
	       	//alert(data);   return false;
	       	if(data){  

	           $('#login_img_lodar').html('');
	           window.location.reload();

	       	}else{
	       	  $('#login_img_lodar').html('<br><br><h4 style="color:red;">Invalid Email id & password!</h4>'); 
	        }
	      }
	  });
}
 function new_user_ragistration(){

	var user_ragister_email = $('#user_ragister_email').val();
	var user_name = $('#user_name').val();
	var user_Rpassword = $('#user_Rpassword').val();
	var confirm_password = $('#confirm_password').val();
	if(user_name == ""){
         
       $('#error_user_name').html('User name is required*');
         $("#user_name").focus();
        document.getElementById('user_name').style.border='1px solid red';
        return false;
    }else{

        $('#error_user_name').html('');
        document.getElementById('user_name').style.border='1px solid green';     
    
	} 
	if(user_ragister_email == ""){
         
       $('#error_user_Rmail').html('Email address is required*');
         $("#user_ragister_email").focus();
        document.getElementById('user_ragister_email').style.border='1px solid red';
        return false;
    }else{
    
	    if(validateEmail(user_ragister_email) == false){

		    $('#error_user_Rmail').html('Please enter Valid email address.');
		    $("#user_ragister_email").focus();
		    document.getElementById('user_ragister_email').style.border='1px solid red';
		    return false;

	   }else{  

      	  $('#error_user_Rmail').html('');
	      document.getElementById('user_ragister_email').style.border='1px solid green';
	        
	   }

	    var action_user_registrtion = 'user_registrtion';
        var dataString = 'action_user_registrtion=' + action_user_registrtion + '&user_name=' + user_name + '&user_ragister_email=' + user_ragister_email + '&user_Rpassword=' + user_Rpassword;	
      var reg_page = '<?php echo base_url();?>userlogin/user_registration'; 
	   $.ajax({
	       type: "POST",
	       url: reg_page,
	       data: dataString,
	       cache: false,
	       beforeSend: function () {
	       $('#img_lodar').html('<br><br><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="text-align: center; width: 40px;">');	        
	       },   
	       success: function(data){
	       	//alert(data);   return false;
	       	if(data){  

	           $('#img_lodar').html('');
	            window.location.reload();

	       	}else{
	       	  $('#img_lodar').html('<h5 style="color:red;">Your Ragistration Faild!</h5>'); 
	        }
	      }
	  });

   }

	if(user_Rpassword == ""){
         
       $('#error_user_Rpassword').html('Password is required*');
       $("#user_Rpassword").focus();
        document.getElementById('user_Rpassword').style.border='1px solid red';
        return false;

    }else{

        $('#error_user_Rpassword').html('');
        document.getElementById('user_Rpassword').style.border='1px solid green';     
    
	}

	if(confirm_password == ""){
     
      $('#error_user_Rcon_password').html('Please enter your confirm Password.');
      $("#error_user_Rcon_password").focus();
      document.getElementById('confirm_password').style.border='1px solid red';
      return false;
   
      }else{

          if (user_Rpassword == confirm_password){
              
              $('#error_user_Rcon_password').html('');
              document.getElementById('confirm_password').style.border='1px solid green';     
           
           }else{
            
               $('#error_user_Rcon_password').html('Password and confirm Password is not match.');
               $("#confirm_password").focus();
               document.getElementById('confirm_password').style.border='1px solid red';
               return false;
            
           }      
       }

      var action_user_registrtion = 'user_registrtion';
      var dataString = 'action_user_registrtion=' + action_user_registrtion + '&user_name=' + user_name + '&user_ragister_email=' + user_ragister_email + '&user_Rpassword=' + user_Rpassword;	
      var PAGE = '<?php echo base_url();?>userlogin/user_registration'; 
	   $.ajax({
	       type: "POST",
	       url: PAGE,
	       data: dataString,
	       cache: false,
	       beforeSend: function () {
	       $('#img_lodar').html('<br><br><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="text-align: center; width: 40px;">');	        
	       },   
	       success: function(data){
	       	//alert(data);   return false;
	       	if(data){  

	           $('#img_lodar').html('');
	           window.location.reload();

	       	}else{
	       	  $('#img_lodar').html('<h5 style="color:red;">Your Ragistration Faild!</h5>'); 
	        }
	      }
	  });

 }


 function check_user_email_address(emailId){
 	 
    var action_check_emailId = 'check_email';
	var check_dataString = 'action_check_emailId=' + action_check_emailId + '&user_ragister_email=' + emailId;	
	var check_PAGE = '<?php echo base_url();?>userlogin/checkUserEmailId'; 
		$.ajax({
		type: "POST",
		url: check_PAGE,
		data: check_dataString,
		cache: false,	        
		success: function(check_data){
		//alert(check_data); return false;			     
	       if(check_data == "1"){

		    $('#error_user_Rmail').html('This email id allready ragistered!.');
		    $("#user_ragister_email").focus();
		    document.getElementById('user_ragister_email').style.border='1px solid red';
		    return false;
		   }else{  

	      	  $('#error_user_Rmail').html('');
		      document.getElementById('user_ragister_email').style.border='1px solid green';
		        
		   } 	
	     }
	  });

 }

function check_vendore_email_address(emailId){
 	 
    var action_check_emailId = 'check_email';
	var check_dataString = 'action_check_emailId=' + action_check_emailId + '&user_ragister_email=' + emailId;	
	var check_PAGE = '<?php echo base_url();?>userlogin/checkUserEmailId'; 
		$.ajax({
		type: "POST",
		url: check_PAGE,
		data: check_dataString,
		cache: false,	        
		success: function(check_data){
		//alert(check_data); return false;			     
	       if(check_data == "1"){

		    $('#error_vndr_email').html('This email id allready ragistered!.');
		    $("#vendore_email").focus();
		    document.getElementById('vendore_email').style.border='1px solid red';
		    return false;
		   }else{  

	      	  $('#error_vndr_email').html('');		     
		        
		   } 	
	     }
	  });

 }

/* Vendor Registration */
function new_vendor_ragistration(){

	var vendore_email = $('#vendor_ragister_email').val();
	var vendor_contact_number = $('#vendor_contact_number').val();
	var vendore_city = $('#vendore_city').val();
	var vendore_country = $('#vendore_country').val();
	var vendore_state = $('#vendore_state').val();
	var vendore_postal_code = $('#vendore_postal_code').val();
	var vendore_address_line_1 = $('#vendore_address_line_1').val();
	var vendore_address_line_2 = $('#vendore_address_line_2').val();
	var user_name = $('#vendor_name').val();
	var vendor_password = $('#vendor_Rpassword').val();
	var confirm_password = $('#vendor_confirm_password').val();
	var vendore_agree_tc = $("input[name='vendore_agree_tc']:checked").val();
	var subscribe_plan_id = $('#subscribe_plan_id').val();	


	if(user_name == ""){
         
       $('#error_vendor_name').html('Name is required*');
         $("#vendor_name").focus();
        document.getElementById('vendor_name').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendor_name').html('');
        document.getElementById('vendor_name').style.border='1px solid green';     
    
	} 
	if(vendore_email == ""){
         
       $('#error_vndr_email').html('Email address is required*');
         $("#vendor_ragister_email").focus();
        document.getElementById('vendor_ragister_email').style.border='1px solid red';
        return false;
    }else{
    
	    if(validateEmail(vendore_email) == false){

		    $('#error_vndr_email').html('Please enter Valid email address.');
		    $("#vendor_ragister_email").focus();
		    document.getElementById('user_ragister_email').style.border='1px solid red';
		    return false;

	   }else{  

      	  $('#error_vndr_email').html('');
	      document.getElementById('vendor_ragister_email').style.border='1px solid green';	        
	   }	    

   }

   if(vendor_contact_number == ""){
         
       $('#error_vndr_contact').html('Contact Number is required*');
         $("#vendor_contact_number").focus();
        document.getElementById('vendor_contact_number').style.border='1px solid red';
        return false;
    }else{

        $('#error_vndr_contact').html('');
        document.getElementById('vendor_contact_number').style.border='1px solid green';     
    
	} 

	if(vendore_city == ""){
         
       $('#error_vendore_city').html('Country is required*');
         $("#vendore_city").focus();
        document.getElementById('vendore_city').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendore_city').html('');
        document.getElementById('vendore_city').style.border='1px solid green';     
    
	} 

	if(vendore_country == ""){
         
       $('#error_vendore_country').html('Country is required*');
         $("#vendore_country").focus();
        document.getElementById('vendore_country').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendore_country').html('');
        document.getElementById('vendore_country').style.border='1px solid green';     
    
	} 
	
	if(vendore_state == ""){
         
       $('#error_vendore_state').html('State is required*');
         $("#vendore_state").focus();
        document.getElementById('vendore_state').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendore_state').html('');
        document.getElementById('vendore_state').style.border='1px solid green';     
    
	} 
	if(vendore_postal_code == ""){
         
       $('#error_vendore_pin_code').html('Postal Code is required*');
         $("#vendore_postal_code").focus();
        document.getElementById('vendore_postal_code').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendore_pin_code').html('');
        document.getElementById('vendore_postal_code').style.border='1px solid green';     
    
	} 

	if(vendore_address_line_1 == ""){
         
       $('#error_vendore_addrs_line1').html('Address line one is required*');
         $("#vendore_address_line_1").focus();
        document.getElementById('vendore_address_line_1').style.border='1px solid red';
        return false;
    }else{

        $('#error_vendore_addrs_line1').html('');
        document.getElementById('vendore_address_line_1').style.border='1px solid green';     
    
	} 

	if(vendor_password == ""){
         
       $('#error_vendor_Rpassword').html('Password is required*');
       $("#vendor_Rpassword").focus();
        document.getElementById('vendor_Rpassword').style.border='1px solid red';
        return false;

    }else{

        $('#error_vendor_Rpassword').html('');
        document.getElementById('vendor_Rpassword').style.border='1px solid green';     
    
	}

	if(confirm_password == ""){
     
      $('#error_vendor_Rcon_password').html('Please enter your confirm Password.');
      $("#error_venddor_Rcon_password").focus();
      document.getElementById('vendor_confirm_password').style.border='1px solid red';
      return false;
   
      }else{

          if (vendor_password == confirm_password){
              
              $('#error_vendor_Rcon_password').html('');
              document.getElementById('vendor_confirm_password').style.border='1px solid green';     
           
           }else{
            
               $('#error_vendor_Rcon_password').html('Password and confirm Password is not match.');
               $("#vendor_confirm_password").focus();
               document.getElementById('vendor_confirm_password').style.border='1px solid red';
               return false;
            
           }      
       }

        if(subscribe_plan_id == '')
       {
         
	       $('#error_vendore_subs').html('Subscribe Plan is required*');     
	        document.getElementById('subscribe_plan_id').style.border='1px solid red';
	        return false;

   		 }
   		 else
   		 {

	        $('#error_vendore_subs').html('');
	        document.getElementById('subscribe_plan_id').style.border='1px solid green';     
    
		}


       if(vendore_agree_tc == undefined)
       {
         
	       $('#error_vendore_tc').html('Please Chack Terms & Condition*');      
	        document.getElementById('vendore_agree_tc').style.border='1px solid red';
	        return false;

   		 }
   		 else
   		 {

	        $('#error_vendore_tc').html('');
	        document.getElementById('vendore_agree_tc').style.border='1px solid green';     
    
		}

      var action_vendore_registrtion = 'vendor_registration';
      var dataString = 'user_name=' + user_name + '&vendore_email=' + vendore_email + '&vendor_contact_number=' + vendor_contact_number + '&vendore_postal_code=' + vendore_postal_code + '&vendore_city=' + vendore_city + '&vendore_country=' + vendore_country + '&vendore_state=' + vendore_state + '&vendor_password=' + vendor_password  + '&vendore_address_line_1=' + vendore_address_line_1 + '&vendore_address_line_2=' + vendore_address_line_2 + '&subscribe_plan_id=' + subscribe_plan_id ;	
     	
      var PAGE = '<?php echo base_url();?>userlogin/vendor_registration'; 
      
	   $.ajax({
	       type: "POST",
	       url: PAGE,
	       data: dataString,
	       cache: false,
	       beforeSend: function () {
	       $('#vendore_img_lodar').html('<br><br><img src="<?php echo base_url();?>webroot/clientloader.gif" alt="Please wait..." style="width: 40px;">');	        
	       },   
	       success: function(data){
	       	//alert(data); return false;	       
	       	if(data){  

	           $('#vendore_img_lodar').html('');
	           window.location.href = '<?php echo base_url();?>userlogin/subscribe/'+data;
	         
	       	}else{
	       	  $('#vendore_img_lodar').html('<h5 style="color:red;">Your Registration Faild!</h5>'); 
	        }
	      }
	  });

 }


 function validateEmail(email) {
  
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
 }

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
                    $('#vendore_state').html(data);
                }
                else
                {
                    $('#vendore_state').html('<option value=""></option>');
                }
            } 
        });
    }
</script>