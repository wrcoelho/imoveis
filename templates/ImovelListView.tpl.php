<?php
	$this->assign('title','Imoveis | Imovels');
	$this->assign('nav','imovels');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("scripts/app/imovels.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Imovels
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Buscar..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="imovelCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Titulo">Titulo<% if (page.orderBy == 'Titulo') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Descricao">Descricao<% if (page.orderBy == 'Descricao') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_DataDisponibilidade">Data Disponibilidade<% if (page.orderBy == 'DataDisponibilidade') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Imagem">Imagem<% if (page.orderBy == 'Imagem') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Valor">Valor<% if (page.orderBy == 'Valor') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_EmailContato">Email Contato<% if (page.orderBy == 'EmailContato') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_TelefoneContato">Telefone Contato<% if (page.orderBy == 'TelefoneContato') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_TipoImovelId">Tipo Imovel Id<% if (page.orderBy == 'TipoImovelId') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('titulo') || '') %></td>
				<td><%= _.escape(item.get('descricao') || '') %></td>
				<td><%if (item.get('dataDisponibilidade')) { %><%= _date(app.parseDate(item.get('dataDisponibilidade'))).format('MMM D, YYYY h:mm A') %><% } else { %>NULL<% } %></td>
				<td><%= _.escape(item.get('imagem') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('valor') || '') %></td>
				<td><%= _.escape(item.get('emailContato') || '') %></td>
				<td><%= _.escape(item.get('telefoneContato') || '') %></td>
				<td><%= _.escape(item.get('tipoImovelId') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="imovelModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="tituloInputContainer" class="control-group">
					<label class="control-label" for="titulo">Titulo</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="titulo" placeholder="Titulo" value="<%= _.escape(item.get('titulo') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="descricaoInputContainer" class="control-group">
					<label class="control-label" for="descricao">Descricao</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="descricao" placeholder="Descricao" value="<%= _.escape(item.get('descricao') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="dataDisponibilidadeInputContainer" class="control-group">
					<label class="control-label" for="dataDisponibilidade">Data Disponibilidade</label>
					<div class="controls inline-inputs">
						<div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
							<input id="dataDisponibilidade" type="text" value="<%= _date(app.parseDate(item.get('dataDisponibilidade'))).format('YYYY-MM-DD') %>" />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<div class="input-append bootstrap-timepicker-component">
							<input id="dataDisponibilidade-time" type="text" class="timepicker-default input-small" value="<%= _date(app.parseDate(item.get('dataDisponibilidade'))).format('h:mm A') %>" />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="imagemInputContainer" class="control-group">
					<label class="control-label" for="imagem">Imagem</label>
					<div class="controls inline-inputs">
						<textarea class="input-xlarge" id="imagem" rows="3"><%= _.escape(item.get('imagem') || '') %></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="valorInputContainer" class="control-group">
					<label class="control-label" for="valor">Valor</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="valor" placeholder="Valor" value="<%= _.escape(item.get('valor') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="emailContatoInputContainer" class="control-group">
					<label class="control-label" for="emailContato">Email Contato</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="emailContato" placeholder="Email Contato" value="<%= _.escape(item.get('emailContato') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="telefoneContatoInputContainer" class="control-group">
					<label class="control-label" for="telefoneContato">Telefone Contato</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="telefoneContato" placeholder="Telefone Contato" value="<%= _.escape(item.get('telefoneContato') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="tipoImovelIdInputContainer" class="control-group">
					<label class="control-label" for="tipoImovelId">Tipo Imovel Id</label>
					<div class="controls inline-inputs">
						<select id="tipoImovelId" name="tipoImovelId"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteImovelButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteImovelButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Remover Imovel</button>
						<span id="confirmDeleteImovelContainer" class="hide">
							<button id="cancelDeleteImovelButton" class="btn btn-mini">Cancelar</button>
							<button id="confirmDeleteImovelButton" class="btn btn-mini btn-danger">Confirmar</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="imovelDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Editar Imovel
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="imovelModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveImovelButton" class="btn btn-primary">Salvar Altera&ccedil;&otilde;es</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="imovelCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newImovelButton" class="btn btn-primary">Adicionar Imovel</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
