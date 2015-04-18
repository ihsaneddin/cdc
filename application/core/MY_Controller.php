	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	use traits\BeforeFilterTrait;

    public function __construct()
    {
    	parent::__construct();
   		$this->filter_called_method();
    }

    protected function _request($type)
	{
		return strtolower($this->input->server('REQUEST_METHOD')) === strtolower($type);
	}

}

class Base_Controller extends MY_Controller {
	use traits\ResourceTrait, traits\BreadcrumbTrait, traits\AuthenticationTrait;

	protected $layout;
	protected $rules;

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<span class="help-inline error-validation-message">', '</span>');
		$this->load->helper('string');
		$this->_initialize_sentry();

		$this->before_filter[] = array(
            'action' => 'authenticate'
        );
		$this->after_filter[] = array(
            'action' => '_load_flash_message'
        );
	}

	protected function _set_admin_template()
	{
		$this->output->set_template($this->layout);

		$this->load->section('header', 'admin/shared/header');
		$this->load->section('navigation', 'admin/shared/navigation', array('base_url' => current_base_url($this->router->uri->segments)));
		$this->load->section('breadcrumbs', 'admin/shared/breadcrumbs');
		$this->load->section('footer', 'admin/shared/footer');
		$this->load->section('sidebar', 'admin/shared/sidebar', array('current_user' => $this->current_user));
	}

	protected function _set_user_template()
	{
		$this->output->set_template($this->layout);
		$this->load->section('header', 'shared/header');
		$this->load->section('navigation', 'shared/navigation');
		$this->load->section('footer', 'shared/footer');
	}

	protected function _load_flash_message()
	{
		$this->load->section('flash_message', 'admin/shared/flash');
	}
}

class User_Controller extends Base_Controller
{
	protected $layout='default';
	protected $group='user';

	public function __construct()
	{
		parent::__construct();
		$this->_set_user_template();
	}
}

class Admin_Controller extends Base_Controller
{
	protected $layout = 'admin';

	public function __construct()
	{
		parent::__construct();
		$this->login_url = 'admin/login';
		$this->group= 'admin';
		$this->set_breadcrumb();
		$this->_set_admin_template();
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


use interfaces\SessionsInterface;
use traits\SessionsTrait;

class Sessions_Controller extends MY_Controller implements SessionsInterface{
	use SessionsTrait;

	protected $layout='admin_login';
	protected $after_login_url;
	protected $after_logout_url;
	protected $content;

	public function __construct()
	{
		parent::__construct();
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
