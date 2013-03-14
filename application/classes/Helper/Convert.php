<?php defined('SYSPATH') or die('No direct script access.');

Class Helper_Convert {
	
	// constantes do método convert::arrayToSQL()
	const WHERE  = 1;
	const SELECT = 2;
	const INSERT = 3;
	const UPDATE = 4;
	const MATRIZ = 5;
	
	/**
	 * Converte pares de um array em strings para uso em clausulas SQL.
	 *
	 * @param array				Array com os pares
	 * @param integer				Formato desejado:
	 * 								WHERE:	chave1 = 'valor1' AND chave2 = 'valor2' AND ... AND chaveN = 'valorN'
	 * 											OBS: permite usar os operadores: > < = !, IS NULL, IS NOT NULL, LIKE e BETWEEN nos valores.
	 * 											Se o valor for um array, será convertido para "chave IN (valor1, valor2, ..., valorN)".
	 * 											(para NOT IN adicione ' NOT' na chave desejada, ex: 'COD_AREA NOT', 'COD_UNNEGOCIO NOT').
	 * 								SELECT:	'valor1', 'valor2', ..., 'valorN' (ignora as chaves do array original)
	 * 								INSERT:	(chave1, chave2, ..., chaveN) VALUES ('valor1', 'valor2', ..., 'valorN')
	 * 								UPDATE:	chave1 = 'valor1', chave2 = 'valor2', ..., chaveN = 'valorN'
	 * 								MATRIZ:	array('keys'	=> "'chave1', 'chave2', ..., 'chaveN'",
	 * 													'values'	=> "'valor1', 'valor2', ..., 'valorN'")
	 * @param string				Alias da tabela a ser anexado aos campos (opcional)
	 * @param string				Separador usado entre os pares no formato WHERE (AND ou OR)
	 * @return string|array		String SQL ou array
	 */
	public static function arrayToSQL(array $arrPares, $intFormato = self::WHERE, $strAlias = '', $strSeparador = 'AND') {
		$strRet = $strRet2 = '';
		if($strAlias)
			$strAlias .= '.';

		switch($intFormato) {
			case self::WHERE: // converte o array para uso em uma cláusula WHERE
				foreach($arrPares as $mixKey => $mixValue) {
					if(is_object($mixValue)) // somente valores escalares e arrays
						continue;
					if($strRet)
						$strRet .= ' '.$strSeparador.' ';
					if(is_array($mixValue)) {
						$strOperador = 'IN';
						$strValor = ' (';
						$strCola = '';
						foreach($mixValue as $strValue) {
							if(!preg_match('!^@!', $strValue)) // não escapa variaveis
								$strValor .= $strCola.Database::instance()->escape($strValue);
							else
								$strValor .= $strCola.$strValue;
							$strCola = ', ';
						}
						$strValor .= ') ';
					} else {
						$strOperador = '=';
						if(preg_match('!^NULL$!i', $mixValue))
							$mixValue = 'IS NULL';
						$strValor = $mixValue;
						preg_match('/^([<>!=]+|IS NULL|IS NOT NULL|LIKE|BETWEEN)(.*)$/i', $mixValue, $arrMatches);
						if(isset($arrMatches[1]))
							$strOperador = trim($arrMatches[1]);
						if(isset($arrMatches[2]))
							$strValor = trim($arrMatches[2]);
						if(!preg_match('!^@!', $strValor) && $strValor && !preg_match('!BETWEEN!i', $strOperador))
							$strValor = Database::instance()->escape($strValor);
					}
					$strRet .= $strAlias.$mixKey.' '.$strOperador.' '.$strValor;
				}
				return $strRet;
				break;

			case self::SELECT: // converte o array para uso em uma cláusula SELECT, GROUP BY ou ORDER BY
				foreach($arrPares as $mixKey => $mixValue) {
					if(is_array($mixValue) || is_object($mixValue)) // somente valores escalares
						continue;
					if($strRet)
						$strRet .= ', ';
					$strRet .= $strAlias.'`'.$mixValue.'`';
				}
				return $strRet;
				break;

			case self::INSERT: // converte o array para uso em uma cláusula INSERT
				foreach($arrPares as $mixKey => $mixValue) {
					if(is_array($mixValue) || is_object($mixValue)) // somente valores escalares
						continue;
					if($strRet)
						$strRet .= ', ';
					if($strRet2)
						$strRet2 .= ', ';
					$strRet .= ($strRet == '')? '('.$strAlias.$mixKey : $strAlias.$mixKey;
					if(!preg_match('!(^@|^NULL$)!', $mixValue)) // não escapa variaveis e nulos
						$strRet2 .= Database::instance()->escape($mixValue);
					else
						$strRet2 .= $mixValue;
				}
				return $strRet.') VALUES ('.$strRet2.')';
				break;

			case self::UPDATE: // converte o array para uso em uma cláusula UPDATE
				foreach($arrPares as $mixKey => $mixValue) {
					if(is_array($mixValue) || is_object($mixValue)) // somente valores escalares
						continue;
					if($strRet)
						$strRet .= ', ';
					if(!preg_match('!(^@|^NULL$)!', $mixValue)) // não escapa variaveis e nulos
						$strValor = Database::instance()->escape($mixValue);
					else
						$strValor = $mixValue;
					$strRet .= $strAlias.$mixKey.' = '.$strValor;
				}
				return $strRet;
				break;

			case self::MATRIZ: // converte o array em uma matriz com uma string de chaves e outra de valores
				foreach($arrPares as $mixKey => $mixValue) {
					if(is_array($mixValue) || is_object($mixValue)) // somente valores escalares
						continue;
					if($strRet)
						$strRet .= ', ';
					if($strRet2)
						$strRet2 .= ', ';
					$strRet .= $strAlias.'`'.$mixKey.'`';
					if(!preg_match('!(^@|^NULL$)!', $mixValue)) // não escapa variaveis e nulos
						$strRet2 .= Database::instance()->escape($mixValue);
					else
						$strRet2 .= $mixValue;
				}
				return array('keys' => $strRet, 'values' => $strRet2);
				break;

			default:
				throw new Kohana_User_Exception('convert::arrayToSQL()', 'Formato "'.$intFormato.'" não suportado');
		}
	}
	
	/**
	 * Converte uma variável do tipo stdClass para o tipo Array
	 * Se receber uma variável de tipo diferente de stdClass, retorna a própria variável
	 *
	 * @param stdClass|stdClass		Objeto que será convertido
	 * @return array
	 */
	public static function objectToArray($objIn) {
		if(!is_a($objIn, 'stdClass'))
			return $objIn;
	
		foreach($objIn as $strKey => $mixValue)
			$arrOut[$strKey] = self::objectToArray($mixValue);
	
		return $arrOut;
	}
}