<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Login extends Controller {

	public function action_index() {
		$this->response->body(View::factory('auth/login'));
	}
}