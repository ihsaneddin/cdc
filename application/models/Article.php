<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Article extends Base{

 	public $table = "articles";
 	protected $upload_path = ['image' => './public/assets/upload/articles_images/'];
 	protected $fillable = array('title', 'image', 'content', 'user_id');
 	protected $expected_files = array('image' => 'not at all');
    protected $sluggable = array('from' => 'title', 'to' => 'slug');
    protected $appends = ['author', 'image_url'];

 	protected $rules = array(
				array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'required|min_length[3]|is_unique[articles.title]'
					),
				array(
					'field' => 'content',
					'label' => 'Content',
					'rules' => 'required'
					)
				);


 	public function __construct(array $attributes = array())
 	{
 		parent::__construct($attributes);
 		$this->upload_config = array(
 				'image' => array(
 					'upload_path' => $this->upload_path['image'],
					'allowed_types' => 'jpg|png|jpeg',
					'max_size' => 1024,
					'encrypt_name' => true
 					)
				);
 	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function scopeFilter($res, $search)
	{
		if (!empty($search))
		{
			$query = array();
			array_push($query, 'Lower(title) like "%'.strtolower($search).'%"');
			$res = $res->whereRaw(implode(' OR ', $query));
		}
		return $res;
	}

	public function getAuthorAttribute($value)
 	{
 		return $this->user()->get()->isEmpty() ? null : $this->user;

 	}

 	public function getImageUrlAttribute($value)
 	{
 		return soft_uploaded_file_url('articles_images/'.$this->image);
 	}

}