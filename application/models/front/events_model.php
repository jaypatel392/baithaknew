<?php

 class Events_model extends CI_Model {
	function __construct()
	{
       parent::__construct();
	   $this->load->database();
	}
	
      public function getEventsList(){
	
		$this->db->select('*');
		$this->db->from('tbl_event'); 
		$this->db->where('event_end_Date >', date('Y-m-d'));
		$this->db->where('event_status', '1');
		$query = $this->db->get();
		return $query->result();

	}


	public function getEventImages($event_id){

		$this->db->select('*');
		$this->db->from('tbl_event_img');
		$this->db->where('event_id',$event_id);
		$query = $this->db->get();
		return $query->result();

	}


	public function getEventscategory(){

		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->where('category_type','Event');
		$query = $this->db->get();
		return $query->result();
	
	}



	public function getEventsByCategoryId($cat_id){

		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_parent_category_id',$cat_id);
		$this->db->where('event_end_Date >', date('Y-m-d'));
		$this->db->where('event_status', '1');
		$query = $this->db->get();
		return $query->result();
	}



	
         public function getEventsDetail($event_id){

 		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_id',$event_id);
		$this->db->where('event_status', '1');
		$query = $this->db->get();
		return $query->result();


      	}

 	public function getEventsImgs($event_id){

		$this->db->select('*');
		$this->db->from('tbl_event_img');
		$this->db->where('event_id',$event_id);
		$this->db->where('event_img_status','1');
		$query = $this->db->get();	
		return $query->result();
	}
	


	public function getEventattributes($event_id){

		$this->db->select('*');
		$this->db->from('tbl_event_attribute');
		$this->db->where('event_id',$event_id);
		$query = $this->db->get();
		return $query->result();

	}

     public function getEventSpecifications($event_id)
	 {

	 	$this->db->select('*');
		$this->db->from('tbl_event_specification a');
		$this->db->join('tbl_specification b', 'a.specification_id = b.specification_id');
		$this->db->join('tbl_specification_val c' ,'a.specification_val_id = c.specification_val_id');
		$this->db->where('a.event_id',$event_id);
		$query = $this->db->get();
		return $query->result();

	 }
}
?>