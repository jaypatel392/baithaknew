<?php

class legalpage_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllLegalPageData()
	{
		$this->db->select('*');
		$this->db->from('tbl_legal_page');
		$query = $this->db->get();
		return $query->result() ;
	}

	
	/* Edit details */	
	public function editLegalPage($legalPage_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_legal_page');
		$this->db->where('legal_page_id', $legalPage_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateLegalPage($post)
	{		
		$data['legal_page_description'] = $post['legal_page_description'];
		$data['legal_page_updated_date'] = $post['legal_page_updated_date'];
		$this->db->where('legal_page_id', $post['legal_page_id']);
		$this->db->update('tbl_legal_page', $data);
		return true;
	}
	
	
}
?>
