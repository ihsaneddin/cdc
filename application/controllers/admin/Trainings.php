<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Connection;
use \traits\TrainingsControllerTrait;

class Trainings extends Admin_Controller {

	use TrainingsControllerTrait;

	protected $rules = 'training';
	protected $list_of_attendances = array();
	protected $resource_model = 'Training' ;

	public function __construct()
	{
		parent::__construct();
        $this->before_filter[] = array(
        	'action' => '_resource',
        	'only' => array('list_of_attendances')
        );
        $this->before_filter[] = array(
        	'action' => '_build_trainers_select',
        	'only' => array('edit','update','create_new','create')
        );
	}
}

