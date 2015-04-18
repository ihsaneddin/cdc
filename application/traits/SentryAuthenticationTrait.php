<?php
namespace traits;

use \Sentry;

trait SentryAuthenticationTrait{

	protected $sentry;
	public $current_user;

	protected function _authenticate()
	{
		if (!$this->sentry instanceof Sentry){
			$this->sentry = Sentry::createSentry();
			if ($this->sentry->check())
			{
				$this->current_user = $this->sentry;
				if (!$this->sentry->hasAccess($this->_route())
				{
					$this->session->set_flashdata('notice', 'You have sufficient access to this page');
					show_404();
				}
			}
			else{
				$this->getLogin()
			}
		}
	}

	protected function _route()
	{
		return $this->router->directory.$this->router->class.$this->router->method;
	}

}