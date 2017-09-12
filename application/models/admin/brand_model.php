<?php

class Brand_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllBrand()
	{
		$this->db->select('*');
		$this->db->from('tbl_brand'); 
		$query = $this->db->get();		
		return $query->result();

	}
	

	/* Add New Role */	
	public function addBrand($post)
	{
		$this->db->insert('tbl_brand', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/* Edit Role details */	
	public function editBrand($brand_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	/* Update role */
	public function updateBrand($post)
	{	
		if($post['brand_logo']){
			$data['brand_name'] = $post['brand_name'];
			$data['brand_description'] = $post['brand_description'];
			$data['brand_status'] = $post['brand_status'];
			$data['brand_logo'] = $post['brand_logo'];
			$data['brand_updated_date'] = $post['brand_updated_date'];
		}else{
			$data['brand_name'] = $post['brand_name'];
			$data['brand_description'] = $post['brand_description'];
			$data['brand_status'] = $post['brand_status'];
			$data['brand_updated_date'] = $post['brand_updated_date'];
		}
		$this->db->where('brand_id', $post['brand_id']);
		$this->db->update('tbl_brand', $data);
		return true;
	}
	
	
	/* Delete Role detail */
	function delete_brand($brand_id)
	{
		$this->db->delete('tbl_brand', array('brand_id' => $brand_id));		
		return 1;		
	}
	function checkbrand($brand_name){
		$this->db->select('*');
		$this->db->from('tbl_brand');
		$this->db->where('brand_name', $brand_name);
		$query = $this->db->get();
		return $query->result();
	}
		
}
?>
