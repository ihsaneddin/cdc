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