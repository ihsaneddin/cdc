<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seed extends Command
{
	protected $user;
	protected $group = array();
	protected $sentry;

	public function __construct()
	{
		parent::__construct();
		$this->sentry = Sentry::createSentry();
	}

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
			
			$this->user = $this->sentry->register(array('username' => 'admin', 'email' => 'admin@mail.com', 'password' => 'password', 'activated' => 1));
			if (array_key_exists('admin', $this->group)) $this->user->addGroup($this->group['admin']);
		}
	}
	protected function groups()
	{
		try{
			$this->group['admin'] = $this->sentry->findGroupByName('admin');
		}		
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			$this->group['admin'] = $this->sentry->createGroup(array(
				'name' => 'admin',
				'permissions' => array(
					'superuser' => 1
					)
				)
			);
		}

		try{
			$this->group['trainer'] = $this->sentry->findGroupByName('trainer');
			$this->group['trainer']->permissions = $this->trainer_permissions();
			$this->group['trainer']->save();
		}catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			$this->group['trainer'] = $this->sentry->createGroup(array(
				'name' => 'trainer',
				'permissions' => $this->trainer_permissions() 
				)
			);	
		}

		try{
			$this->group['student'] = $this->sentry->findGroupByName('student');
			$this->group['student']->permissions = $this->student_permissions();
			$this->group['student']->save();	
		}catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			$this->group['student'] = $sentry->createGroup(array(
				'name' => 'student',
				'permissions' => $this->student_permissions()
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

	private function trainer_permissions(){
		return array(
					'home.index' => 1,
					'trainings.index' => 1,
					'trainings.show' => 1,
					'trainings.create_new' => 1,
					'trainings.create' => 1,
					'trainings.edit' => 1,
					'trainings.update' => 1,
					'profiles.show' => 1,
					'profiles.edit' => 1,
					'profiles.edit_password' => 1,
					'profiles.update_password' => 1
				);
	}

	private function student_permissions(){
		return array(
					'home.index' => 1,
					'trainings.index' => 1,
					'trainings.show' => 1,
					'profiles.show' => 1,
					'profiles.edit' => 1,
					'profiles.edit_password' => 1,
					'profiles.update_password' => 1
				);
	}
}