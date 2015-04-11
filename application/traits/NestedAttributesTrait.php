<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Database\Eloquent\Collection;


trait NestedAttributesTrait{

	protected $nestTree = array();
	protected $relationTree = array();
	protected $position=0;
	protected $_delete = 0;
	protected $operation = array('_delete');
	protected $error_state = false;
	protected $files =array();
	protected $CI;

	public $input;
	public $validator;
	public $upload;
	public $data;
	public $errors = array();

	protected function initialize()
	{
		$this->CI = & get_instance();
		$this->input = $this->CI->input ;
		$this->validator = $this->CI->form_validation;
		$this->CI->load->library('upload');
		$this->upload = $this->CI->upload;
		unset($this->CI);
	}

	public function store(array $data= array())
	{
		Capsule::beginTransaction();
		try{
			$this->performSaveNest($data);
		}catch( Exception $e ){
			$this->delete_files();
			Capsule::rollback();
			return false;
		}
		Capsule::commit();
		return true;
	}

	protected function performSaveNest($data = array())
	{
		$this->nestByNest($data);
		if ( $this->error_state )
		{
			throw new Exception;
		}
	}

	//todo : remove root when recursing
	protected function nestByNest(array $data=array(), $parent=null, $root=null, $relation=null, $previousTree = array())
	{
		$this->initialize();
		$this->data = $data;
		if(!empty($this->data))
		{
			$this->setAttributes($parent, $relation);
			if ( $this->markedForDelete() )
			{
				$this->delete();
			}
			else
			{
				$this->updateRelationTree($previousTree, $relation);

				if ($this->validate()) $this->_store($parent,$relation,$root);
				else $this->attachErrors($root);
				if (property_exists($this, 'acceptNestedAttributes'))
				{
					foreach ($this->acceptNestedAttributes as $relation => $attributes) {
						if (array_key_exists($relation, $this->data))
						{
							foreach ($this->data[$relation] as $index => $childAttributes)
							{
								$child = $this->setChild($relation, $childAttributes);
								if ($child->id)
								$child->position = $index;
								$child->nestByNest($childAttributes, $this, is_null($root) ? $this : $root, $relation, $this->relationTree );
							}
						}
					}
				}
			}
		}
	}

	protected function _store($parent,$relation,$root)
	{
		$this->upload_file($root);
		(is_null($parent) || is_null($relation)) ? $this->save() : $parent->$relation()->save($this);
	}

	public function validate()
	{
		if (!empty($this->rules))
		{
			$this->validator->reset_validation();
			$rules = $this->exists() ? $this->_update_rules() : $this->rules;
			foreach ($rules as $rule) {
				$this->validator->set_rules($rule['field'], $rule['label'], $rule['rules']);
			}
			$this->validator->set_data($this->data);
			if (!$this->validator->run()){
				$this->errors = $this->validator->error_array();
				return false;
			}
		}
		return true;

	}


	protected function upload_file($root)
	{
		if (!empty($this->expected_files))
		{
			foreach ($this->expected_files as $file_field => $required) {
				if ( is_array($this->$file_field) )
				{
					$_FILES[$file_field] = $this->$file_field;
					$this->$file_field = null;
					$config = $this->upload_config[$file_field];
					$this->upload->initialize($config);
					if ($this->upload->do_upload($file_field))
					{
						$this->$file_field = $this->upload->data('file_name');
						is_null($root) ? array_push($this->files, $this->upload->data()) : array_push($root->files, $this->upload->data());
					}
					else {
						if ($required != '') {
							if (!is_null($root)){
								$root->error_state = true;
							}
							$this->error_state = true;
							$this->errors[$file_field] = $this->upload->display_errors();
							$this->attachErrors($root);
						}
					}
					unset($_FILES[$file_field]);
				}

			}
		}
	}

	protected function setChild($relation, $data, $zero=0)
	{
		$id = array_key_exists($this->childPrimaryKey($relation), $data);
		$child = call_user_func_array(array($this->childClass($relation), 'firstOrNew'), array( [$this->childPrimaryKey($relation) => $id] ));
		if ( !$this->$relation instanceof Collection )
		{
			$this->$relation = new Collection;
		}
		$this->$relation->push($child);
		return $child;
	}

	protected function positionBase()
	{
		return implode('', $this->relationTree);
	}

	protected function updateRelationTree($previousTree,$relation)
	{
		empty($previousTree) ? : $this->relationTree= $previousTree;
		if ( ! is_null($relation) ) array_push($this->relationTree, $relation.'['.$this->position.']');
	}

	public function hasChilds($relation)
	{
		return !($this->$relation->isEmpty());
	}

	protected function attachErrors($root)
	{
		if (!is_null($root)){
		}
		if ( !is_null($root) && !empty($this->errors) )
		{
			foreach ($this->errors as $attribute => $message) {
				$root->errors[$this->positionBase().'['.$attribute.']'] = $message;
			}
		}

	}


	protected function setAttributes($parent, $relation=null)
	{
		$data = $this->data;
		$fillable = (is_null($parent) || is_null($relation)) ? $this->fillable : $parent->acceptNestedAttributes[$relation];
		foreach ($data as $key => $value) {
			if (!in_array($key, $fillable) && !in_array($key, $this->operation))
			{
				 unset($data[$key]);
			}
		}
		$this->_delete = array_key_exists('_delete', $data) ? $data['_delete'] : $this->_delete;
		$this->fill($data);
	}

	protected function childPrimaryKey($relation)
	{
		$child_class = $this->childClass($relation);
		$child = new $child_class();
		return $child->getKeyname();
	}

	protected function childClass($relation)
	{
		return class_basename(get_class($this->$relation()->getRelated()));
	}

	protected function markedForDelete()
	{
		return $this->_delete == 1 ? true : false;
	}

	protected function _update_rules($rules=array())
	{
		$rules = $this->rules;
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

	protected function delete_files()
	{
		 if (!empty($this->files)) {
	        for ($i = 0; $i < count($this->files); $i++) {
	            $file = $this->files[$i]['full_path'];
	            if (file_exists($file)) {
	                unlink($file);
	            }
	        }
	    }
	}

}