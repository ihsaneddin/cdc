<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends Sessions_Controller {

	public function __construct()
	{
		$this->after_login_url = 'admin/home';
		$this->after_logout_url = 'admin/login';
		$this->content = 'admin/sessions/create_new';
		parent::__construct();
	}
}
