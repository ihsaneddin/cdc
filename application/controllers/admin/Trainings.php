<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Illuminate\Database\Eloquent\Collection;

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
        	'action' => '_build_trainers_select',
        	'only' => array('edit','update','create_new','create')
        );
	}

	public function index()
	{
		$trainings = Training::paginate(20);
		$this->load->section('content', 'admin/trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render() ));
	}
	public function create_new()
	{
		$this->resource = new Training;
		$this->load->section('content', 'admin/trainings/create_new', array('training' => $this->resource, 'options' => $this->options));		
	}

	public function create()
	{
		$this->resource = new Training;
		if ($this->form_validation->run('training'))
		{
			if ($this->_upload_banner() && $this->_upload_training_materials())
			{
				$this->resource->push();
				$this->session->set_flash_data('success', 'Training created.');
			}
		}
		$this->load->section('content', 'admin/trainings/create_new', array('training' => $this->resource, 'options' => $this->options));

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
	}

	protected function _upload_banner()
	{
		if (!empty($_FILES['banner'])){
			$config = array(
				'upload_path' => $this->upload_folder,
				'allowed_types' => 'jpg|png|jpeg',
				'max_size' => 1024*2,
				'encrypt_name' => true
				);
			$this->load->library('upload', $config);
			if ($this->upload->do_multi_upload('banner')){
				$this->resource->banner = $this->upload->data('file_name');
				return true;
			}
			$this->form_validation->set_message('banner', $this->upload->display_errors());

		}
	}
	protected function _upload_training_materials()
	{
		if (!empty($_FILES['training_materials']) && is_array($_FILES['training_materials']) )
		{
			$this->upload_folder = './public/assets/upload/trainings_materials/';
			$config = array(
				'upload_path' => $this->upload_folder,
				'allowed_types' => 'doc|docx|xls|xlsx|ppt|pptx|pdf|zip|rar',
				'max_size' => 1024*10,
				'encrypt_name' => true
				);
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ($this->upload->do_multi_upload('training_materials')){
				foreach ($this->upload->get_multi_upload_data() as $data) {
					$training_material = new TrainingMaterial;
					$training_material->file = $data['file_name'];
					if (!$this->resource->training_materials instanceOf Collection)
					{
						$this->resource->training_materials = new Collection;
					}
					$this->resource->training_materials->push($training_material);
				}
				return true;
			}
			var_dump($this->upload->display_errors());
			$this->form_validation->set_message('training_materials', $this->upload->display_errors());
			$this->_delete_files($this->upload->get_multi_upload_data());
		}
	}

	protected function _delete_files($files)
	{
		 if (!empty($files)) {
	        for ($i = 0; $i < count($files); $i++) {
	            $file = $this->upload_folder . $files[$i]['file_name'];
	            if (file_exists($file)) {
	                unlink($file);
	            }
	        }
	    }
	}
}

