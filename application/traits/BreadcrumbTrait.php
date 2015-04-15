<?php

trait BreadcrumbTrait {

	protected $folder = 'admin';

	protected function set_breadcrumb()
	{
		$this->breadcrumb->append('Home', $this->folder.'/home');
		$this->breadcrumb->append( ucwords($this->router->class) , $this->folder.'/'.$this->router->class.'/index');
		$show = 'show';
		switch ($this->router->method) {
			case 'edit':
			case 'update':
				$this->breadcrumb->append( ucwords($this->router->method) , 'admin/'.$this->router->class.'/'.$show.'/'.$this->router->uri->rsegment(3));
				$this->breadcrumb->append( ucwords($this->router->method) , 'admin/'.$this->router->class.'/'.$this->router->method.'/'.$this->router->uri->rsegment(3));
				break;
			default:
				if ($this->router->method != 'index')
				{
					$this->breadcrumb->append( ucwords($this->router->method) , 'admin/'.$this->router->class.'/'.$this->router->method.'/'.$this->router->uri->rsegment(3));
				}
				break;
		}
	}
}