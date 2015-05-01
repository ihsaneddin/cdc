<?php

function asset_url($asset='')
{
	echo(base_url().'public/assets/'.$asset);
}

function css_url($css='')
{
	echo base_url().'public/assets/css/'.$css;
}
function javascript_url($js)
{
	echo base_url().'public/assets/js/'.$js;
}

function image_url($image)
{
	echo base_url().'public/assets/img/'.$image;
}

function soft_image_url($image)
{
	return base_url().'public/assets/img/'.$image;
}

function avatar_url($avatar=null)
{
	$avatar = is_null($avatar) ? 'avatar-default.png' : $avatar;
	echo base_url().'public/assets/upload/avatars/'.$avatar;
}

function soft_avatar_url($avatar=null)
{
	$avatar = is_null($avatar) ? 'avatar-default.png' : $avatar;
	return base_url().'public/assets/upload/avatars/'.$avatar;
}
function soft_uploaded_file_url($file_path)
{
	return base_url().'public/assets/upload/'.$file_path;
}

function has_error($error)
{
	echo $error != '' ? 'has-error' : '';
}

function has_error_for($errors = array(), $key)
{
	return array_key_exists($key, $errors) ? 'has-error' : '';
}

function has_error_for_nested($childs, $key)
{
	if ($childs instanceof \Illuminate\Database\Eloquent\Collection)
	{
		foreach ($childs as $child) {
			if( !empty($child->errors) && array_key_exists($key, $child->errors) )
			{
				return 'has-error';
			}
		}
	}
}
function error_message_for_nested($childs, $key)
{
	$message = '' ;
	if ($childs instanceof \Illuminate\Database\Eloquent\Collection)
	{
		foreach ($childs as $child) {
			if( !empty($child->errors) && array_key_exists($key, $child->errors) )
			{
				$message = $message.' '.$child->errors[$key];
			}
		}
	}
	return '<span class="help-inline error-validation-message">'.$message.'</span>';
}
function error_message_for($errors = array(), $key)
{
	return array_key_exists($key, $errors) ? "<span class='help-inline error-validation-message'>".$errors[$key]."</span>" : null;
}

function flash_message($session)
{
	$types = array('error' => 'danger', 'notice' => 'info', 'success' => 'success', 'alert' => 'alert');
	foreach ($types as $type => $value) {
		if ($session->flashdata($type))
		{
			return "<div class=\"alert alert-border alert-".$value."\">
					    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
					   <strong>".$session->flashdata($type)."</strong>
					</div>";
		}
	}
}

function pagination_info($data =array())
{
	if (!empty($data))
	{
		$factor = $data['current_page'] - 1;
		$entries = count($data['data']) + ($data['per_page'] * $factor);
		return 'Showing entries '.$entries.' of '.$data['total'];
	}
}

function tr_number($data = array())
{
	if (!empty($data))
	{
		$factor = $data['current_page'] - 1;
		if($factor == 0)
		{
			return 1;
		}
		$entries = count($data['data']) + ($data['per_page'] * $factor);
		return $entries;
	}
}

function empty_table($records, $column=6, $message = 'No record found!')
{
	if (empty($records)) return '<tr><td colspan="'.$column.'" class="error-validation-message"><center>'.$message.'</center></td></tr>';
}

function input_value($object_value ,$attribute)
{
	$value = set_value($attribute);
	$value = empty($value) ? $object_value : $value;
	return $value;
}

function underscore($input) {
  preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  $ret = $matches[0];
  foreach ($ret as &$match) {
    $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  }
  return implode('_', $ret);
}

function total_participants($count , $max = 0, $label = 'label-default')
{
	if ($count < $max && $count != 0)
	{
		$label = 'label-success';
	}
	elseif ($count == $max) {
		$label = 'label-danger';
	}
	return "<span class='label ".$label."' >".$count."</span>";
}

function student_or_trainer($user)
{
	if (!$user->groups->isEMpty())
	{
		return $user->groups->first()->name == 'trainer' ? 'potato' : '' ;
	}
}

function current_base_url($uri_segments =array())
{
	while (count($uri_segments) >= 3)
	{
		array_pop($uri_segments);
	}
	return site_url().implode('/', $uri_segments);
}

function participant_confirmation_tr($participate, $class='warning')
{
	switch ($participate) {
		case true:
			$class = 'success';
			break;
		case false:
			$class = 'danger';
			break;
		case null:
			$class = 'warning';
			break;
	}
	return $class;
}

function selected_dropdown($value, $field)
{
	$current_value = set_value($field);
	return empty($current_value) ? $value : set_value('major_id');
}