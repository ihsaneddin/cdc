<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $layout;
	protected $sentry;
	protected $current_user;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('breadcrumb');
		$this->load->helper('string');
		$this->_sentry();
		$this->_current_user();
	}

	protected function _sentry()
	{
		if (!$this->sentry instanceof Sentry) $this->sentry = Sentry::createSentry();
		return $this->sentry;
	}

	protected function _current_user()
	{
		$this->current_user = $this->sentry->check() ? $this->sentry->getUser() : NULL;
	}

	protected function _request($type)
	{
		return strtolower($this->input->server('REQUEST_METHOD')) === strtolower($type);
	}
}

class User_Controller extends MY_Controller
{
	protected $layout='default';

	public function __construct()
	{
		parent::__construct();
		$this->_init();
	}
	protected function _init()
	{
		$this->output->set_template($this->layout);
		$this->load->section('header', 'shared/header');
		$this->load->section('navigation', 'shared/navigation');
		$this->load->section('footer', 'shared/footer');
	}
}

class Admin_Controller extends MY_Controller
{
	protected $layout = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->_authenticate_admin();
		$this->_init();
	}

	protected function _init()
	{
		$this->output->set_template($this->layout);
		$this->breadcrumb->append('Home', 'admin/home');
		$this->load->section('header', 'admin/shared/header');
		$this->load->section('navigation', 'admin/shared/navigation');
		$this->load->section('breadcrumbs', 'admin/shared/breadcrumbs');
		$this->load->section('footer', 'admin/shared/footer');
		$this->load->section('sidebar', 'admin/shared/sidebar');
	}

	protected function _authenticate_admin()
	{
		if (!(!is_null($this->current_user) && ($this->current_user->id == 1)))
		{
			$this->session->set_flashdata('error', 'You must login first.');
			redirect('admin/login');
		}
	}
}

class Command extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->input->is_cli_request()
		or exit ('Execute via command line interface only');
		$this->load->library('migration');
	}
}


use interfaces\AuthenticationInterface;
use traits\AuthenticateTrait;

class Authentication_Controller extends MY_Controller implements AuthenticationInterface{
	use AuthenticateTrait;

	protected $layout='admin_login';
	protected $after_login_url;
	protected $after_logout_url;
	protected $content;

	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->credential_keys = ['username', 'password'];
		$this->_login_attribute = 'username';
		$this->_login_attribute();
	}

	public function create()
	{
		$this->_authenticate();
	}

	public function delete()
	{
		$this->sentry->logout();
		$this->session->set_flashdata('error', 'You are now logged out.');
		redirect($this->after_logout_url);
	}

	protected function _init()
	{
		$this->output->set_template($this->layout);
	}
}

use Philo\Blade\Blade;

class Blade_Controller extends CI_Controller {

	public $layout = "layouts.test";
	protected $view;
	protected $blade;

	function __construct()
	{
		parent::__construct();
		$this->_blade();
		$this->_setup_layout();
	}

	protected function _blade()
	{
		if (!$this->blade instanceof Blade)
		{
			$this->views = APPPATH.'views';
			$this->cache = APPPATH.'cache';
			$this->blade = new Blade($this->views, $this->cache);
 		}
	}

	protected function _setup_layout()
	{
		if ( ! is_null($this->layout))
		{
			$this->view = $this->blade->view()->make($this->layout);
		}
	}
	protected function _view()
	{
		echo $this->view;
	}

}