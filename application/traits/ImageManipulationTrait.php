<?php

trait ImageManipulationTrait{

	protected function _create_thumb()
	{
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = 75;
		$config['height']       = 50;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();
	}

}