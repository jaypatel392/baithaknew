<?php

class Discount_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllDiscount()
	{
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New */	
	public function addDiscount($post)
	{
		$this->db->insert('tbl_discount', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit details */	
	public function editDiscount($discount_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_id', $discount_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateDiscount($post)
	{		
		$data['discount_name'] = $post['discount_name'];
		$data['discount_type'] = $post['discount_type'];
		$data['discount_value'] = $post['discount_value'];
		$data['discount_start_date'] = $post['discount_start_date'];		
		$data['discount_end_date'] = $post['discount_end_date'];
		$data['discount_status'] = $post['discount_status'];
		$data['discount_updated_date'] = $post['discount_updated_date'];
		$this->db->where('discount_id', $post['discount_id']);
		$this->db->update('tbl_discount', $data);
		return true;
	}
	
	/* Delete detail */
	function delete_discount($discount_id)
	{
		$this->db->delete('tbl_discount', array('discount_id' => $discount_id));		
		return 1;		
	}

}
?>
