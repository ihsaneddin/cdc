<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

    public function index()
    {
    	//dump($this);
    	//die();
    	$this->load->section('content', 'admin/home/index');
    }
}
