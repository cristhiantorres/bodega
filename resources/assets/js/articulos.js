import Vue from 'vue'

import axios from 'axios'

import vuefilter from 'vue-filter'

import Multiselect from 'vue-multiselect'

const app = new Vue({

  el: '#articulos',

  components: { 'multiselect': Multiselect },
  data: {
    options: [],
    articulos: [],

    vlarticulo:
    {
      id:'',
      tipo_articulo: '',
      descripcion:'',
      precio:'',
      creado_por:'',
      created_at:'',
      updated_at:''
    },

    searchString: '' ,

    msg: '',

    next: '',

    previous:'',

    from:'',

    to:'',

    validate: false

  },

  mounted: function() {

    this.listar()

    axios.get('api/tipos')

    .then(response => {

        this.options = response.data

    })
    .catch(error =>{
        console.log(error);
    })

  },


  methods:{
    nameWithLang ({ descripcion }) {
          return descripcion
        },
    listar(){

      this.msg = 'Cargado...';


      axios.get('api/articulos?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN')


      .then(response => {

        this.articulos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        this.from = response.data.from

        this.to = response.data.to

        if (this.articulos.length < 1)
        {

          this.msg = 'No hay registros.'

        }else{

          this.msg = ''

        }

      })


      .catch(error => {

        console.log(error)

      });
    },
    next_page(){

      this.msg = 'Cargado...';

      // this.validate = true


      axios.get(this.next+"&api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN")


      .then(response => {

        this.articulos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.articulos.length < 1)
        {

          this.msg = 'No hay registros.'

        }else{

          this.msg = ''

        }

      })


      .catch(error => {

        console.log(error)

      });
    },
    previous_page(){

      this.msg = 'Cargado...';


      axios.get(this.previous+"&api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN")


      .then(response => {

        this.articulos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.articulos.length < 1)
        {

          this.msg = 'No hay registros.'

        }else{

          this.msg = ''

        }

      })


      .catch(error => {

        console.log(error)

      });
    },
    removeCliente: function(index,id){
      axios.get('api/articulos/'+id+'/delete')

      .then(response => {

        this.articulos.splice(index, 1)

      })

      .catch(error => {

        alert(error)

      });
    },

    create(){
      axios.post('api/articulos?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN',{

          tipo_articulo: this.vlarticulo.tipo_articulo.id,
          descripcion: this.vlarticulo.descripcion,
          precio: this.vlarticulo.precio

      })
      .then(response => {
          this.articulos = response.data.data
          $('#newModal').modal('hide')
      })
      .catch(error => {
        console.log(error);
      })
    },

    showModal(id,index){

      // this.vlcliente.nombre = this.articulos[index].nombre
      // this.vlcliente.apellido = this.articulos[index].apellido;
      // this.vlcliente.doc = this.articulos[index].doc;
      // this.vlcliente.correo = this.articulos[index].correo;
      // this.vlcliente.telefono = this.articulos[index].telefono;
      // this.vlcliente.direccion = this.articulos[index].direccion;
      // this.vlcliente.id = this.articulos[index].id;
      //
      // $('#editModal-'+id).modal('show');
    },
    update(id,index){

      axios.patch('api/articulos/'+id+'/update', this.vlcliente)

      .then(response => {

        // this.articulos[index].nombre = response.data.nombre
        // this.articulos[index].apellido = response.data.apellido
        // this.articulos[index].doc = response.data.doc
        // this.articulos[index].correo = response.data.correo
        // this.articulos[index].telefono = response.data.telefono
        // this.articulos[index].direccion = response.data.direccion
        //
        // $('#editModal-'+id).modal('hide');
      })

      .catch(error => {

        alert(error)

      });
    }
  }
});
