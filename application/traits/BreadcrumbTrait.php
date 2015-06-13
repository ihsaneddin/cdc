<?php
namespace traits;

trait BreadcrumbTrait {

	protected $folder = null;
	protected $root = 'home';

	protected function set_breadcrumb()
	{
		$this->breadcrumb->append('Home', is_null($this->folder) ? $this->root : $this->folder.'/'.$this->root);
		if ($this->router->class != $this->root)
		$this->breadcrumb->append( ucwords($this->router->class) , $this->folder.'/'.$this->router->class.'');
		$show = 'show';
		switch ($this->router->method) {
			case 'edit':
			case 'update':
				$this->breadcrumb->append( ucwords($show) , $this->folder.$this->router->class.'/'.$show.'/'.$this->router->uri->rsegment(3));
				$this->breadcrumb->append( ucwords($this->router->method) , $this->folder.$this->router->class.'/'.$this->router->method.'/'.$this->router->uri->rsegment(3));
				break;
			default:
				if ($this->router->method != 'index')
				{
					$this->breadcrumb->append( ucwords($this->router->method) , $this->folder.$this->router->class.'/'.$this->router->method.'/'.$this->router->uri->rsegment(3));
				}
				break;
		}
	}
}