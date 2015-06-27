<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Base{

 	public $table = "users";
 	protected $appends = ['full_name', 'avatar_url', 'is_student', 'major', 'faculty'];

 	public function major()
 	{
 		return $this->belongsTo('Major');
 	}

 	public function groups()
	{
		return $this->belongsToMany('Group', 'users_groups');
	}

	public function trainings()
 	{
 		return $this->belongsToMany('Training', 'users_trainings')->withPivot('id','state', 'participate');
 	}

 	public function hasGroup($name)
	{
		$group = $this->groups()->where('name', $name)->first();
		if (!is_null($group))
		{
			return true;
		}
	}

 	public function scopeFilter($res, $search)
	{
		if (!empty($search))
		{
			$query = array();
			array_push($query, 'Lower(username) like "%'.$search.'%"');
			array_push($query, 'Lower(email) like "%'.$search.'%"');
			array_push($query, 'Lower(first_name) like "%'.$search.'%"');
			array_push($query, 'Lower(last_name) like "%'.$search.'%"');
			$res = $res->whereRaw(implode(' OR ', $query));
		}
		return $res;
	}

	public function getIsStudentAttribute($value)
	{
		foreach ($this->groups()->get()->lists('name', 'id') as $student) {
			return $student == 'student' ? true : false;
		}
	}

	public function getFullNameAttribute($value)
	{
		return $this->first_name.' '.$this->last_name;
	}

	public function getAvatarUrlAttribute($value)
	{
		return empty($this->avatar) ? base_url('public/assets/img/avatar-default.png') : soft_image_url($this->avatar);
	}

	public function scopeBuild_trainers_select($res)
	{
		return $res->leftJoin('users_groups', 'users.id', '=', 'users_groups.user_id')->leftJoin('groups', 'groups.id', '=', 'users_groups.group_id')
					->select('users.id', 'users.username','first_name', 'last_name', 'groups.name')->where('groups.name', '=', 'trainer');
	}

	public function user_trainings($trainings= array())
	{
		foreach ($this->trainings()->get() as $training) {
			if ($training->pivot->participate != 0)
			{
				array_push($trainings, $training);
			}
		}
		return $trainings;
	}

	public function getMajorAttribute($value)
	{
		if (!$this->major()->get()->isEmpty())
		{
			return $this->major()->get()->first()->name;
		}
	}

	public function getFacultyAttribute($value)
	{
		if (!$this->major()->get()->isEmpty())
		{
			return $this->major()->get()->first()->faculty()->get()->first()->name;
		}
	}

	public function register($sentry, $register_attributes)
	{
		try{
			$registrant = $sentry->createUser($this->register_attributes($register_attributes));
			$student_group = $sentry->findGroupByName('student');
			$registrant->addGroup($student_group);
			$sentry->login($registrant,false);
		}catch(Exception $e){
			return false;
		}
		return true;

	}

	protected function register_attributes($registrant_attr = array())
	{
		$allowed_attr = array('email', 'username', 'password', 'student_id', 'address', 'first_name', 'last_name', 'date_of_birth', 'major_id', 'phone_number');
		$valid_attr = array();
		foreach ($allowed_attr as $allowed) {
			if (array_key_exists($allowed, $registrant_attr))
			$valid_attr[$allowed] = $registrant_attr[$allowed];
		}
		$valid_attr['activated'] = 1;
		return $valid_attr;
	}

	public function trainings_to_confirm()
	{
		if ($this->hasGroup('student')){return $this->trainings()->wherePivot('participate', NULL)->get();}
		return $this->trainings()->wherePivot('id', NULL)->get();
	}

	public function valid_trainings()
	{
		return $this->trainings()->wherePivot('participate', NULL)->orWherePivot('participate', true)->get();
	}

	public function applied_to($training)
	{
		if (!is_null($this->trainings()->wherePivot('participate', NULL)->first())){return true;}
	}

}