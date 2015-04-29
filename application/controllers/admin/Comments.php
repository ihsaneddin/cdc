<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends Admin_Controller {

    protected $resource_model = 'Comment';
    protected $is_nested_resource = true;
    protected $training;

    public function __construct()
    {
        parent::__construct();
        $this->before_filter[] = array(
            'action' => '_training',
            'only' => array('create', 'index')
            );
        $this->before_filter[] = array(
            'action' => '_only_ajax',
            'only' => array('index')
            );
    }

    public function index($training_id)
    {
        $comments = $this->training->comments()->get()->paginate(10);

    }

    public function create()
    {
        if ($this->resource->store($this->resource_data()))
        {
            redirect('admin/trainings/show/2#comment-'.$this->resource->id);
        }else{
            $this->load->section('content', 'admin/trainings/show', array('training' => $this->training, 'new_comment' => $this->resource));
        }
    }

    protected function _training()
    {
        try{
            $this->training = Training::findOrFail($this->router->uri->rsegment(3));
            $this->resource->training_id = $this->training->id;
            $this->resource->user_id = $this->current_user->id;
        }catch(Exception $e){
            show_404();
        }

    }

}
