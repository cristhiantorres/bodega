import Vue from 'vue'

import axios from 'axios'

import vuefilter from 'vue-filter'

import Multiselect from 'vue-multiselect'

import Toasted from 'vue-toasted'

Vue.use(Toasted)


const app = new Vue({

  el: '#pedidos',

  data: {
    pedidos: [],

    vlarticulo:
    {
      id:'',
      tipo_articulo: '',
      tipo: '',
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
    // this.listar()
  },


  methods:{
    nameWithLang ({ descripcion }) {
      return descripcion
    },
    listar(){

      this.msg = 'Cargado...';


      axios.get('api/pedidos?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN')


      .then(response => {

        this.pedidos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        this.from = response.data.from

        this.to = response.data.to

        if (this.pedidos.length < 1)
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

        this.pedidos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.pedidos.length < 1)
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

        this.pedidos = response.data.data

        this.next = response.data.next_page_url

        this.previous = response.data.prev_page_url

        if (this.pedidos.length < 1)
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
    removePedido: function(index,id){

      axios.get('api/pedidos/'+id+'/delete')

      .then(response => {

        this.pedidos.splice(index, 1)

      })

      .catch(error => {

        alert(error)

      });
    },
    
    showModal(id,index){

    },
    
    update(id,index){

      axios.patch('api/pedidos/'+id+'/update', this.vlcliente)

      .then(response => {

      })

      .catch(error => {

        alert(error)

      });
    }
  }
});

const detalles = new Vue({

  el: '#pedidos_new',

  components: { 'multiselect': Multiselect },

  data:{

    clientes: [],


    vlcabecera:{

      nombre:'',
      apellido:'',
      total:'',
      fecha_pedido:''

    },

    articulos: [],

    vldetalles:
    {
      descripcion:'',
      cantidad: '',
      precio:'',
      subtotal: ''
    },

    detalles:[]
    
  },

  mounted(){

    axios.get('/pedidos/clientes')

    .then(response => {

      this.clientes = response.data

    })
    .catch(error =>{
      console.log(error);
    })


    axios.get('/pedidos/articulos')

    .then(response => {

      this.articulos = response.data

    })
    .catch(error =>{
      console.log(error);
    })
  },

  methods:{

    cliente_doc ({ doc }) {

      return doc 

    },

    articulo_name({ descripcion }){
      return descripcion
    },

    addDetalles(){

      this.vldetalles.subtotal = this.vldetalles.precio * this.vldetalles.cantidad;
      if (this.vlcabecera.total == undefined)
      {

        this.vlcabecera.total = 0
        this.vlcabecera.total = this.vlcabecera.total + this.vldetalles.subtotal
      
      }else {

        this.vlcabecera.total = this.vlcabecera.total + this.vldetalles.subtotal
      
      }

      
      this.detalles.push(this.vldetalles);

      this.vldetalles = '';

    },

    removeItem(index, subtotal){
        this.vlcabecera.total = this.vlcabecera.total - subtotal
        this.detalles.splice(index, 1)
    },

    addPedido(){
      axios.post('/api/pedidos?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN',{

          id_cliente: this.vlcabecera.id,
          fecha_pedido: this.vlcabecera.fecha_pedido,
          costo_total: this.vlcabecera.total,
          detalles: this.detalles,

      })
      .then(response => {

          Vue.toasted.success('<strong>Pedido procesado satisfactoriamente</strong>', {duration:5000});

      })
      .catch(error => {
        console.log(error);
      }) 
    }

  }
})
