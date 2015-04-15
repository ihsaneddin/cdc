<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{

 	public $table = "users";
 	protected $appends = ['full_name', 'avatar_url'];

 	public function groups()
	{
		return $this->belongsToMany('Group', 'users_groups');
	}

	public function trainings()
 	{
 		return $this->belongsToMany('Training', 'users_trainings')->withPivot('state', 'participate');
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

}