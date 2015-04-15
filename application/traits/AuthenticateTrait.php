<?php
namespace traits;
use \Sentry;
use \Exception;

trait AuthenticateTrait{

	protected $credential_keys;
	protected $_login_attribute;

	public function _authenticate()
	{
		$this->_already_login();
		if ($this->_request('post'))
		{
			try
			{
			   $this->sentry->authenticate($this->_credentials(), $this->_remember());
			   redirect($this->after_login_url);
			}
			catch (Exception $e)
			{
			    $this->session->set_flashdata('error', 'Invalid username or password');

			}
		}
		$this->load->section('content', $this->content);
	}

	protected function _credentials()
	{
		$use = array();
		foreach ($this->input->post() as $key => $value) {
			if (in_array($key, $this->credential_keys)) $use[$key] = $value;
		}
		return $use;
	}
	protected function _remember()
	{
		if (array_key_exists('remember', $this->input->post())) {
			return true;
		}
		return false;
	}
	protected function _login_attribute()
	{
		if (is_null($this->sentry->getUser()))
 		{
 			$this->sentry->getUserProvider()->getEmptyUser()->setLoginAttributeName($this->_login_attribute);
 		}
	}

	protected function _already_login()
	{
		if (!empty($this->current_user))
		{
			$this->session->set_flashdata('notice', 'You are already logged in');
			redirect($this->after_login_url);
		}
	}

}