<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/role_model');
	}
	
	/*	Validation Rules */
	 protected $validation_rules = array
        (
        'roleAdd' => array(
            array(
                'field' => 'role_name',
                'label' => 'Role name',
                'rules' => 'trim|required|is_unique[tbl_role.role_name]'
            ),
			array(
                'field' => 'role_status',
                'label' => 'Role status',
                'rules' => 'trim|required'
            )
        ),
		'roleUpdate' => array(
            array(
                'field' => 'role_name',
                'label' => 'Role name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'role_status',
                'label' => 'Role status',
                'rules' => 'trim|required'
            )
        )
    );
	
	
	/* Details */
	public function index()
	{
		if($this->checkViewPermission())
		{			
			$this->data['role_result'] = $this->role_model->getAllRole();
			$this->show_view_admin('admin/role', $this->data);
		}
		else
		{	
			redirect( base_url().'admin/dashboard/error/1');
		}
    }


    /* Add and Update */
	public function addRole()
	{
		$role_id = $this->uri->segment(4);
		if($role_id)
		{
			if($this->checkEditPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Edit") 
				{
					$this->form_validation->set_rules($this->validation_rules['roleUpdate']);
					if($this->form_validation->run())
					{
						$post['role_id'] = $role_id;
						$post['role_name'] = $this->input->post('role_name');
						$post['role_status'] = $this->input->post('role_status');
						$post['role_updated_date'] = date('Y-m-d');
						$this->role_model->updateRole($post);


						$tab_list = $this->role_model->getAllTabs();
						foreach ($tab_list as $res)
						{
							$post_permission['role_id'] = $role_id;
							$post_permission['tab_id'] = $res->tab_id;
							$post_permission['user_permission_id'] = $this->input->post('user_permission_id_'.$res->tab_id);
							$post_permission['userView'] = $this->input->post('view_'.$res->tab_id);
							$post_permission['userAdd'] = $this->input->post('add_'.$res->tab_id);
							$post_permission['userEdit'] = $this->input->post('edit_'.$res->tab_id);
							$post_permission['userDelete'] = $this->input->post('delete_'.$res->tab_id);
							$this->role_model->updateRolePermission($post_permission);
						}
						$msg = 'Role update successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/role');
					}
					else
					{
						$this->data['role_edit'] = $this->role_model->editRole($role_id);
						$this->data['role_permissions'] = $this->role_model->getRolePermissionByRoleID($role_id);
						$this->show_view_admin('admin/role_update', $this->data);
					}
				}
				else
				{
					$this->data['role_edit'] = $this->role_model->editRole($role_id);
					$this->data['role_permissions'] = $this->role_model->getRolePermissionByRoleID($role_id);
					$this->show_view_admin('admin/role_update', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
		else
		{
			if($this->checkAddPermission())
			{
				if (isset($_POST['Submit']) && $_POST['Submit'] == "Add") 
				{
					$this->form_validation->set_rules($this->validation_rules['roleAdd']);
					if($this->form_validation->run())
					{
						$post['role_name'] = $this->input->post('role_name');
						$post['role_status'] = $this->input->post('role_status');
						$post['role_created_date'] = date('Y-m-d');
						$post['role_updated_date'] = date('Y-m-d');
						$role_id =  $this->role_model->addRole($post);


						$tab_list = $this->role_model->getAllTabs();
						foreach ($tab_list as $res)
						{
							$post_permission['role_id'] = $role_id;
							$post_permission['tab_id'] = $res->tab_id;
							$post_permission['userView'] = $this->input->post('view_'.$res->tab_id);
							$post_permission['userAdd'] = $this->input->post('add_'.$res->tab_id);
							$post_permission['userEdit'] = $this->input->post('edit_'.$res->tab_id);
							$post_permission['userDelete'] = $this->input->post('delete_'.$res->tab_id);
							$this->role_model->addRolePermission($post_permission);
						}
						$msg = 'Role added successfully!!';					
						$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
						redirect(base_url().'admin/role');
					}
					else
					{
						$this->data['tab_list'] = $this->role_model->getAllTabs();
						$this->show_view_admin('admin/role_add', $this->data);
					}		
				}
				else
				{
					$this->data['tab_list'] = $this->role_model->getAllTabs();
					$this->show_view_admin('admin/role_add', $this->data);
				}
			}
			else
			{
				redirect( base_url().'admin/dashboard/error/1');
			}
		}
	}
	
	/* Delete */
	public function delete_role()
	{
		if($this->checkDeletePermission())
		{
			$role_id = $this->uri->segment(4);
			
			$this->role_model->delete_rolePermissions($role_id);
			$this->role_model->delete_role($role_id);
			if ($this->db->_error_number() == 1451)
			{		
				$msg = 'You need to delete child category first';
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/role'); 
			}
			else
			{
				$msg = 'Role remove successfully...!';					
				$this->session->set_flashdata('message', '<section class="content"><div class="col-xs-12"><div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$msg.'</div></div></section>');
				redirect(base_url().'admin/role');
			}
		}
		else
		{
			redirect( base_url().'admin/dashboard/error/1');
		}		
	}

}

/* End of file */?>