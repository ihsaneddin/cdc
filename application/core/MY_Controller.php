	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $before_filter   = array();
    protected $after_filter    = array();

    public function __construct()
    {
    	parent::__construct();
   		$this->filter_called_method();
    }

    public function _remap($method, $params = array())
    {
        $this->before_filter();
        if (method_exists($this, $method))
        {
            empty($params) ? $this->{$method}() : call_user_func_array(array($this, $method), $params);
        }
        $this->after_filter();
    }

    public function __call($method, $args)
    {
        if (in_array($method, array('before_filter', 'after_filter')))
        {
            if (isset($this->{$method}) && ! empty($this->{$method}))
            {
                $this->filter($method, isset($args[0]) ? $args[0] : $args);
            }
        }
        else
        {
            log_message('error', "Call to nonexistent method ".get_called_class()."::{$method}");
            return false;
        }
    }

    protected function filter($filter_type, $params)
    {
        $called_action = $this->router->fetch_method();
        if ($this->multiple_filter_actions($filter_type))
        {
            foreach ($this->{$filter_type} as $filter)
            {
                $this->run_filter($filter, $called_action, $params);
            }
        }
        else
        {
            $this->run_filter($this->{$filter_type}, $called_action, $params);
        }
    }

    protected function run_filter(array &$filter, $called_action, $params)
    {
        if (method_exists($this, $filter['action']))
        {
            $only = isset($filter['only']);
            $except = isset($filter['except']);
            if ($only && $except)
            {
                log_message('error', "Only and Except are not allowed to be set simultaneously for action ({$filter['action']} on ".$this->router->fetch_method().".)");
                return false;
            }
            elseif ($only && in_array($called_action, $filter['only']))
            {
                empty($params) ? $this->{$filter['action']}() : $this->{$filter['action']}($params);
            }
            elseif ($except && ! in_array($called_action, $filter['except']))
            {
                empty($params) ? $this->{$filter['action']}() : $this->{$filter['action']}($params);
            }
            elseif ( ! $only && ! $except)
            {
                empty($params) ? $this->{$filter['action']}() : $this->{$filter['action']}($params);
            }
            return true;
        }
        else
        {
            log_message('error', "Invalid action {$filter['action']} given to filter system in controller ".get_called_class());
            return false;
        }
    }
    protected function multiple_filter_actions($filter_type)
    {
        return ! empty($this->{$filter_type}) && array_keys($this->{$filter_type}) === range(0, count($this->{$filter_type}) - 1);
    }

    protected function filter_called_method()
    {
    	try{
    		$method_reflection = new ReflectionMethod($this->router->fetch_class(), $this->router->fetch_method());
			if ( !$method_reflection->isPublic()) throw new Exception('Not found');
    	}catch(Exception $e)
    	{
    		show_404();
    	}
    }
}

class Base_Controller extends MY_Controller {
	use ResourceTrait;

	protected $layout;
	protected $sentry;
	protected $current_user;
	protected $rules;

	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters('<span class="help-inline error-validation-message">', '</span>');
		$this->load->helper('string');
		$this->_sentry();
		$this->_current_user();
		$this->after_filter[] = array(
            'action' => '_load_flash_message'
        );
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

	protected function _set_admin_template()
	{
		$this->output->set_template($this->layout);
		$this->breadcrumb->append('Home', 'admin/home');
		$this->load->section('header', 'admin/shared/header');
		$this->load->section('navigation', 'admin/shared/navigation');
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

	public function __construct()
	{
		parent::__construct();
		$this->_set_user_template();
	}
}

class Admin_Controller extends Base_Controller
{
	protected $layout = 'admin';
	protected $login_url = 'admin/login';
	protected $group;

	public function __construct()
	{
		parent::__construct();
		$this->before_filter[] = array(
            'action' => 'authenticate'
        );
		$this->_set_admin_template();
	}

	protected function authenticate()
	{
		if ($this->sentry->check())
		{
			$this->_group();
			if ($this->current_user->inGroup($this->group)) return true;
		}
		$this->_login_first();
	}

	protected function _group()
	{
		if (!$this->group instanceof Group)
		{
			try
			{
			    $this->group = $this->sentry->findGroupByName('admin');
			}
			catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
			{
			    show_404();
			}
		}
	}

	protected function _login_first()
	{
		$this->session->set_flashdata('error', 'You must login first.');
		redirect($this->login_url);
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

class Authentication_Controller extends Base_Controller implements AuthenticationInterface{
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