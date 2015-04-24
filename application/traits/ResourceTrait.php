<?php
namespace traits;

trait ResourceTrait {

	protected $allowed_attributes = array();
	protected $is_nested_resource = false;
	protected $resource_model;
	protected $resource;

	protected function resource_attributes($data = array())
	{
		$allowed_inputs = array();
		$data = empty($data) ? $this->input->post() : $data;
		foreach ($data as $attr => $value) {
			if (in_array($attr, $this->allowed_attributes)) $allowed_inputs[$attr] =$value;
		}
		return $allowed_inputs;
	}

	protected function _update_rules($rules=array())
	{
		$this->config->load("form_validation");
		$rules = empty($rules) ? $this->config->item($this->rules) : $rules;
		if (!empty($rules) && !is_null($this->resource) ){
			$index = 0;
			foreach ($rules as $key) {
				$arr = explode('is_unique', $key['rules']);
				if (count($arr) > 1){
					$end = array_pop($arr);
					$is_unique = explode('|', $end);
					$is_unique[0] = 'edit_unique['.preg_replace('/[^A-Za-z0-9.\-]/', '', $is_unique[0]).'.'.$this->resource->id.']';
					$is_unique = implode('|', $is_unique);
					$arr[] = $is_unique;
					$rules[$index]['rules'] = implode('', $arr);
				}
				$index++;
			}
		}
		return $rules;
	}

	protected function _set_resource_attributes()
	{
		foreach ($this->resource_attributes() as $attr => $value) {
			$this->resource->$attr = empty($value) ? $this->resource->$attr : $value;
		}
	}

	protected function _find_resource()
	{
		try{
			$this->resource = call_user_func_array(array($this->resource_model, 'findOrFail'), array($this->uri->rsegment(3)));
		}catch(\Exception $e){
			show_404();
		}
	}

	protected function _new_resource()
	{
		$this->resource = new $this->resource_model;
	}

	protected function resource_data()
	{
		$post = is_null($this->input->post(underscore($this->resource_model))) ? [] : $this->input->post(underscore($this->resource_model));
		$files = $this->input->file(underscore($this->resource_model));
		$data = $post;
		if (!empty( $files ))
		{
			$data = array_merge_recursive($post, $files);
		}
		return $data;
	}
	protected function _resource()
	{
		$resource = is_null($this->resource_model) ? null : $this->resource_model;
		if (class_exists($resource))
		{
			$id = $this->router->uri->rsegment($this->is_nested_resource ? 4 : 3);
			if ( is_null($id) )
			{
				$this->resource = new $resource;
			}
			else
			{
				try{
					$this->resource = call_user_func_array(array($this->resource_model, 'findOrFail'), array($id));
				}catch (\Exception $e){
					show_404();
				}
			}
		}
	}
}