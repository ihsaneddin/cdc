<?php
namespace traits;
use \Sentry;
use \Group;

trait AuthenticationTrait {

	use SentryTrait;
	protected $skip_group = false;
	protected $login_url;
	protected $group;

	protected function authenticate()
	{
		if ($this->sentry->check())
		{
			if (!$this->skip_group)
			{
				$this->_group();
				if ($this->sentry->inGroup($this->group)) return true;
			}
			else{
				return true;
			}
		}
		$this->_getLogin();
	}

	protected function _group()
	{

		if (!$this->group instanceof Group)
		{
			try
			{
			    $this->group = $this->sentry->findGroupByName($this->group);
			}
			catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    show_404();
			}
		}
	}

	protected function _getLogin()
	{
		$this->session->set_flashdata('error', 'You must login first.');
		redirect($this->login_url);
	}

}