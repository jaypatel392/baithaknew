<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/orders_model');
	}

	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['orders_list'] = $this->orders_model->getAllOrders();		
			$this->show_view_admin('admin/orders_details', $this->data);			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function orderDetails($order_id ='')
    {
    	if($this->checkViewPermission())
		{			
			$this->data['order_details'] = $this->orders_model->getOrderDetailsById($order_id);
			$this->data['order_products'] = $this->orders_model->getOrderProductList($order_id);     
			$order_details = $this->data['order_details'];			
    		$this->data['billing_address'] = $this->orders_model->getUserAddressByAddressID($order_details->order_user_b_address_id);    
			$this->data['delivery_address'] = $this->orders_model->getUserAddressByAddressID($order_details->order_user_d_address_id);  			
			$this->show_view_admin('admin/orders_products', $this->data);			 
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }

    public function changeOrderStatus($order_id = NULL)
    {
    	if($order_id != NULL)
    	{
	    	if($this->checkEditPermission())
			{			
				if(isset($_POST['Submit']) && $_POST['Submit'] == 'Edit')
				{
					$post['order_track_status'] = $this->input->post('order_track_status');
					$update_res = $this->orders_model->updateOrderTrackStatus($order_id,$post);
					if($update_res)
					{
						$msg = 'Order status update successfully!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect('admin/orders');
					}
				}
				$this->data['orders_details'] = $this->orders_model->getOrderById($order_id);
				$this->show_view_admin('admin/change_order_status', $this->data);

			}
			else
			{	
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
		else
		{
			redirect('admin/orders');
		}
    }

    public function orderInvoicePdf($order_id)
    {
    	$this->data['order_details'] = $this->orders_model->getOrderDetailsById($order_id);
    	$this->data['order_products'] = $this->orders_model->getOrderProductList($order_id);
    	$order_details = $this->data['order_details'];
    	$this->data['delivery_address'] = $this->orders_model->getUserAddressByAddressID($order_details->order_user_d_address_id);
    	$this->data['billing_address'] = $this->orders_model->getUserAddressByAddressID($order_details->order_user_b_address_id);    
    	$this->load->library('m_pdf');
        $html = $this->load->view('admin/order_invoice',$this->data,TRUE);   
		$pdfFilePath = 'invoice'.'_'.time().".pdf";     
		$this->m_pdf->pdf->WriteHTML($html);
		$this->m_pdf->pdf->Output($pdfFilePath , 'D');
    }    

}
?>