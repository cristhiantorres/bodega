import Vue from 'vue'

import axios from 'axios'

import vuefilter from 'vue-filter'

import Toasted from 'vue-toasted';

Vue.use(Toasted)

const app = new Vue({

	el: '#clientes',

	data: {

		clientes: [],

		vlcliente:
		{
			id:'',
			nombre: '',
			apellido:'',
			doc:'',
			telefono:'',
			correo:'',
			direccion:''
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
	},


	methods:{
		listar(){

			this.msg = 'Cargado...';


			axios.get('/api/clientes?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN')


			.then(response => {

				this.clientes = response.data.data

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


			axios.get(this.next+"&api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN")


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


			axios.get(this.previous+"&api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN")


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

			axios.get('api/clientes/'+id+'/delete?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN')

			.then(response => {
				Vue.toasted.success('<strong>Registro '+ id +': ' +this.clientes[index].nombre+' '+this.clientes[index].apellido+' eliminado</strong>', {duration:5000});
				this.clientes.splice(index, 1)

			})
			.catch(error => {
				alert(error)
			});
		},
		showModal(id,index){

			this.vlcliente.nombre = this.clientes[index].nombre
			this.vlcliente.apellido = this.clientes[index].apellido;
			this.vlcliente.doc = this.clientes[index].doc;
			this.vlcliente.correo = this.clientes[index].correo;
			this.vlcliente.telefono = this.clientes[index].telefono;
			this.vlcliente.direccion = this.clientes[index].direccion;
			this.vlcliente.id = this.clientes[index].id;

			$('#editModal-'+id).modal('show');
		},
		update(id,index){

			axios.patch('/api/clientes/'+id+'/update?api_token=TYtm7VTWLLKTsDbnRBoIExU4dH9UX4r0HN2y7KvyCGC9HR4QweL2nRyDsPjN', this.vlcliente)

			.then(response => {

				this.clientes[index].nombre = response.data.nombre
				this.clientes[index].apellido = response.data.apellido
				this.clientes[index].doc = response.data.doc
				this.clientes[index].correo = response.data.correo
				this.clientes[index].telefono = response.data.telefono
				this.clientes[index].direccion = response.data.direccion

				$('#editModal-'+id).modal('hide');

				Vue.toasted.success(this.clientes[index].nombre+ ' actualizado', {duration:5000});
			})

			.catch(error => {

				alert(error)

			});
		}
	},
});
