<?php

class Role_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllRole()
	{
		$this->db->select('*');
		$this->db->from('tbl_role'); 
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
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
	public function addRole($post)
	{
		$this->db->insert('tbl_role', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Add Role Permissions */	
	function addRolePermission($post_permission)
	{
		$this->db->insert('user_permission', $post_permission);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit Role details */	
	public function editRole($role_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_id', $role_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getRolePermissionByRoleID($role_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('user_permission a');
		$this->db->join('sidebar_tabs b','a.tab_id = b.tab_id','inner');
		$this->db->where('a.role_id', $role_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update role */
	public function updateRole($post)
	{		
		$data['role_name'] = $post['role_name'];
		$data['role_name'] = $post['role_name'];
		$data['role_status'] = $post['role_status'];
		$data['role_updated_date'] = $post['role_updated_date'];
		$this->db->where('role_id', $post['role_id']);
		$this->db->update('tbl_role', $data);
		return true;
	}
	
	/* Update role */
	public function updateRolePermission($post_permission)
	{		
		$data['userView'] = $post_permission['userView'];
		$data['userAdd'] = $post_permission['userAdd'];
		$data['userEdit'] = $post_permission['userEdit'];
		$data['userDelete'] = $post_permission['userDelete'];
		$this->db->where('user_permission_id', $post_permission['user_permission_id']);
		$this->db->update('user_permission', $data);
		return true;
	}

	/* Delete Role detail */
	function delete_role($role_id)
	{
		$this->db->delete('tbl_role', array('role_id' => $role_id));		
		return 1;		
	}
	
	/* Delete Role permissions */
	function delete_rolePermissions($role_id)
	{
		$this->db->delete('user_permission', array('role_id' => $role_id));		
		return 1;		
	}
}
?>
