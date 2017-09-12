<?php

class Measurement_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllMeasurement()
	{
		$this->db->select('*');
		$this->db->from('tbl_measurement');
		$query = $this->db->get();		
		return $query->result();
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
	public function addMeasurement($post)
	{
		$this->db->insert('tbl_measurement', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/* Edit Role details */	
	public function editMeasurement($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_measurement');
		$this->db->where('measurement_id', $cat_id);

		$query = $this->db->get();
		return $query->result();
	}
	
	
	/* Update Measurement */
	public function updateMeasurement($post)
	{		
		$this->db->where('measurement_id', $post['measurement_id']);
		$this->db->update('tbl_measurement', $data);
		return true;
	}
	
	/* Delete measurement detail */
	function deleteMeasurement($cat_id)
	{
		$this->db->delete('tbl_measurement', array('measurement_id' => $cat_id));			
		return true;		
	}
		
}
?>
