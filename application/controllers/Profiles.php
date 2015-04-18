<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends Base_Controller {

	protected $allowed_attributes = array('username', 'password', 'password_confirmation', 'first_name', 'last_name', 'avatar', 'phone_number','description');
	protected $rules = 'profile';
	protected $after_update_url = 'profiles/show';
	private $upload_folder = './public/assets/upload/avatars/';

	public function __construct()
	{
		parent::__construct();
		$this->resource = $this->current_user;
		$this->_set_template();
		$this->before_filter[] = array(
        	'action' => '_set_resource_attributes',
        	'only' => array('update')
        );
        $this->before_filter[] = array(
        	'action' => '_restrict_file_input',
        	'only' => array('update')
        );
	}

	public function show()
	{
		$this->load->section('content', 'profiles/show', array('current_user' => $this->resource));
	}

	public function edit()
	{
		$this->load->section('content', 'profiles/edit', array('current_user' => $this->resource));
	}

	public function edit_password()
	{
		$this->load->section('content', 'profiles/edit_password', array('current_user' => $this->resource));
	}

	public function update()
	{
		$this->_update_profile();
	}

	public function update_password()
	{
		$this->_update_profile('profiles/edit_password');
	}

	protected function _authenticate()
	{
		if (!$this->sentry->check()) show_404();
	}

	protected function _set_template()
	{
		try{
			$admin = $this->sentry->findGroupByName('admin');
			if ($this->current_user->inGroup($admin)){
				$this->layout = 'admin';
				$this->_set_admin_template();
				$this->after_update_url = 'admin/profile';
			}
		}catch(Exception $e){
			$this->_set_user_template();
		}
	}

	protected function _update_profile($template = 'profiles/edit')
	{
		if ($this->_update())
		{
			redirect($this->after_update_url);
		}
		$this->load->section('content', $template, array('current_user' => $this->resource));
	}

	protected function _update()
	{
		$this->form_validation->set_rules($this->_update_rules($this->_profile_rules()));
		if ($this->form_validation->run())
		{
			if ( !$this->_delete_avatar() && $this->_avatar_present())
			{
				if (!$this->upload->do_upload('avatar'))
				{
					$this->form_validation->set_message('avatar', $this->upload->display_errors());
					return false;
				}
				$this->resource->avatar= $this->upload->data('file_name');
			}
			try{
				$this->resource->save();
				$this->session->set_flashdata('notice', 'Profile updated');
				return true;
			}catch(Exception $e){
				$this->session->set_flashdata('error', $e->getMessage());
				return false;
			}
		}
		return false;

	}

	protected function _upload_config()
	{
		return array(
				'upload_path' => $this->upload_folder,
				'allowed_types' => 'jpeg|png|jpg',
				'max_size' => 1024 * 2,
        		'encrypt_name' => TRUE
				);
	}

	protected function _profile_rules()
	{
		$this->config->load("form_validation");
		$rules = $this->config->item($this->rules);
		$index = 0;
		foreach ($rules as $rule) {
			if ( is_null($this->input->post($rule['field']) ))
			unset($rules[$index]);
			$index++;
		}
		return $rules;

	}

	protected function _avatar_present()
	{
		if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] != 4 )
		{
			$this->load->library('upload', $this->_upload_config());
			return true;
		}
		return false;
	}

	protected function _delete_avatar()
	{
		$delete = $this->input->post('_delete_avatar');
		if (!empty($delete))
		{
			$this->resource->avatar = null;
			return true;
		}
		return false;
	}

	protected function _restrict_file_input()
	{
		foreach($_FILES as $key => $value){
			if (! in_array($key, $this->allowed_attributes)) unset($_FILES[$key]);
		}
	}
}

