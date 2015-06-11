<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
use traits\NestedAttributesTrait;

class Base extends Eloquent{
	use NestedAttributesTrait;

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

	     self::creating(function($model){
	         $expected_files = $model->expected_files;
	         if (!empty($expected_files))
	         {
	         	foreach ($expected_files as $field => $required) {
	         		$original = $model->getOriginal();
	         		if ( $required == 'required' && $model->$field == '')
	         		{
						return false;
	         		}
	         	}
	         }
	         return true;
	     });

	     self::deleting(function($model){
	     	$expected_files = $model->expected_files;
	         if (!empty($expected_files))
	         {
	         	foreach ($expected_files as $field => $required) {
         			$file_path = $model->upload_path[$field].$model->$field;
         			$model->delete_file($file_path);
	         	}
	         }
	         return true;
	     });
	}

	public function persisted()
	{
		return is_null( call_user_func_array(array(get_class($this), 'find'), array($this->id)) ) ? false : true ;

	}

	public static function find_by_slug($slug)
	{
		return self::where('slug', '=', $slug)->firstOrFail();
	}

}