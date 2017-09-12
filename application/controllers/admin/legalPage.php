<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LegalPage extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/legalpage_model');
	}

 protected $validation_rules = array
        (
        'legalPageUpdate' => array(
        	array(
                'field' => 'legal_page_description',
                'label' => 'legal Description',
                'rules' => 'trim|required'
            )
         )     
   );

	public function index()
	{
		if($this->checkViewPermission())		{			
			$this->data['legal_page_result'] = $this->legalpage_model->getAllLegalPageData();		
			$this->show_view_admin('admin/legalPage', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addLegalPage()
	{
		$legal_page_id = $this->uri->segment(4);
		if($legal_page_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['legalPageUpdate']);
					if($this->form_validation->run())
					{
						$post['legal_page_id'] = $legal_page_id;						
						$post['legal_page_description'] = $this->input->post('legal_page_description');												
						$post['legal_page_updated_date'] = date('Y-m-d');
						$this->legalpage_model->updatelegalPage($post);

						$msg = 'legal_page update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/legalPage');
					}
					else
					{
						$this->data['legal_page_edit'] = $this->legalpage_model->editlegalPage($legal_page_id);
						$this->show_view_admin('admin/legalPageUpdate', $this->data);
					}
				}
				else
				{
					$this->data['legal_page_edit'] = $this->legalpage_model->editlegalPage($legal_page_id);
						$this->show_view_admin('admin/legalPageUpdate', $this->data);
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