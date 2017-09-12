<?php

class Discountmrp_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllDiscountMrp()
	{
		$this->db->select('*');
		$this->db->from('tbl_discountmrp');
		$query = $this->db->get();		
		return $query->result();
	}
 
	/* Get All Tab list */
	function getAllTabs()
	{
		$this->db->select('*');
		$this->db->from('sidebar_tabs');
		$this->db->where('status', '1');
		$this->db->order_by('tab_number', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	/* Add New Role */	
	public function addDiscountMrp($post)
	{
		$this->db->insert('tbl_discountmrp', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/* Edit Role details */	
	public function editDiscountMrp($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_discountmrp');
		$this->db->where('discountmrp_id', $cat_id);

		$query = $this->db->get();
		return $query->result();
	}
	
	
	/* Update DiscountMrp */
	public function updateDiscountMrp($post,$discountmrp_id)
	{		
		$this->db->where('discountmrp_id',$discountmrp_id);
		$this->db->update('tbl_discountmrp', $post);
		return true;
	}
	
	/* Delete discountmrp detail */
	function deleteDiscountMrp($discountmrp_id)
	{
		$this->db->delete('tbl_discountmrp', array('discountmrp_id' => $discountmrp_id));			
		return true;		
	}
		
}
?>
