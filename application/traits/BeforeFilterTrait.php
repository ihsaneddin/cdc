<?php

trait BeforeFilterTrait {

	protected $before_filter   = array();
    protected $after_filter    = array();

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