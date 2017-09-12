<?php

class Specification_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all  */
	public function getAllSpecification()
	{
		$this->db->select('*');
		$this->db->from('tbl_specification');
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getSpecificationValue()
	{
		$this->db->select('*');
		$this->db->from('tbl_specification_val');
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Add New */	
	public function addSpecification($post)
	{
		$this->db->insert('tbl_specification', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
 
  /* Update */
	public function addSpecificationValue($post)
	{		
		$data['specification_val'] = $post['specification_val'];
		$data['specification_id'] = $post['specification_id'];
		$this->db->insert('tbl_specification_val', $data);
		return true;
	}
	
	/* Edit details */	
	public function editSpecification($specification_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_specification');
		$this->db->where('specification_id', $specification_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function editspecificationValue($specification_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_specification_val');
		$this->db->where('specification_id', $specification_id);
		$query = $this->db->get();
		return $query->result();
	}
	/* Update */
	public function updateSpecification($post)
	{		
		$data['specification_name'] = $post['specification_name'];
		$data['specification_status'] = $post['specification_status'];
		$data['specification_type'] = $post['specification_type'];
		$this->db->where('specification_id', $post['specification_id']);
		$this->db->update('tbl_specification', $data);
		return true;
	}

	public function updateSpecificationValue($post)
	{		
		$data['specification_val'] = $post['specification_val'];
		$this->db->where('specification_val_id', $post['specification_val_id']);
		$this->db->update('tbl_specification_val', $data);
		return true;
	}
	
	/* Delete detail */
	function delete_specification($specification_id)
	{
		$this->db->delete('tbl_specification_val', array('specification_id' => $specification_id));	
		$this->db->delete('tbl_specification', array('specification_id' => $specification_id));		
		return 1;		
	}

}
?>
