<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends Sessions_Controller {

	protected $layout='user_login';
	protected $options = array();
	//protected $login_admin = false;

	public function __construct()
	{
		$this->after_login_url = 'home';
		$this->after_logout_url = 'login';
		$this->login_view = 'sessions/create_new';
		parent::__construct();
	}
}
