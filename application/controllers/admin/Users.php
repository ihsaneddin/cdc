<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function index()
	{
		$users = User::paginate(1)->toArray();
		$this->load->section('content', 'admin/users/index', array('users' => $users));
	}

	public function show($id)
	{

	}

	public function create_new()
	{

	}

	public function create()
	{

	}

	public function edit($id)
	{

	}
	public function update($id)
	{

	}
}

