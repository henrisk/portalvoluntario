<?php defined('SYSPATH') or die('No direct script access.');
Class Model_User extends Model_Database {
	
	public function authenticate($strLogin, $strPassword) {
		$strSQL = '
			SELECT
				u.id,
				u.name,
				u.login
			FROM
				user u
			WHERE
				u.login = ' . $this->_db->escape($strLogin) . '
				AND u.password = md5(' . $this->_db->escape($strPassword) . ')				
		';
		
		return $this->_db->query(Database::SELECT, $strSQL, true)->as_array();
	}
}