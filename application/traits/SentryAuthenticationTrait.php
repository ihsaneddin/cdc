<?php
namespace traits;

use \Sentry;

trait SentryAuthenticationTrait{

	protected $sentry;
	protected $login_path;
	protected $after_login_path = 'admin/home';
	public $current_user;

	protected function _initializeSentry()
	{
		if (!$this->sentry instanceof Sentry){
			$this->sentry = Sentry::createSentry();
		}
	} 

	protected function _authenticate()
	{
		if ($this->_isLogin())
		{
			if (!$this->sentry->hasAccess($this->_route()))
			{
				$this->session->set_flashdata('notice', 'You have sufficient access to this page');
				show_404();
			}
			$this->_set_current_user();
		}else
		{
			$this->getLogin();
		}
	}

	public function _isLogin()
	{
		return $this->sentry->check();
	}

	protected function _route()
	{
		return $this->router->directory.$this->router->class.$this->router->method;
	}

	protected function getLogin()
	{
		$this->login_path = is_null($this->login_path) ? 'sessions/new' : $this->login_path;
		redirect($this->login_path);
	}

	protected function _set_current_user()
	{
		$this->current_user = $this->sentry->getUser();
	}

}