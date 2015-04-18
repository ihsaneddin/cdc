<?php
namespace traits;
use \Sentry;

trait SentryTrait {

	protected $sentry;
	protected $current_user;

	protected function _initialize_sentry()
	{
		if (!$this->sentry instanceof Sentry) $this->sentry = Sentry::createSentry();
		$this->_set_current_user();
	}

	protected function _set_current_user()
	{
		$this->current_user = $this->sentry->check() ? $this->sentry->getUser() : NULL;
	}
}