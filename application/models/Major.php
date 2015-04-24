<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Major extends Base{

 	public $table = "majors";

	public function faculty()
	{
		return $this->belongsTo('Faculty');
	}

}