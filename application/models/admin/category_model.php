<?php

class Category_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all Role  */
	public function getAllCategory()
	{
		$this->db->select('a.*, b.category_name as parent_category_name');
		$this->db->from('tbl_category a'); 
		$this->db->join('tbl_category b','a.category_parent_id = b.category_id','left');
        $this->db->where('a.category_status', '1');
        $this->db->order_by('a.category_id','DESC');
		$query = $this->db->get();		
		return $query->result();
	}

	/*	Show all Role  */
	public function getAllSpecificationCategory()
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_category_specification a'); 
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','left');
		$query = $this->db->get();		
		return $query->result();

	}

	public function getCategorySpecificationValue($cat_id)
	{
	    $this->db->select('*');
		$this->db->from('tbl_category_specification'); 
		$this->db->where('category_id',$cat_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getParentCategory($category_id = NULL)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		if($category_id != NULL)
		{
			$this->db->where('category_id != ', $category_id);
		} 
		$this->db->where('category_status', '1');
		$query = $this->db->get();
		return $query->result();
	}
	public function getParentSubCategory($parent_cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category'); 
		$this->db->where('category_parent_id' , $parent_cat_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	public function getSpecificationValue()
	{
		$this->db->select('*');
		$this->db->from('tbl_specification'); 
		$query = $this->db->get();
		return $query->result() ;
	}

	/* Update */
	public function addSpecificationValue($post)
	{		
		$this->db->insert('tbl_category_specification', $post);
		return true;
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
	public function addCategory($post)
	{
		$this->db->insert('tbl_category', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	
	
	/* Edit Role details */	
	public function editCategory($cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_id', $cat_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	/* Update Category */
	public function updateCategory($post,$category_id)
	{	
		$this->db->where('category_id', $category_id);
		$this->db->update('tbl_category', $post);
		return true;
	}
	
	/* Delete category detail */
	function delete_category($cat_id)
	{
		$this->db->delete('tbl_category', array('category_id' => $cat_id));	
		$this->db->delete('tbl_category_specification', array('category_id' => $cat_id));
		return 1;		
	}

	function delete_specification($cat_id)
	{		
		$this->db->delete('tbl_category_specification', array('category_id' => $cat_id));
		return 1;		
	}

	function checkCategory($category_name,$category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_name', $category_name);
		$this->db->where('category_id !=', $category_id);
		$query = $this->db->get();
		return $query->result();
	}

	function getSpecificationBytype($specification_type)
	{
		$this->db->select('*');
		$this->db->from('tbl_specification');
		$this->db->where('specification_type', $specification_type);		
		$query = $this->db->get();
		return $query->result();
	}
		
}
?>
