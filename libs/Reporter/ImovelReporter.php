<?php
/** @package    Imoveis::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the Imovel object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package Imoveis::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ImovelReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `imovel` table
	public $CustomFieldExample;

	public $Id;
	public $Titulo;
	public $Descricao;
	public $DataDisponibilidade;
	public $Imagem;
	public $Valor;
	public $EmailContato;
	public $TelefoneContato;
	public $TipoImovelId;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`imovel`.`id` as Id
			,`imovel`.`titulo` as Titulo
			,`imovel`.`descricao` as Descricao
			,`imovel`.`data_disponibilidade` as DataDisponibilidade
			,`imovel`.`imagem` as Imagem
			,`imovel`.`valor` as Valor
			,`imovel`.`email_contato` as EmailContato
			,`imovel`.`telefone_contato` as TelefoneContato
			,`imovel`.`tipo_imovel_id` as TipoImovelId
		from `imovel`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `imovel`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>