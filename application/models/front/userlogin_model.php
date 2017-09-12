<?php
 class Userlogin_model extends CI_Model {
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	/* Add New Role */	
	public function user_registration($post)
	{
		$this->db->insert('tbl_user', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	/* Edit details */	
	public function checkUserEmailId($email_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $email_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function checkUserLogin($post)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_email', $post['user_email']);
		$this->db->where('user_password', $post['user_password']);
		$this->db->where('user_status', '1');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSubscribeDetailsById($user_id)
	{
		$this->db->select('a.*,b.subscribe_charge');
		$this->db->from('tbl_user a');
		$this->db->join('tbl_subscribe b', 'a.subscribe_plan_id = b.subscribe_id','inner');
		$this->db->where('a.user_id', $user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateVendorStatus($post)
	{

		$data['user_transaction_id'] = $post['user_transaction_id'];
		$data['user_transaction_status'] = $post['user_transaction_status'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('tbl_user', $data);
		return true;
	}

	function deleteFaildVendore($user_id)
	{
		$this->db->delete('tbl_user', array('user_id' => $user_id));		
		return 1;		
	}
}
?>