<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends Command
{
	protected $user;
	protected $group = array();

	public function index()
	{
		try{
			$this->run(array('groups', 'admin', 'faculties','majors'));
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	protected function run($methods=array())
	{
		foreach ($methods as $method) {
			$this->$method();
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
		$faculties = array(
			array( 'name' => 'Economic and Business' ),
			array( 'name' => 'Applied Science' ),
			array( 'name' => 'Creative Industries' ),
			array( 'name' => 'Informatics Engineering'),
			array( 'name' => 'Communication and Business' ),
			array( 'name' => 'Industrial Engineering'),
			array( 'name' => 'Electric Engineering')
		);

		foreach ($faculties as $faculty_arr) {
			Faculty::firstOrCreate($faculty_arr);
		}


	}

	protected function majors()
	{
		$majors = array(
			'Economic and Business' => array(
											array('name' => 'S1 Accounting'),
											array('name' => 'S1 International ICT Business'),
											array('name' => 'S1 Telecommunication Business Management')
											),
			'Applied Science' => array(
										array('name' => 'D3 Computerized Accounting'),
										array('name' => 'D3 Informatics Management'),
										array('name' => 'D3 Marketing Management'),
										array('name' => 'D3 Informatics Engineering'),
										array('name' => 'D3 Computer Engineering'),
										array('name' => 'D3 Telecommunication Engineering')
									  ),
			'Creative Industries' => array(
											array('name' => 'S1 Interior Design'),
											array('name' => 'S1 Visual Communication Design'),
											array('name' => 'S1 Design Product'),
											array('name' => 'S1 Craft Textil and Fashion'),
											array('name' => 'S1 Fine Arts')
										  ),
			'Informatics Engineering' => array(
												array('name' => 'S1 Informatics Engineering'),
												array('name' => 'S1 Computing Engineering')
												),
			'Communication and Business' => array(
												array('name' => 'S1 Business Administration'),
												array('name' => 'S1 Communication Science')
												),
			'Industrial Engineering' => array(
											array('name' => 'S1 Information System'),
											array('name' => 'S1 Industrial Engineering')
											),
			'Electric Engineering' => array(
											array('name' => 'Electric Engineering'),
											array('name' => 'Physic Engineering'),
											array('name' => 'Telecommunication Engineering'),
											array('name' => 'Computer System')
											)
			);

		foreach ($majors as $faculty => $majors_arr) {
			$faculty = Faculty::where('name', '=', $faculty)->first();
			if ($faculty instanceOf Illuminate\Database\Eloquent\Model )
			{
				foreach ($majors_arr as $major) {
					$major = Major::firstOrNew($major);
					if (!$major->persisted())
					{
						$faculty->majors()->save($major);
					}
				}
			}
		}

	}
}