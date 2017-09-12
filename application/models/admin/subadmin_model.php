<?php

class Subadmin_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all User  */
	public function getAllSubAdmin()
	{
		$this->db->select('*');
		$this->db->from('tbl_user');		
		$this->db->where('user_role_id =', '3');
		$this->db->order_by('user_status','ASC');
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
		$this->db->where('country_status', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all State List  */
	public function getStateList()
	{
		$this->db->select('*');
		$this->db->from('state');
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
	public function addSubAdmindmin($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit User details */	
	public function editSubAdmin($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update User */
	public function updatesubAdmin($post)
	{		
		
		$data['user_name'] = $post['user_name'];
		$data['user_phone'] = $post['user_phone'];
		$data['user_status'] = $post['user_status'];
		$data['user_country_id'] = $post['user_country_id'];
		$data['user_state_id'] = $post['user_state_id'];
		$data['user_city'] = $post['user_city'];
		$data['user_address_1'] = $post['user_address_1'];
		$data['user_address_2'] = $post['user_address_2'];
		$data['user_postal_code'] = $post['user_postal_code'];
		$data['user_updated_date'] = $post['user_updated_date'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
	}

	public function updateStatus($post)
	{		
		
		$data['user_status'] = $post['user_status'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
	}
	
	/* Delete User detail */
	function deleteSubAdmin($user_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $user_id));		
		return 1;		
	}

}
?>
