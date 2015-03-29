<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{

 	public $table = "users";
 	protected $appends = ['full_name', 'avatar_url'];

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
		return empty($this->avatar) ? base_url('public/assets/img/avatar-default.png') : image_url($this->avatar);
	}

}