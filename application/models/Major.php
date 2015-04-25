<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Major extends Base{

 	public $table = "majors";
 	protected $fillable = ['name'];

	public function faculty()
	{
		return $this->belongsTo('Faculty');
	}

	public function scopeBuild_select_majors($res)
	{
		return $res->select('id','name');
	}

}