<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Connection;

class Trainings extends Admin_Controller {

	protected $allowed_attributes = array('title', 'banner', 'description', 'start_date', 'end_date', 'trainer_ids');
	protected $resource;
	protected $options = array();
	protected $rules = 'training';
	protected $upload_folder = './public/assets/upload/trainings_banners/';

	public function __construct()
	{
		parent::__construct();
		$this->resource_model = 'Training' ;
        $this->before_filter[] = array(
        	'action' => '_resource',
        	'only' => array('edit','update','create_new','create', 'show','delete')
        );
        $this->before_filter[] = array(
        	'action' => '_build_trainers_select',
        	'only' => array('edit','update','create_new','create')
        );
	}

	public function index()
	{
		$trainings = Training::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'admin/trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render() ));
	}
	public function create_new()
	{
		$this->load->section('content', 'admin/trainings/create_new', array('training' => $this->resource, 'options' => $this->options));
	}

	public function create()
	{
		if ($this->resource->save_a_training($this->resource_data()))
		{
			$this->session->set_flashdata('notice', 'Training created.');
			redirect('admin/trainings');
		}
		$this->load->section('content', 'admin/trainings/create_new', array('training' => $this->resource, 'options' => $this->options));

	}

	public function edit($id)
	{
		$this->load->section('content', 'admin/trainings/edit', array('training' => $this->resource, 'options' => $this->options));
	}

	public function update($id)
	{
		if ($this->resource->save_a_training($this->resource_data()))
		{
			$this->session->set_flashdata('notice', 'Training updated.');
			redirect('admin/trainings');
		}
		$this->load->section('content', 'admin/trainings/edit', array('training' => $this->resource, 'options' => $this->options));
	}

	public function show($id)
	{
		$this->load->section('content', 'admin/trainings/show', array('training' => $this->resource));
	}

	public function delete($id)
	{
		$this->resource->delete();
		$this->session->set_flashdata('Training deleted.');
		redirect('admin/trainings');
	}

	protected function _build_trainers_select()
	{
		$trainers_select = function(){
			$select = array();
			foreach (User::build_trainers_select()->get() as $user) {
				$select[$user->id] = $user->full_name;
			}
			return $select;
		};
		$this->options['trainers_select_options'] = $trainers_select();
		$this->options['current_trainers_options'] = array_key_exists('trainer_ids', $this->resource_data()) ? $this->resource_data()['trainer_ids'] : [] ;
		if ( empty($this->options['current_trainers_options']) )
		{
			$this->options['current_trainers_options'] = $this->resource->current_trainers_select();
		}
	}
}

