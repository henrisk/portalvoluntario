<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Template {

	public $template = 'template/site';
	
	public function action_index() {
		$this->template->body = View::factory('welcome');
	}
}