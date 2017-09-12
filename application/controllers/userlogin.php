<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Userlogin extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/userlogin_model');	
	}

	/* Login */
	public function user_registration()
	{
	      $post['user_name'] = $this->input->post('user_name');
	      $post['user_email'] = $this->input->post('user_ragister_email');
		  $post['user_password'] = $this->input->post('user_Rpassword');
		  $post['user_created_date'] = date('Y-m-d');
		  $post['user_updated_date'] = date('Y-m-d');
		  $post['user_type'] = 'n_user';			 
		  $post['user_status'] = 1;			 
		  $user_details = $this->userlogin_model->user_registration($post);

		    if(!empty($user_details))
		    {						
			   echo '1';
			}else{
				echo "";
			}				
		
	}

	function checkUserEmailId(){

   		$user_email = $this->input->post('user_ragister_email');
	  	$check_user = $this->userlogin_model->checkUserEmailId($user_email);
	    if(empty($check_user))
	    {						
		   echo "0";
		}
		else
		{
			echo "1";
		}
	}

	function checkUserLogin()
	{ 
		          
        $data['user_email'] = $this->input->post('user_email');
		$data['user_password'] = $this->input->post('user_password');
      	$user_details = $this->userlogin_model->checkUserLogin($data);	
		if(!empty($user_details))
		{
			$this->session->set_userdata($user_details);
			echo "1";
		}
		else
		{
			echo "";
		}
	}

	/*	Logout */
	public function logout() 
	{        
        $this->session->sess_destroy();		
        redirect(base_url());
    }


     public function vendor_registration()
     {    
          $post['user_name'] = $this->input->post('user_name');
          $post['user_email'] = $this->input->post('vendore_email');
          $post['user_phone'] = $this->input->post('vendor_contact_number');
          $post['user_address_1'] = $this->input->post('vendore_address_line_1');
          $post['user_address_2'] = $this->input->post('vendore_address_line_2');
          $post['user_city'] = $this->input->post('vendore_city');
          $post['user_state_id'] = $this->input->post('vendore_state');
          $post['user_country_id'] = $this->input->post('vendore_country');
          $post['user_postal_code'] = $this->input->post('vendore_postal_code');
          $post['subscribe_plan_id'] = $this->input->post('subscribe_plan_id');
          $post['user_created_date'] = date('Y-m-d');
          $post['user_updated_date'] = date('Y-m-d');
          $post['user_type'] = 'Vendore';             
          $post['user_role_id'] = 2;             
          $post['user_status'] = 0; 
          $user_details = $this->userlogin_model->user_registration($post);
          echo $user_details;       

	}

    public function subscribe($user_id='')
    {    	
    	if(!empty($user_id))
    	{
    			$subscribe_res = $this->userlogin_model->getSubscribeDetailsById($user_id);    			    				
    		
    			require('application/config/razor_config.php');
				require('application/libraries/razorpay-php/Razorpay.php');		
				$api = new Api($keyId, $keySecret);				
				$orderData = [
				'receipt'         => time(),
				'amount'          =>  $subscribe_res[0]->subscribe_charge * 100, // 2000 rupees in paise
				'currency'        => 'INR',
				'payment_capture' => 1 // auto capture
				];

				$razorpayOrder = $api->order->create($orderData);
				$razorpayOrderId = $razorpayOrder['id'];
				$session_data = $this->session->userdata('subscribe_user');
				$session_data['user_id'] = $user_id;
				$session_data['razorpay_order_id'] = $razorpayOrderId;
				$this->session->set_userdata("subscribe_user", $session_data);
				
				$displayAmount = $amount = $orderData['amount'];

				if ($displayCurrency !== 'INR')
				{
					$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
					$exchange = json_decode(file_get_contents($url), true);

					$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
				}

				$checkout = 'automatic';
				$data = [
				"key"               => $keyId,
				"amount"            => $amount,
				"name"              => $subscribe_res[0]->user_name,				
				"image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
				"prefill"           => [
				"name"              => $subscribe_res[0]->user_name,
				"email"             => $subscribe_res[0]->user_email,
				"contact"           => $subscribe_res[0]->user_phone,
				],
				"theme"             => [
				"color"             => "#FF0000"
				],
				"order_id"          => $razorpayOrderId,
				];

				if ($displayCurrency !== 'INR')
				{
					$data['display_currency']  = $displayCurrency;
					$data['display_amount']    = $displayAmount;
				}
				$this->data['data'] = $data;
      			$this->show_view_front('front/subscribe',$this->data);

    	}
    	else
    	{
    		redirect(base_url());
    	}
    }

    public function verifySubscribe()
    {
    		$session = $this->session->all_userdata();    	
    		require('application/config/razor_config.php');
			require('application/libraries/razorpay-php/Razorpay.php');			
			$success = true;
			 
			$error = "Payment Failed";
			if (empty($_POST['razorpay_payment_id']) === false)
			{
				$api = new Api($keyId, $keySecret);

					try
					{
						
						$attributes = array(
						'razorpay_order_id' => $session['subscribe_user']['razorpay_order_id'],
						'razorpay_payment_id' => $_POST['razorpay_payment_id'],
						'razorpay_signature' => $_POST['razorpay_signature']
						);

						$api->utility->verifyPaymentSignature($attributes);
					}
					catch(SignatureVerificationError $e)
					{
						$success = false;
						$error = 'Razorpay Error : ' . $e->getMessage();
					}
			}

			if ($success === true)
			{				
    			
				$post['user_transaction_id'] = $this->input->post('razorpay_payment_id');
				$post['user_transaction_status'] = '1';
				$post['user_id'] = $session['subscribe_user']['user_id']; 
				$update_res = $this->userlogin_model->updateVendorStatus($post);
				if(!empty($update_res))
				{					
					
						$subject = 'Party Shaarty';						
						$message .= 'Thanks for choosing Party Shaarty<br/><br/>';
						$message .= 'Your ragistration successfull.<br/><br/>';					
						$message .= '.Click To Login'.base_url();
						$mail = $this->send_mail($payer_email, $subject, $message);	
						if($mail)
						{
							redirect(base_url());
						}
				}
				
			}
			else
			{
				$del_res = $this->userlogin_model->deleteFaildVendore($session['subscribe_user']['user_id']);
				if($del_res)
				{
					redirect(base_url());
				}
				
			}
    }

     /*	Profile */
	public function profile() 
	{        
		if($this->checkSessionAdmin())
		{
			$user_id = $this->user_id;			
	     	$this->data['country_list'] = $this->userlogin_model->getCountryList();		
			$this->data['state_list'] = $this->userlogin_model->getStateList();
	     	$this->data['user_data'] = 	$this->userlogin_model->editUser($user_id);
		   	$this->show_view_front('front/user_profile',$this->data);		   	

		   	if(isset($_POST['update']))
		   	{		   		
		   		$post['user_id'] = $this->input->post('user_id');
				$post['user_name'] = $this->input->post('first_name').' '.$this->input->post('last_name');
				$post['user_phone'] = $this->input->post('user_phone_num');
				$post['user_city'] = $this->input->post('user_city');
				$post['user_country_id'] = $this->input->post('user_country_id');
				$post['user_state_id'] = $this->input->post('user_state_id');
				$user_update = $this->userlogin_model->updateProfile($post);
				if(!empty($user_update))
				{
					redirect(current_url());
				}
		   	}
		}
		else
		{
			redirect(base_url());
		}
    }


    //*********  Change Password *************

    public function checkChangePassword()
	{
		
		$post['user_id'] = $this->input->post('user_id');
		$post['old_password'] =$this->input->post('old_password');
		$res = $this->userlogin_model->checkChangePassword($post);
		echo $res;
	}

    public function changePassword() 
	{
		$post['new_password'] = $this->input->post('new_password');
		$post['user_id'] = $this->input->post('user_id');
		echo $res = $this->userlogin_model->changePassword($post);

	} 


				
}
?>
