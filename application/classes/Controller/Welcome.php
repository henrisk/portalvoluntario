<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_PV {

	public function action_index() {
		$this->template->body = View::factory('welcome');
	}
}