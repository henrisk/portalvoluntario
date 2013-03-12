<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth_Login extends Controller {

	/**
	 * Principal view da página
	 * @var VIEW
	 */
	private $view = null;
	
	/**
	 * Método de acesso a página
	 */
	public function action_index() {
		$this->view = View::factory('auth/login');
		$this->loadConfig();
		
		$this->response->body($this->view);
	}
	
	/**
	 * Carrega as configurações principais para a aplicação considerando que apenas essa página pode ser acessada sem autenticação
	 */
	private function loadConfig() {
		$config = Kohana::$config->load('default.application');
		$this->view->title = $config['title'];
		$this->view->action = URL::site('auth_login/authenticate');
	}
	
	/**
	 * Realiza a lógica de autenticação, permitindo/barrando o acesso do usuário ao restante do sistema
	 */
	public function action_authenticate() {
		//Implementar lógica de autenticação
		$this->redirect('Auth_Login', 302);
	}
}