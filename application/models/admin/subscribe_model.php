<?php

class Subscribe_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllSubscribePlan()
	{
		$this->db->select('*');
		$this->db->from('tbl_subscribe'); 		
        $this->db->where('subscribe_status', '1');
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
	public function addsubscribe($post)
	{
		$this->db->insert('tbl_subscribe', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/* Edit Role details */	
	public function editSubscribe($subs_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_subscribe');
		$this->db->where('subscribe_id', $subs_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	/* Update Category */
	public function updateSubscribe($post)
	{	
		
		$data['subscribe_name'] = $post['subscribe_name'];
		$data['subscribe_plan'] = $post['subscribe_plan'];
		$data['subscribe_limit'] = $post['subscribe_limit'];	
		$data['subscribe_charge'] = $post['subscribe_charge'];
		$data['subscribe_description'] = $post['subscribe_description'];
		$data['subscribe_status'] = $post['subscribe_status'];
		$data['subscribe_update_date'] = $post['subscribe_update_date'];
		$this->db->where('subscribe_id', $post['subscribe_id']);
		$this->db->update('tbl_subscribe', $data);
		return true;
	}
	
	/* Delete category detail */
	function delete_subscribe($subs_id)
	{
		$this->db->delete('tbl_subscribe', array('subscribe_id' => $subs_id));			
		return 1;		
	}

	
}
?>
