<?php

class Login_model extends CI_Model {

	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}

	/*	Check User Login Function */
	function checkUserLogin($data)
	{
		$user_email = $data['user_email'];		
		$user_password = $data['password'];		
        $this->db->select('*');
		$this->db->from('tbl_user');	
		$this->db->where('user_email',$user_email);
		$this->db->where('user_password',$user_password);
		$this->db->where('user_status','1');
		$query = $this->db->get();
		return $query->result(); ;
	}	

	/*	get User details for update profile  */
	function getUserDetails($user_id)
	{	
        $this->db->select('*');
		$this->db->from('tbl_user');	
		$this->db->where('user_id',$user_id);
		$this->db->where('user_status','1');
		$query = $this->db->get();		
		return $query->result(); ;
	}	

	/*	update User Profile	*/
	function updateProfile($post)
	{
		$data['user_name'] = $post['user_name'];
		$data['user_phone'] = $post['user_phone'];
		if($post['user_password'])
		{
			$data['user_password'] = $post['user_password'];			
		}
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data); 		
		return true; 		
	}
	













	
	
	
	/*	Check User Login Function */
	function CheckLogin($data)
	{
		$email = $data['admin_email'];
		$password = $data['admin_password'];
		
        $this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_password',$password);
		$this->db->where('admin_email',$email);
		$this->db->where('admin_active_status','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}	
	
	/*	Block User */
	function blockUser($post)
	{
        $data = array(
			'admin_active_status'=>$post['admin_active_status'],
			'admin_modify_date'=>$post['admin_modify_date'],	
		);		
		$this->db->where('admin_email', $post['admin_email']);
		$this->db->update('admin', $data); 		
		return true; 
	}
	
	/* Get User Details */
	function getUserProfileDetails($admin_id)
	{
		$this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_id',$admin_id);
		$this->db->where('admin_active_status','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}
	
	/* Check Old Password */
	function checkpassword($data)
	{
		$admin_id = $data['admin_id'];
		$password = $data['old_password'];
		
        $this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_password',$password);
		$this->db->where('admin_id',$admin_id);
		$this->db->where('admin_active_inactive','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}
	
	/*	update User Password	*/
	function updateUserPassword($post)
	{
		$data['admin_password'] = $post['new_password'];
		$this->db->where('admin_id', $post['admin_id']);
		$this->db->update('admin', $data); 		
		return true; 		
	}
	
	/* Check mail for forgot password */
	function CheckEmail($email)
	{
		$this->db->select('*');
		$this->db->from('admin');	
		$this->db->where('admin_email',$email);
		$this->db->where('admin_active_inactive','1');
		$query = $this->db->get();		
		$result=$query->result();
		return $result ;
	}
	
	/*	Reset User Password	*/
	function reset_password($post)
	{
		$data['admin_password'] = $post['password'];
		$this->db->where('admin_email', $post['email']);
		$this->db->where('admin_active_inactive','1');
		$this->db->update('admin', $data); 		
		return true; 		
	}
}
?>