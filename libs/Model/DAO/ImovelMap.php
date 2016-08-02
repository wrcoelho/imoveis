<?php
/** @package    Imoveis::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ImovelMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ImovelDAO to the imovel datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Imoveis::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ImovelMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","imovel","id",true,FM_TYPE_INT,11,null,true,false);
			self::$FM["Titulo"] = new FieldMap("Titulo","imovel","titulo",false,FM_TYPE_VARCHAR,45,null,false,true);
			self::$FM["Descricao"] = new FieldMap("Descricao","imovel","descricao",false,FM_TYPE_VARCHAR,255,null,false,true);
			self::$FM["DataDisponibilidade"] = new FieldMap("DataDisponibilidade","imovel","data_disponibilidade",false,FM_TYPE_DATETIME,null,null,false,true);
			self::$FM["Imagem"] = new FieldMap("Imagem","imovel","imagem",false,FM_TYPE_LONGTEXT,null,null,false,false);
			self::$FM["Valor"] = new FieldMap("Valor","imovel","valor",false,FM_TYPE_DECIMAL,19.2,null,false,true);
			self::$FM["EmailContato"] = new FieldMap("EmailContato","imovel","email_contato",false,FM_TYPE_VARCHAR,255,null,false,true);
			self::$FM["TelefoneContato"] = new FieldMap("TelefoneContato","imovel","telefone_contato",false,FM_TYPE_INT,11,null,false,true);
			self::$FM["TipoImovelId"] = new FieldMap("TipoImovelId","imovel","tipo_imovel_id",false,FM_TYPE_INT,11,null,false,true);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["fk_imovel_tipo_imovel1"] = new KeyMap("fk_imovel_tipo_imovel1", "TipoImovelId", "TipoImovel", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>