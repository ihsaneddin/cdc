<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Photo extends Base{

 	public $table = "photos";
 	protected $fillable = array('file_name');
 	protected $expected_files = array('file_name' => 'required');
 	protected $upload_path = ['file_name' => "./public/assets/upload/photos/"];

 	public function __construct($attributes = array())
 	{
 		parent::__construct($attributes);
 		$this->upload_config = array(
 				'file_name' => array(
 					'upload_path' => $this->upload_path['file_name'],
					'allowed_types' => 'jpg|png|jpeg',
					'max_size' => 1024*2,
					'encrypt_name' => true
 					)
				);
 	}

 	public function imageable()
    {
        return $this->morphTo();
    }

}