<?php

class Helppage_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllhelpPageData()
	{
		$this->db->select('*');
		$this->db->from('tbl_help_page');
		$query = $this->db->get();
		return $query->result() ;
	}

	
	/* Edit details */	
	public function edithelpPage($helpPage_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_help_page');
		$this->db->where('help_page_id', $helpPage_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateHelpPage($post)
	{		
		$data['help_page_description'] = $post['help_page_description'];
		$data['help_page_updated_date'] = $post['help_page_updated_date'];
		$this->db->where('help_page_id', $post['help_page_id']);
		$this->db->update('tbl_help_page', $data);
		return true;
	}
	
	
}
?>
