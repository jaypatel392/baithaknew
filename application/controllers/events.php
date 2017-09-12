<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/events_model');
	}
	
	public function index(){
		
		$this->data['events'] = $this->events_model->getEventsList();
		//echo "<pre>";
		//print_r($this->data['events']);die;
	        $this->data['categoryIvents'] = $this->events_model->getEventscategory();
		$this->show_view_front('front/events',$this->data);	
		
    }
    public function eventSortBycatId(){

		$cat_id = $this->input->post('cat_id');
		$events = $this->events_model->getEventsByCategoryId($cat_id);

		
			$html ='';
			$html .= '<div class="w3ls_mobiles_grid_right_grid3">';
			foreach ($events as $value) {

							$html .= '<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
							<div class="agile_ecommerce_tab_left mobiles_grid">
								<div class="hs-wrapper hs-wrapper2">';
								 $events_imgs =  $this->events_model->getEventImages($value->event_id);
								foreach ($events_imgs as $valueImg) { 
									$html .='<img src="'.$valueImg->event_img_name.'" alt=" " class="img-responsive" />';
								}
								 
									
									
								$html .=	'<div class="w3_hs_bottom w3_hs_bottom_sub1">
										<ul>
											<li>
												<a href="#" data-toggle="modal" data-target="#myModal9"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
											</li>
										</ul>
									</div>
								</div>
								<h5><a href ="'.base_url().'events/viewEventDetail/'.$value->event_id.'">'.$value->event_title.'</a></h5> 
								<div class="simpleCart_shelfItem">
									<p><span>$'.$value->event_base_price.'</span> <i class="item_price">$'.$value->event_base_price.'</i></p>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart" />
										<input type="hidden" name="add" value="1" /> 
										<input type="hidden" name="w3ls_item" value="Smart Phone" /> 
										<input type="hidden" name="amount" value="'.$value->event_base_price.'"/>   
										<button type="submit" class="w3ls-cart">Add to cart</button>
									</form>
								</div> 
								<div class="mobiles_grid_pos">
									<h6>New</h6>
								</div>
							</div>
						</div>
						';
						}
						
						$html .= '<input type ="hidden" id ="hiddenCategory" value ="'.$cat_id.'"><div class="clearfix"> </div>
					</div>';
					echo $html;
		}

    




  public function viewEventDetail()
  {

  	$event_id = $this->uri->segment(3);
  	$this->data['event_detail'] = $this->events_model->getEventsDetail($event_id);
  	$this->data['eventImgs'] = $this->events_model->getEventsImgs($event_id);
  	$this->data['eventAttributes'] = $this->events_model->getEventattributes($event_id);
  	$this->data['specifications'] = $this->events_model->getEventSpecifications($event_id);  
  	$this->show_view_front('front/single_event',$this->data);
  }


}

/* End of file */
?>