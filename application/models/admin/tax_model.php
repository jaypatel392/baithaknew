<?php

class Tax_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllTax()
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New */	
	public function addTax($post)
	{
		$this->db->insert('tbl_tax', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit details */	
	public function editTax($tax_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tax');
		$this->db->where('tax_id', $tax_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/* Update */
	public function updateTax($post)
	{		
		$data['tax_name'] = $post['tax_name'];
		$data['tax_type'] = $post['tax_type'];
		$data['tax_value'] = $post['tax_value'];
		$data['tax_status'] = $post['tax_status'];
		$data['tax_updated_date'] = $post['tax_updated_date'];
		$this->db->where('tax_id', $post['tax_id']);
		$this->db->update('tbl_tax', $data);
		return true;
	}
	
	/* Delete detail */
	function delete_tax($tax_id)
	{
		$this->db->delete('tbl_tax', array('tax_id' => $tax_id));		
		return 1;		
	}

}
?>
