<?php
/** @package    Imoveis::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Imovel.php");

/**
 * ImovelController is the controller class for the Imovel object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package Imoveis::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ImovelController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();
		
		/**
		 * Informe o tipo de permissao
		 */
		$this->RequirePermission(User::$PERMISSION_READ, 
			'Secure.LoginForm', 
			'Login requerido para acessar esta pagina',
			'Permissao de leitura e obrigatoria');
	}

	/**
	 * Displays a list view of Imovel objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Imovel records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new ImovelCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Titulo,Descricao,DataDisponibilidade,Imagem,Valor,EmailContato,TelefoneContato,TipoImovelId'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$imovels = $this->Phreezer->Query('Imovel',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $imovels->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $imovels->TotalResults;
				$output->totalPages = $imovels->TotalPages;
				$output->pageSize = $imovels->PageSize;
				$output->currentPage = $imovels->CurrentPage;
			}
			else
			{
				// return all results
				$imovels = $this->Phreezer->Query('Imovel',$criteria);
				$output->rows = $imovels->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Imovel record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$imovel = $this->Phreezer->Get('Imovel',$pk);
			$this->RenderJSON($imovel, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Imovel record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$imovel = new Imovel($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $imovel->Id = $this->SafeGetVal($json, 'id');

			$imovel->Titulo = $this->SafeGetVal($json, 'titulo');
			$imovel->Descricao = $this->SafeGetVal($json, 'descricao');
			$imovel->DataDisponibilidade = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDisponibilidade')));
			$imovel->Imagem = $this->SafeGetVal($json, 'imagem');
			$imovel->Valor = $this->SafeGetVal($json, 'valor');
			$imovel->EmailContato = $this->SafeGetVal($json, 'emailContato');
			$imovel->TelefoneContato = $this->SafeGetVal($json, 'telefoneContato');
			$imovel->TipoImovelId = $this->SafeGetVal($json, 'tipoImovelId');

			$imovel->Validate();
			$errors = $imovel->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$imovel->Save();
				$this->RenderJSON($imovel, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Imovel record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('id');
			$imovel = $this->Phreezer->Get('Imovel',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $imovel->Id = $this->SafeGetVal($json, 'id', $imovel->Id);

			$imovel->Titulo = $this->SafeGetVal($json, 'titulo', $imovel->Titulo);
			$imovel->Descricao = $this->SafeGetVal($json, 'descricao', $imovel->Descricao);
			$imovel->DataDisponibilidade = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dataDisponibilidade', $imovel->DataDisponibilidade)));
			$imovel->Imagem = $this->SafeGetVal($json, 'imagem', $imovel->Imagem);
			$imovel->Valor = $this->SafeGetVal($json, 'valor', $imovel->Valor);
			$imovel->EmailContato = $this->SafeGetVal($json, 'emailContato', $imovel->EmailContato);
			$imovel->TelefoneContato = $this->SafeGetVal($json, 'telefoneContato', $imovel->TelefoneContato);
			$imovel->TipoImovelId = $this->SafeGetVal($json, 'tipoImovelId', $imovel->TipoImovelId);

			$imovel->Validate();
			$errors = $imovel->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Por Favor, verifique os erros',$errors);
			}
			else
			{
				$imovel->Save();
				$this->RenderJSON($imovel, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Imovel record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$imovel = $this->Phreezer->Get('Imovel',$pk);

			$imovel->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
