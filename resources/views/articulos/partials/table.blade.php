<table v-if="articulos && articulos.length" class="table table-striped table-hover " id="lista">
	<thead>
		<tr>
			<th>#</th>
			<th>Tipo de Articulo</th>
			<th>Articulo</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
		<tr v-for="(articulo,index) in articulos">
			<td>@{{ articulo.id }} </td>
			<td>@{{ articulo.tipo_articulo }}</td>
      <td>@{{ articulo.descripcion }}</td>
			<td>@{{ articulo.precio }}</td>
			{{-- <td>
				<button class="btn btn-danger" v-on:click="removeCliente(index,cliente.id)" ><span class="glyphicon glyphicon-trash"></span></button>
				<button class="btn btn-primary" data-toggle="modal" @click="showModal(cliente.id,index)"><span class="glyphicon glyphicon-pencil"></span></button>
			</td> --}}
		</tr>
	</tbody>
</table>
{{-- @include('articulos.modaledit') --}}
<center v-if="articulos.length < 1">@{{ msg }} </center>
<nav aria-label="...">
	<ul class="pager">
		<li :class="previous != null ? 'previous' : 'previous disabled' " ><a :style="previous != null ? '' : 'pointer-events: none' " @click="previous_page" ><span aria-hidden="true">&larr;</span>Anterior</a></li>
		<li :class="next != null ? 'next' : 'next disabled' "><a :style="next != null ? '' : 'pointer-events: none'" @click="next_page">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
	</ul>
</nav>
