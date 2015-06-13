<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \traits\TrainingsControllerTrait;

class Trainings extends User_Controller {
	use TrainingsControllerTrait;

	protected $use_slug = true;
	protected $resource_model = 'Training';

	public function __construct()
	{
		parent::__construct();
		$this->before_filter[] = array(
        	'action' => '_articles',
        	'only' => array('index', 'show')
        );
        $this->before_filter[] = array(
        	'action' => '_resource',
        	'only' => array('apply','list_of_attendances', 'confirm')
        );
        $this->before_filter[] = array(
        	'action' => '_build_trainers_select',
        	'only' => array('edit','update','create_new','create')
        );
        $this->before_filter[] = array(
        	'action' => '_valid_training_to_apply',
        	'only' => array('apply')
        );
        $this->before_filter[] = array(
        	'action' => '_valid_training_confirmation',
        	'only' => array('confirm')
        );
	}

	public function index()
	{
		$trainings = Training::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render(), 'options' => $this->options ));
	}

	public function apply($id)
	{
		if ($this->resource->apply($this->current_user))
		{
			$this->session->set_flashdata('notice', 'You are has been registered to '.$this->resource->title.'.');
			redirect($this->folder.'trainings/show/'.$this->identifier());
		}
		$this->session->set_flashdata('error', $this->errors['apply']);
		$this->load->section('content', $this->folder.'trainings/show'.$this->identifier(), array('training' => $this->resource));
	}

	public function confirm($id)
	{
		if ($this->resource->confirm($this->current_user))
		{
			$this->session->set_flashdata('notice', 'You have confirmed to attend on '.$this->resource->title.'. You will be remembered via SMS. Thank you.');
			redirect($this->folder.'trainings/show/'.$this->identifier());
		}
		$this->session->set_flashdata('error', $this->errors['confirm']);
		$this->load->section('content', $this->folder.'trainings/show'.$this->identifier(), array('training' => $this->resource));
	}

	protected function _valid_training_to_apply()
	{
		if (!$this->resource->applyable($this->current_user))
		{
			show_404();
		}
	}

	protected function _valid_training_confirmation()
	{
		if (!$this->resource->confirmable($this->current_user) || !$this->current_user->applied_to($this->resource))
		{
			show_404();
		}
	}

	protected function _articles()
	{
		$this->options['articles']['recents'] = Article::recents()->take(7)->get();
		$this->options['articles']['popular'] = Article::populars()->take(7)->get()->toArray();
	}
}

