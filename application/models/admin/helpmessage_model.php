<?php

class Helpmessage_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllhelpMessageData()
	{
		$this->db->select('*');
		$this->db->from('tbl_help_msg');
		$query = $this->db->get();
		return $query->result() ;
	}

	function delete_message($msg_id)
	{
		$this->db->delete('tbl_help_msg', array('help_msg_id' => $msg_id));		
		return 1;		
	}
}
?>
