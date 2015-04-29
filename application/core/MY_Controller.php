	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	use traits\BeforeFilterTrait;

    public function __construct()
    {
    	parent::__construct();
   		$this->filter_called_method();
   		$this->form_validation->set_error_delimiters('<span class="help-inline error-validation-message">', '</span>');
   				$this->after_filter[] = array(
            'action' => '_load_flash_message'
        );
    }

    protected function _request($type)
	{
		return strtolower($this->input->server('REQUEST_METHOD')) === strtolower($type);
	}

	protected function _only_ajax()
	{
		if (!$this->input->is_ajax_request())
		{
			show_404();
		}
	}

}


use traits\SentryAuthenticationTrait;

class Base_Controller extends MY_Controller {
	use traits\ResourceTrait, traits\BreadcrumbTrait, SentryAuthenticationTrait;

	protected $layout;
	protected $rules;

	public function __construct()
	{
		$this->before_filter[] = array(
            'action' => '_initializeSentry'
        );
		$this->before_filter[] = array(
            'action' => '_authenticate'
        );
        parent::__construct();
        $this->_initializeSentry();
        $this->_authenticate();
        $this->load->helper('string');
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





class Admin_Controller extends Base_Controller
{
	protected $layout = 'admin';

	public function __construct()
	{
		$this->after_login_path = 'admin/home';
		$this->login_path = 'admin/login';
		parent::__construct();
		$this->before_filter[] = array(
        	'action' => '_resource',
        	'only' => array('edit','update','create_new','create', 'show','delete')
        );

		$this->set_breadcrumb();
		$this->_set_admin_template();
	}
}

class User_Controller extends Base_Controller
{
	protected $layout = 'user';
	protected $after_login_path = 'home';
	protected $login_path = 'login';

	public function __construct()
	{
		parent::__construct();
		$this->set_breadcrumb();
		$this->_set_admin_template();
	}
}



use traits\SessionsTrait;

class Sessions_Controller extends MY_Controller{
	use SessionsTrait,SentryAuthenticationTrait;

	protected $layout='admin_login';

	public function __construct()
	{
		$this->before_filter[] = array(
            'action' => '_initializeSentry'
        );
		$this->before_filter[] = array(
            'action' => '_is_logged_in',
            'except' => array('delete')
        );
		$this->before_filter[] = array(
            'action' => '_init'
        );

        $this->before_filter[] = array(
            'action' => '_login_attribute'
        );
		$this->credential_keys = ['username', 'password'];
		$this->_login_attribute = 'username';
		parent::__construct();
	}

	protected function _init()
	{
		$this->output->set_template($this->layout);
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
