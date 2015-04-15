<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Base extends Eloquent implements SluggableInterface{
	use NestedAttributesTrait, SluggableTrait;

	protected $upload_path = array();
 	protected $acceptNestedAttributes = array();
 	protected $expected_files = array();
 	protected $upload_config = array();
 	protected $rules = array();
 	protected $slugabble = array();

	public function __sleep()
	{
		return array('connection');
	}
	public static function boot()
	{
	     parent::boot();
	     self::updating(function($model){
	         $expected_files = $model->expected_files;
	         if (!empty($expected_files))
	         {
	         	foreach ($expected_files as $field => $required) {
	         		$original = $model->getOriginal();
	         		if ($model->$field != $original[$field])
	         		{
	         			$file_path = $model->upload_path[$field].$original[$field];
	         			$model->delete_file($file_path);
	         		}
	         	}
	         }
	         return true;
	     });
	}
}