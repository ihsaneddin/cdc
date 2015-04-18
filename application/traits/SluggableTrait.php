<?php
namespace traits;

trait SluggableTrait {

	protected function set_slug()
	{
		if (!empty($this->sluggable))
		{
			$from = array_key_exists('from', $this->sluggable) ? $this->sluggable['from'] : '';
			$to = array_key_exists('to', $this->sluggable) ? $this->sluggable['to'] : '';
			if (!empty($from) && !empty($to))
			{
				$this->slugify();
			}

		}
	}

	protected function slugify()
	{
		$slug_field = $this->sluggable['to'];
		$slug_build = $this->sluggable['from'];
	  	$slug = preg_replace('~[^\\pL\d]+~u', '-', $this->$slug_build);
	  	$slug = trim($slug, '-');
	  	$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
	  	$slug = strtolower($slug);
	  	$slug = preg_replace('~[^-\w]+~', '', $slug);
		if (!empty($slug) && $this->slug_must_be_uniq($slug) )
		{
		 $this->$slug_field = $slug;
		}
	}

	protected function slug_must_be_uniq($slug)
	{
		$obj = call_user_func_array(array(get_class($this), 'firstOrNew'), array([$this->sluggable['to'] => $slug]));
		if ( is_null($obj->id) || $obj->id == $this->id)
		{
			return true;
		}
		$this->errors[$this->sluggable['from']] = "Slug must be unique";
		return false;
	}
}