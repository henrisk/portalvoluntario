<?php defined('SYSPATH') or die('No direct script access.');

class Controller_SYS_Profile extends Controller_PV {

	public function action_index() {
		$this->template->body = View::factory('sys/profile/list');
		
		$modelProfile = Model::factory('Profile');
		$this->template->body->arrData = $modelProfile->loadList(array());
	}

	public function action_add() {
		$this->action_merge();
	}
	
	public function action_merge() {
		$this->template->body = View::factory('sys/profile/merge');
		$this->template->body->action = 'SYS_Profile/save';
		
		$id = $this->request->param('id', null);
		if($id != null) {
			$modelProfile = Model::factory('Profile');
			$this->template->body->objData = $modelProfile->get($id);
		}
	}
	
	public function action_save() {
		$objData = new stdClass();
		$objData->id = $this->request->post('hddId');
		$objData->name = $this->request->post('txtName');
		$objData->description = $this->request->post('txtDescription');
		$objData->appKey = $this->request->post('txtKey');
		
		$modelProfile = Model::factory('Profile');
		if($objData->id == null) {
			unset($objData->id);
			$modelProfile->insert($objData);
		}
		else
			$modelProfile->update($objData);
		
		$this->redirect('SYS_Profile');
	}
	
	public function action_del() {
		$id = $this->request->param('id', null);
		if($id != null) {
			$modelProfile = Model::factory('Profile');
			$modelProfile->delete($id);
		}
		
		$this->redirect('SYS_Profile');
	}
}