<div v-for="(cliente,index) in clientes">
  <div class="modal fade" :id="'editModal-'+cliente.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Editar | @{{ cliente.nombre }} @{{cliente.apellido }}</h4>
        </div>
        <div class="modal-body">
        <form @submit.prevent="update(cliente.id,index)" :id="'form-'+cliente.id">   
            {{ csrf_field() }}
            {{ method_field('patch') }}
            <div class="form-group">
              <input type="text" name="nombre"  placeholder="Nombre" v-model="vlcliente.nombre" class="form-control"> 
            </div>
            <div class="form-group">
              <input type="text" name="apellido" placeholder="Apellido" v-model="vlcliente.apellido" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" name="doc" placeholder="Doc. Identidad" v-model="vlcliente.doc" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" name="telefono" placeholder="Telefono" v-model="vlcliente.telefono" class="form-control">
            </div>
            <div class="form-group">
              <input type="email" name="correo" placeholder="Correo" v-model="vlcliente.correo" class="form-control">
            </div>
            <div class="form-group">
              <input type="text" name="direccion" placeholder="Direccion" v-model="vlcliente.direccion" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" :form="'form-'+vlcliente.id">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div>