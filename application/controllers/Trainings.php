<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainings extends User_Controller {

	public function index()
	{
		$trainings = Training::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'trainings/index', array('trainings' => $trainings->toArray(), 'pagination' => $trainings->links()->render() ));
	}
}

