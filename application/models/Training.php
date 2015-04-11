<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Training extends Base{

 	public $table = "trainings";
 	protected $upload_path = ['banner' => './public/assets/upload/trainings_banners/'];

 	protected $fillable = array('title', 'banner', 'description', 'start_date', 'end_date');
 	protected $acceptNestedAttributes = array('training_materials' => ['file_name']);
 	protected $expected_files = array('banner' => 'required');
 	protected $upload_config = array();

    protected $sluggable = array();

 	protected $rules = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required|min_length[3]|is_unique[trainings.title]'
					),
				array(
					'field' => 'end_date',
					'label' => 'End date',
					'rules' => 'required|date_greater_than[start_date]'
					),
				array(
					'field' => 'start_date',
					'label' => 'Start date',
					'rules' => 'required')
				);

 	public function __construct(array $attributes = array())
 	{
 		$this->upload_config = array(
 				'banner' => array(
 					'upload_path' => $this->upload_path['banner'],
					'allowed_types' => 'jpg|png|jpeg',
					'max_size' => 1024*2,
					'encrypt_name' => true
 					)
				);
 		$this->sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'method' => function ($string, $separator) {
        				return strtolower(preg_replace('/[^a-z]+/i', $separator, $string));
    				}
    	);
 		parent::__construct($attributes);
 	}
 	public function training_materials()
 	{
 		return $this->hasMany('TrainingMaterial');
 	}
}