@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="text-center">Clientes</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="search" name="search" placeholder="Buscar..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#newModal">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</div>
	@include('clientes.partials.table')
	@include('clientes.modalnew')
</div>
@endsection

@section('footer')
<script>
	function deleteCliente(id) {
		if (confirm('Desea eliminar el elemento?')) {
			$('#delete-'+id).submit();
		}else {
			alert('No pasa nada');
		}
	}
</script>
@endsection