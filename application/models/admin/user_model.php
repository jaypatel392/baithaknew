<?php

class User_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all User  */
	public function getAllUser()
	{
		$this->db->select('a.*');
		$this->db->from('tbl_user a');
		$this->db->where('a.user_role_id !=', '1');
		$this->db->where('a.user_role_id !=', '3');
		$this->db->where('a.user_status !=', '3');
		$this->db->where('a.user_id !=', '35');
		$this->db->where('a.user_status_type !=', 'Rejected');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getAllUserByRole($user_id)
	{
		$this->db->select('a.*');
		$this->db->from('tbl_user a');
		$this->db->where('a.added_by', $user_id);
		$this->db->where('a.user_status_type !=', 'Rejected');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Role List  */
	public function getRoleList()
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Country List  */
	public function getCountryList()
	{
		$this->db->select('*');
		$this->db->from('country');
		$this->db->where('country_id', '99');
		$this->db->where('country_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getStateList()
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('country_id', '99');
		$this->db->where('state_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}


	/*	Get all State List by country list */
	public function getStateListByCountryId($country_id)
	{
		$this->db->select('*');
		$this->db->from('state');
		$this->db->where('state_status', '1');
		$this->db->where('country_id', $country_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New User */	
	public function addUser($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit User details */	
	public function editUser($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updateUser($post,$user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}
	
	/* Approve User */
	public function approveUser($user_id,$post)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}
	/* Reject User */
	public function rejectUser($user_id)
	{		
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', $post);
		return true;
	}
	
	/* Delete User detail */
	function delete_user($user_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $user_id));		
		return 1;		
	}

}
?>
