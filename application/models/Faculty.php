<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Faculty extends Base{

 	public $table = "faculties";

	public function majors()
	{
		return $this->hasMany('Major');
	}

}