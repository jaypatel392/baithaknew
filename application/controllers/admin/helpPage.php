<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class HelpPage extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/helppage_model');
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
			$this->data['help_page_result'] = $this->helppage_model->getAllhelpPageData();			
			$this->show_view_admin('admin/helpPage', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addHelpPage()
	{
		$help_page_id = $this->uri->segment(4);
		if($help_page_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['helpPageUpdate']);
					if($this->form_validation->run())
					{
						$post['help_page_id'] = $help_page_id;						
						$post['help_page_description'] = $this->input->post('help_page_description');												
						$post['help_page_updated_date'] = date('Y-m-d');
						$this->helppage_model->updateHelpPage($post);

						$msg = 'help_page update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/helpPage');
					}
					else
					{
						$this->data['help_page_edit'] = $this->helppage_model->edithelpPage($help_page_id);
						$this->show_view_admin('admin/helpPageUpdate', $this->data);
					}
				}
				else
				{
					$this->data['help_page_edit'] = $this->helppage_model->edithelpPage($help_page_id);
						$this->show_view_admin('admin/helpPageUpdate', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
}

?>