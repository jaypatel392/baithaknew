<?php

class event_model extends CI_Model 
{
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
	/*	Show all event  */
	public function getAllEvent()
	{
		$this->db->select('*');
		$this->db->from('tbl_event');
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Role List  */
	public function getRoleList()
	{
		$this->db->select('*');
		$this->db->from('tbl_role');
		$this->db->where('role_status', '1');
		$this->db->where('role_id !=', '1');
		$query = $this->db->get();
		return $query->result() ;
	}

	

	/*	Get all Category List  */
	public function getCategoryList()
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_parent_id', '0');
		$this->db->where('category_type', 'Event');
		$query = $this->db->get();
		return $query->result() ;
	}

	
	/*	Get all Tax List  */
	public function getDiscountList()
	{
		$this->db->select('*');
		$this->db->from('tbl_discount');
		$this->db->where('discount_status', '1');		
		$this->db->where('discount_end_date >=', date('Y-m-d'));		
		$query = $this->db->get();
		return $query->result() ;
	}

	
	/*	Get all State List by country list */
	public function getSubCategoryList($category_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_status', '1');
		$this->db->where('category_parent_id', $category_id);
		$query = $this->db->get();
		return $query->result() ;
	}

/*	Show all Role  */
	public function getAllSpecification($category_id)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_category_specification a'); 
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','left');
		$this->db->where('category_id', $category_id);
		$query = $this->db->get();		
		return $query->result();

	}

	public function getAllSpecificationVal($specification_id)
	{
		$this->db->select('*');
		$this->db->from(' tbl_specification_val'); 
		$this->db->where('specification_id', $specification_id);
		$query = $this->db->get();		
		return $query->result();

	}
	/* Add New event */	
	public function addEvent($post)
	{
		$this->db->insert('tbl_event', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

   public function addEventDateTime($post)
	{
		$this->db->insert('tbl_event_date_time', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	public function addEventAttribute($post)
	{
		$this->db->insert('tbl_event_attribute', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}

	public function addEventSpecification($post)
	{
		$this->db->insert('tbl_event_specification', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	public function addEventImags($post)
	{
		$this->db->insert('tbl_event_img', $post);
		$this->result = $this->db->insert_id() ; 
		return $this->result ;
	}	

	/* Edit event details */	
	public function editEvent($event_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_id', $event_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	/*	Get all Event Attribute List  */
	public function editEventAttr($event_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_event_attribute');	
		$this->db->where('event_id', $event_id);
		$query = $this->db->get();
		return $query->result() ;
	}

    /*	Get all Event Specification List  */
	public function editEventSpecification($event_id)
	{
		$this->db->select('a.*, b.*');
		$this->db->from('tbl_event_specification a');
		$this->db->join('tbl_specification b','a.specification_id = b.specification_id','left');
		$this->db->where('event_id', $event_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Event Images List  */
	public function editEventImages($event_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_event_img');		
		$this->db->where('event_id', $event_id);
		$query = $this->db->get();
		return $query->result() ;
	}

	/*	Get all Event Date Time List  */
	public function editEventDateTime($event_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_event_date_time');		
		$this->db->where('event_id', $event_id);
		$query = $this->db->get();
		return $query->result() ;
	}



	/* Update event */
	public function updateEvent($post)
	{		
		$data['event_type'] = $post['event_type'];
		$data['event_title'] = $post['event_title'];
		$data['event_phone'] = $post['event_phone'];
		$data['event_status'] = $post['event_status'];
		$data['event_country_id'] = $post['event_country_id'];
		$data['event_state_id'] = $post['event_state_id'];
		$data['event_city'] = $post['event_city'];
		$data['event_address_1'] = $post['event_address_1'];
		$data['event_address_2'] = $post['event_address_2'];
		$data['event_postal_code'] = $post['event_postal_code'];
		$data['event_updated_date'] = $post['event_updated_date'];
		$this->db->where('event_id', $post['event_id']);
		$this->db->update('tbl_event', $data);
		return true;
	}
	
	/* Delete event detail */
	function delete_event($event_id)
	{
		$this->db->delete('tbl_event', array('event_id' => $event_id));		
		return 1;		
	}

}
?>
