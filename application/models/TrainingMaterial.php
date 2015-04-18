<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class TrainingMaterial extends Base{

 	public $table = "training_materials";
 	protected $fillable = array('file_name');
 	protected $acceptNestedAttributes = array('training_materials' => ['file_name']);
 	protected $expected_files = array('file_name' => 'required');
 	protected $upload_path = [ 'file_name' => "./public/assets/upload/trainings_materials/"];


 	public function __construct(array $attributes = array())
 	{
 		$this->upload_config = array(
 				'file_name' => array(
						'upload_path' => $this->upload_path['file_name'],
						'allowed_types' => 'doc|docx|xls|xlsx|ppt|pptx|pdf|zip|rar',
						'max_size' => 1024*10,
						'encrypt_name' => false
					)
				);
 		parent::__construct($attributes);
 	}

 	public function training()
 	{
 		return $this->belongsTo('Training');
 	}
 	public function file_path($field)
 	{
 		return $this->upload_path[$field].$this->$field;
 	}

}