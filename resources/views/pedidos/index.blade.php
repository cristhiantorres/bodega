@extends('layouts.app')

@section('content')
<div class="container" id="pedidos">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="text-center">Pedidos</h3>
		</div>
		<div class="panel-body">
			<div class="col-md-6">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" v-model="searchString" id="search" name="search" placeholder="Buscar..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<a href=" {{ route('pedidos.new')}} " type="button" class="btn btn-success pull-right">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</div>
	@include('pedidos.partials.table')
</div>
@endsection
@section('footer')
<script src='{{ asset('js/pedidos.js') }}'></script>
@endsection
