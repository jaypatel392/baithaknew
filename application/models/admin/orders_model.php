<?php

class orders_model extends CI_Model 
{
	
	/*	Show all Role  */
	public function getAllOrders()
	{
		$this->db->select('a.*,b.*');
		$this->db->from('tbl_order a');	
		$this->db->join('tbl_user b','a.order_user_id = b.user_id','inner');
       	$query = $this->db->get();		
		return $query->result();

	}

	/*	Show all Role  */
	public function getAllOrdersProducts($order_id)
	{
		$this->db->select('a.*,b.*,c.user_name');
		$this->db->from('tbl_order_product a');
		$this->db->join('tbl_product b','a.product_id = b.product_id','inner');
		$this->db->join('tbl_user c','b.added_by = c.user_id','inner');
		$this->db->where('a.order_id', $order_id);	
		$query = $this->db->get();
		return $query->result() ;

	}

	public function getProductAttrDetails($attr_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr');
		$this->db->where('attr_id', $attr_id);
		$query = $this->db->get();		
		return $query->result();
	}

	public function getProductAttrValueDetails($attr_val_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_product_attr_val');
		$this->db->where('attr_val_id', $attr_val_id);
		$query = $this->db->get();		
		return $query->result();
	}

	public function getOrderById($order_id)
	{
		$this->db->select('a.*,b.*,c.*,d.country_name as D_country_name ,e.country_name as B_country_name,f.state_name as D_state_name,g.state_name as B_state_name');
		$this->db->from('tbl_order a');
		$this->db->join('tbl_user_address b','a.order_user_d_address_id = b.user_address_id','inner');
		$this->db->join('country d','d.country_id = b.user_address_country_id','inner');
		$this->db->join('state f','f.state_id = b.user_address_state_id','inner');
		$this->db->join('tbl_user_address c','a.order_user_b_address_id = c.user_address_id','inner');
		$this->db->join('country e','e.country_id = c.user_address_country_id','inner');
			$this->db->join('state g','g.state_id = c.user_address_state_id','inner');
		$this->db->where('a.order_id', $order_id);
		$query = $this->db->get();		
		return $query->result();
	}

	public function updateOrderTrackStatus($order_id , $post)
	{
		$this->db->where('order_id', $order_id);
		$this->db->update('tbl_order', $post);
		return true;
	}	

	public function getOrderDetailsById($order_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('tbl_order a');
		$this->db->join('tbl_user b','a.order_user_id = b.user_id','inner');
		$this->db->where('a.order_id' , $order_id);
		$this->db->where('a.order_status' , '1');
		$query = $this->db->get();		
		return $query->row();
	}

	public function getUserAddressByAddressID($user_address_id)
 	{		
		$this->db->select('a.*, b.country_name, c.state_name');
		$this->db->from('tbl_user_address a');
		$this->db->join('country b','a.user_address_country_id = b.country_id','INNER');
		$this->db->join('state c','a.user_address_state_id = c.state_id','INNER');
		$this->db->where('a.user_address_id', $user_address_id);
		$query = $this->db->get();
		return $query->row() ;
 	}

 	public function getOrderProductList($order_id)
 	{
		$this->db->select('a.*,b.*,c.*');
		$this->db->from('tbl_order_product a');
		$this->db->join('tbl_cart b','a.cart_id = b.cart_id','left');
		$this->db->join('tbl_product c','a.product_id = c.product_id','left');
		$this->db->where('a.order_id', $order_id);
		$query = $this->db->get();
		return $query->result();
 	}

}