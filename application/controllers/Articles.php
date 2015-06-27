<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use traits\ArticlesControllerTrait;

class Articles extends User_Controller {
    use ArticlesControllerTrait;

    protected $resource_model = 'Article';
    protected $use_slug = true;

    public function delete($id)
    {
        show_404();
    }
}
