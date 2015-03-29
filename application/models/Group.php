<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Group extends Eloquent{

 	public $table = "groups";


}