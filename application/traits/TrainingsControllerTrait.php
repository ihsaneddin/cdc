<?php
namespace traits;
use \Training;
use \User;

trait TrainingsControllerTrait {

	protected $certified_user;

	public function index()
	{
		$trainings = Training::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', $this->folder.'trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render() ));
	}
	public function create_new()
	{
		$this->load->section('content', $this->folder.'trainings/create_new', array('training' => $this->resource, 'options' => $this->options));
	}

	public function create()
	{
		if ($this->resource->save_a_training($this->resource_data()))
		{
			$this->session->set_flashdata('notice', 'Training created.');
			redirect($this->folder.'trainings');
		}
		$this->load->section('content', $this->folder.'trainings/create_new', array('training' => $this->resource, 'options' => $this->options));

	}

	public function edit($id)
	{
		$this->load->section('content', $this->folder.'trainings/edit', array('training' => $this->resource, 'options' => $this->options));
	}

	public function update($id)
	{
		if ($this->resource->save_a_training($this->resource_data()))
		{
			$this->session->set_flashdata('notice', 'Training updated.');
			redirect($this->folder.'trainings/show/'.($this->use_slug ?  $this->resource->slug : $this->resource->id));
		}
		$this->load->section('content', $this->folder.'trainings/edit', array('training' => $this->resource, 'options' => $this->options));
	}

	public function show($id)
	{
		$this->load->section('content', $this->folder.'trainings/show', array('training' => $this->resource));
	}

	public function delete($id)
	{
		$this->resource->delete();
		$this->session->set_flashdata('notice', 'Training deleted.');
		redirect('admin/trainings');
	}

	public function list_of_attendances($id)
	{
		$this->load->helper(array('dompdf', 'file'));
	    $html = $this->load->view('pdfs/list_of_attendances', array('training' => $this->resource) , true);
	    pdf_create($html, 'List Of Attendances '.$this->resource->title, true, array('Attachment' => 0));
	}

	public function certificate($id)
	{
			$this->load->helper(array('dompdf', 'file'));
	    $html = $this->load->view('pdfs/certificate', array('training' => $this->resource, 'user' => $this->certified_user) , true);
	    pdf_create($html, $this->resource->title.' '.$this->certified_user->full_name, true, array('Attachment' => 0));
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

	protected function _set_cdc_head_officer()
	{
		$last_training = Training::orderBy('created_at', 'desc')->take(1)->get()->last();
		if (!is_null($last_training)){$this->resource->cdc_head_officer = $last_training->cdc_head_officer;}
	}

	protected function _certifiable()
	{
		$this->certified_user = User::where('student_id', '=', $this->router->uri->rsegment(4))->first();
		if (is_null($this->certified_user) || (!$this->resource->certifiable($this->certified_user)))
		{
			show_404();
		}
	}

}