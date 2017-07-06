@extends('layouts.app')

@section('content')
<div class="container" id="pedidos_new">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="text-center">Pedidos</h3>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="form-inline">
          <div class="input-group">
            <label>Nro de documento</label>
            <multiselect v-model="vlcabecera" :options="clientes" select-label="Enter" :custom-label="cliente_doc" placeholder="Selecciona una opcion" label="doc" track-by="doc"></multiselect>
          </div>
          <div class="input-group">
            <label>Razon social</label>
            <input type="text" disabled v-model="vlcabecera.nombre" class="form-control">
          </div>
        </div>
      </div>
      <div class="col-md-6">

        <div class="row">
          <div class="col-md-6">
            <label>Articulo</label>
            <multiselect v-model="vldetalles" :options="articulos" select-label="Enter" :custom-label="articulo_name" placeholder="Selecciona una opcion" label="descripcion" track-by="descripcion"></multiselect>
          </div>
          <div class="col-md-2">
            <label>Precio</label>
            <input type="text" disabled v-model="vldetalles.precio" class="form-control">
          </div>
          <div class="col-md-2">
            <label>Cantidad</label>
            <input type="number" class="form-control" v-model="vldetalles.cantidad">
          </div>
          <div class="col-md-2">
            <button @click="addDetalles" id="btn-articulo" type="button" class="btn btn-success" :disabled="vldetalles.precio ? false : true ">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <button class="btn btn-success" @click="addPedido">Realizar pedido</button>
  <table class="table table-striped table-hover " id="lista">
    <thead>
      <tr>
        <th>Articulo</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody v-if="detalles && detalles.length">
      <tr v-for="(item,index) in detalles">
        <td>@{{ item.descripcion }} </td>
        <td>@{{ item.precio }}</td>
        <td>@{{ item.cantidad }}</td>
        <td>@{{ item.subtotal }}</td>
        <td>
          <button class="btn btn-danger" v-on:click="removeItem(index,item.subtotal)" ><span class="glyphicon glyphicon-trash"></span></button>
        </td>
      </tr>
      <tr>
        <td class="thick-line"></td>
        <td class="thick-line"></td>
        <td class="thick-line text-center"><strong>Total</strong></td>
        <td class="thick-line">@{{ vlcabecera.total }}</td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
@section('footer')
<script src='{{ asset('js/pedidos.js') }}'></script>
@endsection
