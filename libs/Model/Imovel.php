<?php
/** @package    Imoveis::Model */

/** import supporting libraries */
require_once("DAO/ImovelDAO.php");
require_once("ImovelCriteria.php");

/**
 * The Imovel class extends ImovelDAO which provides the access
 * to the datastore.
 *
 * @package Imoveis::Model
 * @author ClassBuilder
 * @version 1.0
 */
class Imovel extends ImovelDAO
{

	/**
	 * Override default validation
	 * @see Phreezable::Validate()
	 */
	public function Validate()
	{
		// example of custom validation
		// $this->ResetValidationErrors();
		// $errors = $this->GetValidationErrors();
		// if ($error == true) $this->AddValidationError('FieldName', 'Error Information');
		// return !$this->HasValidationErrors();

		return parent::Validate();
	}

	/**
	 * @see Phreezable::OnSave()
	 */
	public function OnSave($insert)
	{
		// the controller create/update methods validate before saving.  this will be a
		// redundant validation check, however it will ensure data integrity at the model
		// level based on validation rules.  comment this line out if this is not desired
		if (!$this->Validate()) throw new Exception('Unable to Save Imovel: ' .  implode(', ', $this->GetValidationErrors()));

		// OnSave must return true or Phreeze will cancel the save operation
		return true;
	}

}

?>
