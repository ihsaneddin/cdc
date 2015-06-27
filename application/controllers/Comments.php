<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends User_Controller {

    protected $resource_model = 'Comment';
    protected $is_nested_resource = true;
    protected $training;
    //protected $skip_restriction = true;

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
            redirect('trainings/show/'.$this->training->slug.'#comment-'.$this->resource->id);
        }else{
            $this->load->section('content', 'trainings/show', array('training' => $this->training, 'new_comment' => $this->resource));
        }
    }

    protected function _training()
    {
        try{
            $this->training = Training::find_by_slug($this->router->uri->rsegment(3));
            if (is_null($this->training)){show_404();}
            $this->resource->training_id = $this->training->id;
            $this->resource->user_id = $this->current_user->id;
        }catch(Exception $e){
            show_404();
        }

    }

}
