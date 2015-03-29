<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends Command
{
	public function index()
	{
		if(!$this->migration->latest())
	    {
	      show_error($this->migration->error_string());
	    }
	}
}