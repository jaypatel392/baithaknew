<?php

class Shipping_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllShipping()
	{
		$this->db->select('*');
		$this->db->from('tbl_shipping');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New */	
	public function addShipping($post)
	{
		$this->db->insert('tbl_shipping', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit details */	
	public function editShipping($shipping_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_shipping');
		$this->db->where('shipping_id', $shipping_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateShipping($post)
	{		
		$data['shipping_name'] = $post['shipping_name'];
		$data['shipping_type'] = $post['shipping_type'];
		$data['shipping_value'] = $post['shipping_value'];
		$data['shipping_multiply_type'] = $post['shipping_multiply_type'];
		$data['shipping_multiply_value'] = $post['shipping_multiply_value'];
		$data['shipping_status'] = $post['shipping_status'];
		$data['shipping_updated_date'] = $post['shipping_updated_date'];
		$this->db->where('shipping_id', $post['shipping_id']);
		$this->db->update('tbl_shipping', $data);
		return true;
	}
	
	/* Delete detail */
	function delete_shipping($shipping_id)
	{
		$this->db->delete('tbl_shipping', array('shipping_id' => $shipping_id));		
		return 1;		
	}

}
?>
