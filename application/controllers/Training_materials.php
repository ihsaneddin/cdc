<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Training_materials extends User_Controller {

	private $training;
	protected $skip_group = true;
	protected $file_path;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->before_filter[] = array(
			'action' => '_training',
			'only' => array('show')
			);
	}

	public function show($slug,$id)
	{
	    $mime = get_mime_by_extension($this->file_path);
	    // Build the headers to push out the file properly.
	    header('Pragma: public');     // required
	    header('Expires: 0');         // no cache
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($this->file_path)).' GMT');
	    header('Cache-Control: private',false);
	    header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
	    header('Content-Disposition: attachment; filename="'.basename($this->resource->file_name).'"');  // Add the file name
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: '.filesize($this->file_path)); // provide file size
	    header('Connection: close');
	    readfile($this->file_path); // push it out
	    exit();
	}

	protected function _training(){
		try{

			$this->training = Training::where('id', '=', $this->router->uri->rsegment(3))->first();
			if ($this->use_slug)
			{
				$this->training = Training::find_by_slug($this->router->uri->rsegment(3));
			}

			$this->resource = $this->training->training_materials()->findOrFail(array($this->router->uri->rsegment(4)))->first();
			$this->file_path = $this->resource->file_path('file_name');
		}catch(Exception $e)
		{
			show_404();
		}
	}
}

