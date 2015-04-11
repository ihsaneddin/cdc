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

function avatar_url($avatar)
{
	$avatar = is_null($avatar) ? 'avatar-default.png' : $avatar;
	echo base_url().'public/assets/upload/avatars/'.$avatar;
}

function has_error($error)
{
	echo $error != '' ? 'has-error' : '';
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

function empty_table($records, $column=6)
{
	if (empty($records)) return '<tr><td colspan="'.$column.'" class="error-validation-message"><center>No record found!</center></td></tr>';
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
