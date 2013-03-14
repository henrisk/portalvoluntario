<?php defined('SYSPATH') or die('No direct script access.');
Class Model_User extends Model_Abstract {
	
	protected function getTable() {
		return 'User';
	}
	
	public function authenticate($strLogin, $strPassword) {
		$strSQL = '
			SELECT
				u.id,
				u.login
			FROM
				' . $this->getTable() . ' u
			WHERE
				u.login = ' . $this->_db->escape($strLogin) . '
				AND u.password = md5(' . $this->_db->escape($strPassword) . ')				
		';
		
		return $this->_db->query(Database::SELECT, $strSQL, true)->as_array();
	}
}