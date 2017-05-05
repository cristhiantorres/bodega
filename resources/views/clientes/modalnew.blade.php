<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Cliente</h4>
      </div>
      <div class="modal-body">
        <form id="form-new" action="{{ route('clientes.new') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="apellido" placeholder="Apellido" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="doc" placeholder="Doc. Identidad" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="telefono" placeholder="Telefono" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" name="correo" placeholder="Correo" class="form-control">
          </div>
          <div class="form-group">
            <input type="direccion" name="direccion" placeholder="Direccion" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="form-new">Guardar</button>
      </div>
    </div>
  </div>
</div>