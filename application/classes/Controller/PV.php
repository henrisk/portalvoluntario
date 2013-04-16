<?php defined('SYSPATH') or die('No direct script access.');

class Controller_PV extends Controller_Template {

	public $template = 'template/site';

	public function before() {
		parent::before();
		$this->loadConfig();
		$this->validateUser();
	}
	
	private function validateUser() {
		$session = Session::instance();
		$user = $session->get('user', null);
		if($user == null)
			$this->redirect('Auth_Login', 302);
	}
	
	private function loadConfig() {
		$req = $this->request;
		if(Helper_App::isMobile($req::$user_agent))
			$this->template = View::factory('template/mobile');
		else {
			$appConfig = Kohana::$config->load('default.application');
			$this->template->title = $appConfig['title'];
		}
	}
	
	
}
