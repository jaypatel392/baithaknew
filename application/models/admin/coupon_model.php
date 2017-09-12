<?php

class Coupon_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllCoupon()
	{
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Show all  */
	public function getAllUserList()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_status', '1');
		$this->db->where('user_role_id', '0');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New */	
	public function addCoupon($post)
	{
		$this->db->insert('tbl_coupon', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit details */	
	public function editCoupon($coupon_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('coupon_id', $coupon_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateCoupon($post)
	{		
		$data['coupon_code'] = $post['coupon_code'];
		$data['coupon_value'] = $post['coupon_value'];
		$data['coupon_start_date'] = $post['coupon_start_date'];
		$data['coupon_end_date'] = $post['coupon_end_date'];
		$data['coupon_type'] = $post['coupon_type'];
		$data['coupon_status'] = $post['coupon_status'];
		$data['coupon_updated_date'] = $post['coupon_updated_date'];
		$this->db->where('coupon_id', $post['coupon_id']);
		$this->db->update('tbl_coupon', $data);
		return true;
	}
	
	/* Delete detail */
	function delete_coupon($coupon_id)
	{
		$this->db->delete('tbl_coupon', array('coupon_id' => $coupon_id));		
		return 1;		
	}

	function checkCouponCode($coupon_code,$coupon_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_coupon');
		$this->db->where('coupon_code', $coupon_code);
		$this->db->where('coupon_id !=', $coupon_id);
		$query = $this->db->get();
		return $query->result();
	}

}
?>
