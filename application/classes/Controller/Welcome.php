<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_PV {

	public function action_index() {
		$this->template->body = View::factory('welcome');
		$this->template->body->titulo2 = 'teste';
	}
	
	public function action_get_index() {
		$arrTeste = array(
			'response' => 'oi'
		);
		
		echo json_encode($arrTeste);
	}
}