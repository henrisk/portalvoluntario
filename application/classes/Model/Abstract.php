<?php defined('SYSPATH') or die('No direct script access.');
Abstract Class Model_Abstract extends Model_Database {
	
	/**
	 * Armazena as chaves primárias na execução
	 *
	 * @var array
	 */
	protected static $arrID = array();

	/**
	 * Armazena as colunas obtidas na execução
	 *
	 * @var array
	 */
	protected static $arrColumns = array();

	/**
	 * Obtem o nome da tabela a partir do model
	 */
	protected abstract function getTable();

	/**
	 * Obtem a(s) chave(s) primária(s) de uma tabela a partir do model
	 *
	 * @return array
	 */
	public function getId() {
		$strClass = get_called_class();
		if(!isset(self::$arrID[$strClass])) {
			self::$arrID[$strClass] = array();
			$objResult = $this->_db->query(Database::SELECT, 'SHOW INDEX FROM ' . static::getTable(), true);
			if($objResult->count())
				foreach($objResult as $objRow)
					if($objRow->Key_name == 'PRIMARY')
						self::$arrID[$strClass][] = $objRow->Column_name;
		}
		
		return self::$arrID[$strClass];
	}

	/**
	 * Obtem as colunas de uma tabela a partir do model
	 *
	 * @return array
	 */
	public function getColumns() {
		$strClass = get_called_class();
		if(!isset(self::$arrColumns[$strClass])) {
			self::$arrColumns[$strClass] = array();
			$objResult = $this->_db->query('DESC ' . static::getTable());
			if($objResult->count())
				foreach($objResult as $objRow)
					self::$arrColumns[$strClass][] = $objRow->Field;
		}
		
		return self::$arrColumns[$strClass];
	}

	/**
	 * Monta query where com as chaves primárias da tabela.
	 *
	 * @param array		Matriz de valores das chaves
	 * @return string	Cláusula where das chaves primárias
	 */
	protected function buildSQLId(array $arrId) {
		$arrCamposId = $this->getId();
		$arrCamposIdNew = array();
		foreach($arrCamposId as $intIndice => $strCampo) {
			$strValor = null;
			if(isset($arrId[$strCampo]))
				$strValor = $arrId[$strCampo];
			elseif(isset($arrId[$intIndice]))
				$strValor = $arrId[$intIndice];
			if($strValor !== null)
				$arrCamposIdNew[$strCampo] = $strValor;
			else
				$arrCamposIdNew[$strCampo] = 'IS NULL';
		}

		$strSQL = $strSep = '';
		foreach($arrCamposIdNew as $strCampo => $strValor) {
			if($strValor === 'IS NULL') {
				$strValor = 'IS NULL';
				$strSQL .= $strSep.' '.$strCampo.' '.$strValor.' ';
			} else {
				$strValor = $this->_db->escape($strValor);
				$strSQL .= $strSep.' '.$strCampo.' = '.$strValor.' ';
			}
			$strSep = 'AND ';
		}
		
		return $strSQL;
	}

	/**
	 * Retorna uma linha da tabela conforme chave primária passada
	 * Caso não encontrar o registro, retorna false
	 *
	 * @param array|integer		Valor(es) da chave primária, se for chave primária composta, é necessário enviar array de valores
	 * @return stdClass
	 */
	public function get($arrId) {
		if(!is_array($arrId))
			$arrId = array($arrId);
		
		$arrResult = $this->loadList($this->buildSQLId($arrId));
		return $arrResult[0];
	}

	/**
	 * Número de linhas retornadas pela query
	 *
	 * @param array|string	Cláusula where (opcional)
	 * @param string		Cláusula from (opcional)
	 * @param array|string	Cláusula join (opcional)
	 * @return integer		Total de linhas retornadas
	 */
	public function count($arrWhere = '', $strFrom = '', $arrJoin = '') {
		if($strFrom == '')
			$strFrom = $this->getTable();
		
		if(is_array($arrJoin))
			$strJoin = 'JOIN ' . $arrJoin[0] . ' ON ' . $arrJoin[1];
		else
			$strJoin = '';

		if(!is_array($arrWhere))
			$arrWhere = array($arrWhere);
		
		$strWhere = implode(' AND ', $arrWhere);
		if($strWhere == '')
			$strWhere = '1 = 1';

		$strSQL = 'SELECT COUNT(*) TOTAL FROM ' . $strFrom . ' ' . $strJoin . ' WHERE ' . $strWhere;
		return $this->_db->query($strSQL)->current()->TOTAL;
	}

	/**
	 * Monta array dos registros da tabela conforme a query.
	 *
	 * @param string			Cláusula where da query
	 * @param array				Lista de campos
	 * @param string			Cláusula from
	 * @param string			Cláusula order by
	 * @param string			Cláusula limit
	 * @param array|string		Tabelas relacionadas
	 * @return Database_Result	Resource do resultado da query
	 */
	public function loadList($arrWhere, array $arrCampos = array(), $strFrom = '', $arrOrderBy = '', $strLimit = '', $arrJoin = '') {
		if($strFrom == '')
			$strFrom = $this->getTable();

		$strJoin = '';
		if(is_array($arrJoin)) {
			if(is_string($arrJoin[0]) && is_string($arrJoin[1]))
				$strJoin .= (isset($arrJoin[2])? $arrJoin[2] : '') . ' JOIN ' . $arrJoin[0] . ' ON '.$arrJoin[1];
			else {
				foreach($arrJoin as $arrPartesJoin)
					$strJoin .= (isset($arrPartesJoin[2]) ? ' ' . $arrPartesJoin[2] : '') . ' JOIN ' . $arrPartesJoin[0] . ' ON ' . $arrPartesJoin[1];
			}
		}

		$strCampos = implode(', ', $arrCampos);
		if($strCampos == '')
			$strCampos = '*';

		if(!is_array($arrWhere))
			$arrWhere = array($arrWhere);
		
		$strWhere = implode(' AND ', $arrWhere);
		if($strWhere == '')
			$strWhere = '1 = 1';

		if(!is_array($arrOrderBy))
			$arrOrderBy = array($arrOrderBy);
		
		$strOrderBy = implode(', ', $arrOrderBy);
		if($strOrderBy == '')
			$strOrderBy = '1';

		if($strLimit != '')
			$strLimit = 'LIMIT ' . $strLimit;

		$strSQL = '
			SELECT
				' . $strCampos . '
			FROM
				' . $strFrom . '
			' . $strJoin . '
			WHERE
				' . $strWhere . '
			ORDER BY
				' . $strOrderBy . '
			' . $strLimit;
		
		return $this->_db->query(Database::SELECT, $strSQL, true)->as_array();
	}

	/**
	 * Insere novo registro na tabela.
	 *
	 * @param array|stdClass	Matriz de campos (keys) e valores
	 * @return Database_Result	Status da operaçao
	 */
	public function insert($arrValues) {
		if(!(is_a($arrValues, 'stdClass') || is_array($arrValues)))
			throw new Kohana_User_Exception('Model_Abstract->insert('.$arrValues.')', 'deve ser StdClass ou Array!');

		if(is_a($arrValues, 'stdClass'))
			$arrValues = Helper_Convert::objectToArray($arrValues);
		
		$strSQL = '
			INSERT INTO 
				' . $this->getTable() .
				Helper_Convert::arrayToSQL($arrValues, Helper_Convert::INSERT)
		;

		return $this->_db->query(Database::INSERT, $strSQL);
	}

	/**
	 * Retorna id do último registro inserido
	 *
	 * @param Database_Result	Resource retornado pelo método insert()
	 * @return integer 			Id do último registro inserido
	 */
	public function insertId(Database_Result $objResource) {
		return $objResource->insert_id();
	}

	/**
	 * Retorna um objeto padrão do model.
	 *
	 * @param string|integer	Valor Default
	 * @return stdClass
	 */
	public function getModel($mixDefault = null) {
		$objStd = new StdClass;
		foreach($this->getColumns() as $strColumn)
			$objStd->$strColumn = $mixDefault;
		
		return $objStd;
	}

	/**
	 * Atualiza registro na tabela
	 *
	 * @param array|stdClass	Matriz de campos com chaves e valores
	 * @return Database_Result	Objeto	status da operaçao
	 */
	public function update($arrValues) {
		if(!(is_a($arrValues, 'stdClass') || is_array($arrValues)))
			throw new Kohana_User_Exception('Model_Abstract->update('.$arrValues.')', 'deve ser StdClass ou Array!');

		if(is_a($arrValues, 'stdClass'))
			$arrValues = Helper_Convert::objectToArray($arrValues);

		$arrWhere = array();
		foreach($this->getId() as $strFieldName) {
			$strFieldValue = '';
			if(isset($arrValues[$strFieldName])) {
				$strFieldValue = $arrValues[$strFieldName];
				unset($arrValues[$strFieldName]); // retira campo PK do array
			}
			$arrWhere[$strFieldName] = $strFieldValue;
		}

		$strSQL = '
				UPDATE 
					'. $this->getTable() . ' 
				SET 
					' . Helper_Convert::arrayToSQL($arrValues, Helper_Convert::UPDATE) . '
				WHERE 
					' . Helper_Convert::arrayToSQL($arrWhere, Helper_Convert::WHERE) 
		;
		
		return $this->_db->query(Database::UPDATE, $strSQL);
	}

	/**
	 * Remove registro da tabela.
	 *
	 * Ex.
	 * <code>
	 * Ex de $arrID
	 *
	 *	$arrID = array(
	 *		'field_name' => 'field_value',
	 *		'field_name' => 'field_value'
	 *	)
	 * </code>
	 *
	 * @param string|array|stdClass	Chave primária do(s) registro(s) a remover
	 * @return Database_Result		Status da operaçao
	 */
	public function delete($arrId) {
		if(is_a($arrId, 'stdClass'))
		$arrId = Helper_Convert::objectToArray($arrId);

		if(!is_array($arrId))
			$arrId = array($arrId);
		
		$strWhere = $this->buildSQLId($arrId);
		
		$strSQL = '
			DELETE FROM 
				' . $this->getTable() . '
			WHERE
				' . $strWhere;

		return $this->_db->query(Database::DELETE, $strSQL);
	}

	/**
	 * Retorna a última query executada
	 *
	 * @return	string
	 */
	public function getSQL() {
		return $this->_db->last_query;
	}

	/**
	 * Escapes any input value.
	 *
	 * @param string|integer Value to escape
	 * @return string
	 */
	public function escape($mixValue) {
		return $this->_db->escape($mixValue);
	}
}