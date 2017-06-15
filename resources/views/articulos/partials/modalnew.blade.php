<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crear Articulo</h4>
      </div>
      <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-group">
          {{-- <input type="text" v-model="vlarticulo.tipo_articulo" placeholder="Tipo de articulo" class="form-control"> --}}
          <div>
            <label class="typo__label">Select with search</label>
            <multiselect v-model="vlarticulo.tipo_articulo" :options="options" select-label="Presiona enter para seleccionar" :custom-label="nameWithLang" placeholder="Selecciona una opcion" label="descripcion" track-by="descripcion"></multiselect>
          </div>
        </div>
        <div class="form-group">
          <input type="text" v-model="vlarticulo.descripcion" placeholder="Articulo" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" v-model="vlarticulo.precio" placeholder="Precio" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" @click="create" >Guardar</button>
      </div>
    </div>
  </div>
</div>
