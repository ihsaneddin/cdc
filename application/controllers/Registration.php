<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends User_Controller {

	protected $skip_authentication = true;
	protected $resource_model = 'User';
	protected $layout = 'user_login';
	protected $boot_layout = false;

	public function __construct()
	{
		parent::__construct();
		$this->output->set_template($this->layout);
		$this->before_filter[] = array(
        	'action' => '_set_form_validation_data',
        	'only' => array('create')
        );

	}
	public function create()
	{
		$this->_register();
	}

	protected function _register()
	{
		if ($this->form_validation->run('student-registration'))
		{
			if ($this->resource->register($this->sentry, $this->resource_data())){
				$this->session->set_flashdata('notice', 'Welcome');
				redirect('home');
			}
		}
		$this->resource->set_error_validation($this->form_validation->error_array());
		$this->load->section('content', 'sessions/create_new', array('registrant' => $this->resource));
	}

	protected function _set_form_validation_data()
	{
		$this->form_validation->set_data($this->resource_data());
	}

}

