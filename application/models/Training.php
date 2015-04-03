<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Training extends Eloquent{

 	public $table = "trainings";

 	public function training_materials()
 	{
 		return $this->hasMany('TrainingMaterial');
 	}


}