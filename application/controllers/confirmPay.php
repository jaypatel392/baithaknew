<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;


class ConfirmPay extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model('front/homepage_model');
	}

	

}
/* End of file */
?>