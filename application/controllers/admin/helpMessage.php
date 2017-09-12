<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HelpMessage extends MY_Controller 

{

	function __construct()

	{

		parent::__construct();

		$this->load->model('admin/helpmessage_model');

	}



 protected $validation_rules = array

        (

        'helpPageUpdate' => array(

        	array(

                'field' => 'help_page_description',

                'label' => 'help Description',

                'rules' => 'trim|required'

            )

         )     

   );



	public function index()

	{

		if($this->checkViewPermission())
		{
			$this->data['help_msg_result'] = $this->helpmessage_model->getAllhelpMessageData();	
			$this->show_view_admin('admin/helpMessage', $this->data);
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}
   }

  public function delete_message()
  {
		if($this->checkDeletePermission())
		{
			$msg_id = $this->uri->segment(4);
			$this->helpmessage_model->delete_message($msg_id);
				$msg = 'Message remove successfully...!';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/helpMessage');		

		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');

		}		

	}

	

}



?>