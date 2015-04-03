<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class TrainingMaterial extends Eloquent{

 	public $table = "training_materials";

 	public function training()
 	{
 		return $this->belongsTo('Training');
 	}

}