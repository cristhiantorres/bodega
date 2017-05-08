<!-- Modal -->
<div class="modal fade" id="editModal-{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar | {{ $cliente->nombre ." ".$cliente->apellido }}</h4>
      </div>
      <div class="modal-body">
        <form id="form-update-{{ $cliente->id }}" role="form" action="{{ url('clientes/'.$cliente->id.'/update') }}" method="POST">
          
          {{ csrf_field() }}
          {{ method_field('patch') }}

          <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" class="form-control" value="{{ $cliente->nombre }}">
          </div>
          <div class="form-group">
            <input type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{ $cliente->apellido }}">
          </div>
          <div class="form-group">
            <input type="text" name="doc" placeholder="Doc. Identidad" class="form-control" value="{{ $cliente->doc }}">
          </div>
          <div class="form-group">
            <input type="text" name="telefono" placeholder="Telefono" class="form-control" value="{{ $cliente->telefono }}">
          </div>
          <div class="form-group">
            <input type="email" name="correo" placeholder="Correo" class="form-control" value="{{ $cliente->correo }}">
          </div>
          <div class="form-group">
            <input type="direccion" name="direccion" placeholder="Direccion" class="form-control" value="{{ $cliente->direccion}}">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="form-update-{{ $cliente->id }}">Actualizar</button>
      </div>
    </div>
  </div>
</div>