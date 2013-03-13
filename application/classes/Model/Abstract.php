<?php defined('SYSPATH') or die('No direct script access.');
Abstract Class Model_Abstract extends Model_Database {
	
	protected abstract function getTableName();
	
	public function getList($arrWhere = array()) {
	
	}
	
	public function add($arrData) {
	
	}
	
	public function del($arrWhere) {
	
	}
	
	public function alter($arrWhere, $arrData) {
	
	}
	
	public function getCurrent($arrWhere) {
	
	}
}