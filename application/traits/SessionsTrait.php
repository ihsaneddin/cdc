<?php
namespace traits;
use \Sentry;
use \Exception;

trait SessionsTrait{

	protected $credential_keys;
	protected $_login_attribute;
	protected $after_login_url;
	protected $after_logout_url;
	protected $login_view = 'sessions/create_new';

	public function create()
	{
		$this->_login();
	}

	public function delete()
	{
		$this->sentry->logout();
		$this->session->set_flashdata('error', 'You are now logged out.');
		redirect($this->after_logout_url);
	}

	public function _login()
	{
		if ($this->_request('post'))
		{
			try
			{
			   $this->sentry->authenticate($this->_credentials(), $this->_remember());
			   $this->_set_current_user();
			   redirect($this->after_login_url);
			}
			catch (Exception $e)
			{
			    dump($e);
			    die();
			    $this->session->set_flashdata('error', 'Invalid username or password');

			}
		}	
		$this->load->section('content', $this->login_view);
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

	protected function _is_logged_in()
	{
		if ($this->_isLogin())
		{
			redirect($this->after_login_url);
		}
	}

}