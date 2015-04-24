<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Admin_Controller {

    protected $resource_model = 'Article';

    public function index()
    {
		$articles = Article::filter($this->input->get('search'))->paginate(20);
		$this->load->section('content', 'admin/articles/index', array('articles' => $articles->toArray(), 'pagination' => $articles->links()->render() ));
    }

    public function create_new()
    {
        $this->load->section('content', 'admin/articles/create_new', array('article' => $this->resource, 'options' => $this->options));
    }

    public function create()
    {
        if ($this->resource->store($this->_article_data()))
		{
			$this->session->set_flashdata('notice', 'Article created.');
			redirect('admin/articles');
		}
		$this->load->section('content', 'admin/articles/create_new', array('article' => $this->resource, 'options' => $this->options));

    }

    public function edit($id)
    {
        $this->load->section('content', 'admin/articles/edit', array('article' => $this->resource, 'options' => $this->options));
    }

    public function update($id)
    {
        if ($this->resource->store($this->resource_data()))
        {
            $this->session->set_flashdata('notice', 'Article updated.');
            redirect('admin/articles');
        }
        $this->load->section('content', 'admin/articles/edit', array('article' => $this->resource, 'options' => $this->options));
    }

    public function delete($id)
    {
        $this->resource->delete();
        $this->session->set_flashdata('notice', 'Article deleted.');
        redirect('admin/articles');
    }

    public function show($id)
    {
        $this->load->section('content', 'admin/articles/show', array('article' => $this->resource, 'options' => $this->options));
    }

    protected function _article_data()
    {
        return array_merge($this->resource_data(), array('user_id' => $this->current_user->id));
    }
}
