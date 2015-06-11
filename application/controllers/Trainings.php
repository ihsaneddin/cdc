<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainings extends User_Controller {

	protected $use_slug = true;
	protected $resource_model = 'Training';

	public function __construct()
	{
		parent::__construct();
		$this->before_filter[] = array(
        	'action' => '_articles',
        	'only' => array('index', 'show')
        );
	}

	public function index()
	{
		$trainings = Training::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render(), 'options' => $this->options ));
	}

	public function show($slug)
	{
		$this->load->section('content', 'trainings/show', array('training' => $this->resource, 'options' => $this->options));
	}

	protected function _articles()
	{
		$this->options['articles']['recents'] = Article::recents()->take(7)->get();
		$this->options['articles']['popular'] = Article::populars()->take(7)->get()->toArray();
	}
}

