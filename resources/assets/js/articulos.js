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


      axios.get('api/articulos')


      .then(response => {

        this.articulos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        this.from = response.data.from

        this.to = response.data.to

        if (this.clientes.length < 1)
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


      axios.get(this.next)


      .then(response => {

        this.clientes = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.clientes.length < 1)
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


      axios.get(this.previous)


      .then(response => {

        this.clientes = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.clientes.length < 1)
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
      axios.get('api/clientes/'+id+'/delete')

      .then(response => {

        this.clientes.splice(index, 1)

      })

      .catch(error => {

        alert(error)

      });
    },

    create(){
      axios.post('api/articulos',{

          tipo_articulo: this.vlarticulo.tipo_articulo.id,
          descripcion: this.vlarticulo.descripcion,
          precio: this.vlarticulo.precio

      })
      .then(response => {
          this.articulos.push(response.data)
          $('#newModal').modal('hide')
      })
      .catch(error => {
        console.log(error);
      })
    },

    showModal(id,index){

      // this.vlcliente.nombre = this.clientes[index].nombre
      // this.vlcliente.apellido = this.clientes[index].apellido;
      // this.vlcliente.doc = this.clientes[index].doc;
      // this.vlcliente.correo = this.clientes[index].correo;
      // this.vlcliente.telefono = this.clientes[index].telefono;
      // this.vlcliente.direccion = this.clientes[index].direccion;
      // this.vlcliente.id = this.clientes[index].id;
      //
      // $('#editModal-'+id).modal('show');
    },
    update(id,index){

      axios.patch('api/clientes/'+id+'/update', this.vlcliente)

      .then(response => {

        // this.clientes[index].nombre = response.data.nombre
        // this.clientes[index].apellido = response.data.apellido
        // this.clientes[index].doc = response.data.doc
        // this.clientes[index].correo = response.data.correo
        // this.clientes[index].telefono = response.data.telefono
        // this.clientes[index].direccion = response.data.direccion
        //
        // $('#editModal-'+id).modal('hide');
      })

      .catch(error => {

        alert(error)

      });
    }
  }
});
