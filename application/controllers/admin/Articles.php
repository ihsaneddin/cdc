<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use traits\ArticlesControllerTrait;

class Articles extends Admin_Controller {
    use ArticlesControllerTrait;

    protected $resource_model = 'Article';
}
