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

	public function __sleep()
	{
		return array('connection');
	}
}