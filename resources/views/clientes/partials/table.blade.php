<table class="table table-striped table-hover ">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre y Apellido</th>
			<th>Doc. Identidad</th>
			<th>Telf.</th>
			<th>Correo</th>
			<th>Direccion</th>
			<th>Operaciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($clientes as $cliente)
		<tr>
			<td>{{ $cliente->id }}</td>
			<td>{{ $cliente->nombre ." ". $cliente->apellido }}</td>
			<td>{{ $cliente->doc }}</td>
			<td>{{ $cliente->telefono }}</td>
			<td>{{ $cliente->correo }}</td>
			<td>{{ $cliente->direccion }}</td>
			<td>
				<button class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{$cliente->id}}"><span class="glyphicon glyphicon-edit"></span></button>
				<button class="btn btn-danger" onclick="deleteCliente({{$cliente->id}},this)"><span class="glyphicon glyphicon-trash"></span></button>
				<form id="delete-{{ $cliente->id }}" method="POST" action="{{ route('clientes.delete',['cliente' => $cliente->id]) }}">
					{{ csrf_field() }}
          			{{ method_field('delete') }}
				</form>
				@include('clientes.modaledit')
			</td>
		</tr>
		@endforeach
	</tbody>
</table>