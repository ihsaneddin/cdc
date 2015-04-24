<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends Command
{
	protected $user;
	protected $group = array();

	public function index()
	{
		try{
			$this->groups();
			$this->admin();
		}catch(Exception $e){
			echo 'error happen';
		}
	}

	protected function admin()
	{
		if (User::all()->count() == 0)
		{
			$sentry = Sentry::createSentry();
			$this->user = $sentry->register(array('username' => 'admin', 'email' => 'admin@mail.com', 'password' => 'password', 'activated' => 1));
			if (array_key_exists('admin', $this->group)) $this->user->addGroup($this->group['admin']);
		}
	}
	protected function groups()
	{
		if (Group::all()->count() == 0)
		{
			$sentry = Sentry::createSentry();
			$this->group['admin'] = $sentry->createGroup(array(
				'name' => 'admin',
				'permissions' => array(
					'superuser' => 1
					)
				)
			);
			$this->group['trainer'] = $sentry->createGroup(array(
				'name' => 'trainer'
				)
			);
			$this->group['student'] = $sentry->createGroup(array(
				'name' => 'student'
				)
			);

		}
	}
	protected function faculties()
	{

	}

	protected function majors()
	{

	}
}