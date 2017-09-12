<?php

class Page_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	get Help Page   */
	public function getHelpPage()
	{
		$this->db->select('help_page_descriprion');
		$this->db->from('tbl_help_page'); 
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	get Legal Page   */
	public function getLegalPage()
	{
		$this->db->select('legal_page_description');
		$this->db->from('tbl_legal_page'); 
		$query = $this->db->get();
		return $query->result() ;
	}


	/* add Help Messages */	
	public function addHelpMessages($post)
	{
		$this->db->insert('tbl_help_msg', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

}
?>
