<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	protected $allowed_attributes = array('username', 'email', 'password', 'first_name', 'last_name', 'student_id', 'date_of_birth', 'phone_number', 'description','address', 'major_id');
	protected $resource;

	public function __construct()
	{
		parent::__construct();
		$this->resource_model = 'User' ;
		$this->before_filter[] = array(
            'action' => '_rules',
            'only' => array('create', 'update')
        );
        $this->before_filter[] = array(
        	'action' => '_find_resource',
        	'only' => array('edit','update','show','delete')
        );

        $this->before_filter[] = array(
        	'action' => '_build_majors_select',
        	'only' => array('create_new', 'create', 'edit', 'update')
        );
	}

	public function index()
	{
		$users = User::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'admin/users/index', array('users' => $users->toArray(), 'pagination' => $users->links()->render() ));
	}

	public function show($id)
	{
		$this->load->section('content', 'admin/users/show', array('user' => $this->resource));
	}

	public function create_new()
	{
		$this->resource = new User;
		$this->load->section('content', 'admin/users/create_new', array('user' => $this->resource, 'options' => $this->options));
	}

	public function create()
	{
		if ($this->form_validation->run($this->rules))
		{
			if ($this->_register()) redirect('admin/users');
		}
		$this->load->section('content', 'admin/users/create_new', array('user' => new User, 'options' => $this->options));
	}

	public function edit($id)
	{
		$this->load->section('content', 'admin/users/edit', array('user' => $this->resource, 'options' => $this->options));
	}
	public function update($id)
	{
		$this->form_validation->set_rules($this->_update_rules());
		if ($this->form_validation->run()){
			$this->_set_resource_attributes();
			if ($this->resource->save()){
				$this->session->set_flashdata('success', 'User updated.');
				redirect('admin/users');
			}
		}
		$this->load->section('content', 'admin/users/edit', array('user' => $this->resource, 'options' => $this->options));
	}

	public function delete($id)
	{
		$this->resource->delete();
		$this->session->set_flashdata('User deleted.');
		redirect('admin/users');
	}

	private function _register()
	{
		try
		{
		    $user = $this->sentry->register($this->resource_attributes(),true);
		    if ($user)
		    {
		    	try{
		    		$group = $this->sentry->findGroupByName(is_null($this->input->post('group')) ? 'student' : $this->input->post('group'));
		    		$user->addGroup($group);
		    	}
		    	catch(Cartalyst\Sentry\Groups\GroupNotFoundException $e){
		    		show_403();
		    	}

		    }
		 	$this->session->set_flashdata('success', 'User created.');
		}
		catch (Exception $e)
		{
			$this->session->set_flashdata('error', $e->getMessage());
			return false;
		}
		return true;
	}

	protected function _rules()
	{
		$this->rules = is_null($this->input->post('group')) ? 'user-student' : 'user-trainer';
	}

	protected function _build_majors_select()
	{
		$majors_select = function(){
			$select = array();
			$select[0] = '';
			foreach (Major::build_select_majors()->get() as $major) {
				$select[$major->id] = $major->name;
			}
			return $select;
		};
		$this->options['majors_select_options'] = $majors_select();
		$this->options['current_major_options'] = array_key_exists('major_id', $this->input->post()) ? $this->input->post('major_id') : [] ;
		if ( empty($this->options['current_major_options']) )
		{
			$this->options['current_major_options'] = $this->resource->major_id;
		}
	}

}

