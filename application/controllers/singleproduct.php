<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Singleproduct extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/singleproduct_model');
	}
	
	public function viewProductDetail()
	{
		if (isset($_POST['Add_cart']))
		{				
				
			$crt_product_id = $this->input->post('crt_product_id');
			$crt_product_title = $this->input->post('crt_product_title');
			$crt_product_price = $this->input->post('crt_product_price');
			$crt_product_thumb_img = $this->input->post('crt_product_thumb_img');
			$crt_attr_val = $this->input->post('crt_attr_val_id');
			$crt_product_title = preg_replace('/[-+,]/', '', $crt_product_title);     
    		
             $cart_data = array(
				'id'   => $crt_product_id,
				'name' => $crt_product_title,				
				'price'=> $crt_product_price,
				'qty'  => 1,
				'product_image' => $crt_product_thumb_img,
				'attr' => $crt_attr_val
			); 
            
		 $add_cart_res = $this->cart->insert($cart_data);
		if($add_cart_res)
		{
			redirect(base_url().'singleproduct/viewProductDetail/'.$crt_product_id);
		}
		
		}
		else
		{

			$prdct_id = $this->uri->segment(3);
			$this->data['threeImg'] = $this->singleproduct_model->getThreeProductImage($prdct_id);
			$this->data['productDetail'] = $this->singleproduct_model->getProductDetail($prdct_id);
			$this->data['productAttributes'] = $this->singleproduct_model->getProductAttributes($prdct_id);
			$this->data['specifications'] = $this->singleproduct_model->getProductSpecifications($prdct_id);
			$this->data['reviews'] = $this->singleproduct_model->getReviews($prdct_id);

			$this->show_view_front('front/single',$this->data);
		}

	}  //################## Function End ######################

}  /* End of file */

?>