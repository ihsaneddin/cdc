<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

class Comment extends Base{

 	public $table = "comments";
 	protected $fillable = array('title', 'content');
 	protected $rules = array(
				array(
					'field' => 'content',
					'label' => 'Content',
					'rules' => 'required'
					),
				array(
					'field' => 'user_id',
					'label' => 'User Id',
					'rules' => 'required'
					),
				array(
					'field' => 'training_id',
					'label' => 'Training Id',
					'rules' => 'required')
				);

 	public function training()
    {
        return $this->belongsTo('Training');
    }

    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function root()
    {
    	return $this->belongsTo('Comment', 'parent_id');
    }

    public function branchs()
    {
    	return $this->hasMany('Comment', 'parent_id');
    }

}