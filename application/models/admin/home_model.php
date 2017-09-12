<?php

class Home_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all tabs as per role_id  */
	public function getAllTabAsPerRole($role_id)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('user_permission a'); 
		$this->db->join('sidebar_tabs b','a.tab_id = b.tab_id','inner');
		$this->db->where('a.role_id', $role_id);
		$this->db->where('b.status', '1');
		$this->db->order_by('b.tab_number', 'ASC');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Show all product  */
	public function getAllProductNotfication()
	{
		$this->db->select('a.*,b.user_name,b.user_id');
		$this->db->from('tbl_product a');
		$this->db->join('tbl_user b','a.added_by = b.user_id','inner');
		$this->db->where('a.notify_status', 1);	
		$this->db->where('a.product_status', 0);	
		$this->db->where('a.added_by !=', 1);	
		$query = $this->db->get();
		return $query->result() ;
	}

	
}
?>
