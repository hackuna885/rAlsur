<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <style>
        .centrado-h-v{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        tbody {
            display:block;
            height: 250px;
            overflow:auto;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - 1em )
        }
        table {
            width:100%;
        }
        .modal{
            border-radius: 10px;
            max-width: 430px;
        }
        @media only screen and (min-width: 992px) {
            .modal{
                min-height: 80%;
            }
        }
        @media only screen and (max-width: 992px) {
            table tbody td{
                font-size: .7em;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="app">
        <div class="row">
            <div class="col s12">
                <div class="section">
                    <h3 class="light">Registro de Usuarios</h3>
                </div>
                <div class="section">
                    <button class="btn-floating btn-large waves-effect waves-light red modal-trigger"
                        @click="btnAlta">+</button>
                    <span>Agregar</span>
                </div>
                <div class="card">
                    <div class="card-content" style="height: 350px;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%;">id</th>
                                    <th style="width: 35%;">Nombre</th>
                                    <th style="width: 25%;">Area</th>
                                    <th style="width: 30%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="usr of nomUsr">
                                    <td style="width: 10%;">{{usr.id}}</td>
                                    <td style="width: 35%;">{{usr.nombre}}</td>
                                    <td style="width: 25%;">{{usr.area}}</td>
                                    <td class="center-align" style="width: 30%;">
                                        <button class="btn waves-effect waves-light"
                                            @click="btnEditar(usr.id, usr.nombre, usr.area, usr.correo, usr.password,
                                            usr.tipoUsuario)">
                                            <div class="centrado-h-v">
                                                <img src="../img/icons/editar.svg">
                                            </div>
                                        </button>
                                        <button class="btn grey waves-effect waves-light"
                                                @click="btnEliminar(usr.id, usr.nombre)">
                                            <div class="centrado-h-v">
                                                <img src="../img/icons/borrar.svg">
                                            </div>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/vue.js"></script>    
    <script src="../js/axios.min.js"></script>    
    <script src="../js/sweetalert2.min.js"></script>    
    <script src="../js/materialize.min.js"></script> 
    <script>
        new Vue({
            el: '#app',
            data: {
                nomUsr: [],
                nombre: '',
                area: '',
                correo: '',
                password: '',
                tipoUsuario: ''

            },
            methods: {

                btnAlta: async function(){
					const {value: formValues} = await Swal.fire({
			        title: 'NUEVO REGISTRO',
			        html:
			        '<div class="input-field"><input type="text" id="nombre"><label for="nombre">Nombre:</label></div><div><label class="left">Area:</label><select id="area" class="browser-default"><option value="" disabled selected>Selecciona una opción</option><option value="Dirección de Finanzas">Dirección de Finanzas</option><option value="Dirección de Instalaciones  Existentes">Dirección de Instalaciones Existentes</option><option value="Dirección de Nuevas Instalaciones">Dirección de Nuevas Instalaciones</option><option value="Dirección de Recursos Humanos">Dirección de Recursos Humanos</option><option value="Dirección General">Dirección General</option><option value="Dirección Técnica">Dirección Técnica</option></select></div><div class="input-field"><input type="email" id="correo"><label for="correo">Correo:</label></div><div class="input-field"><input type="password" id="password"><label for="password">Password:</label></div><div><label class="left">Tipo de Usuario:</label><select id="tipoUsuario" class="browser-default"><option value="" disabled selected>Selecciona una opción</option><option value="2">Usuario</option><option value="1">Administrador</option></select></div>',              
			        focusConfirm: false,
			        showCancelButton: true,
			        confirmButtonText: 'Guardar',          
                    confirmButtonColor:'#1cc88a',
                    cancelButtonText: 'Cancelar',
			        cancelButtonColor:'#3085d6',  
			        preConfirm: () => {            
			            return [
			              this.nombre = document.getElementById('nombre').value,
			              this.area = document.getElementById('area').value,
			              this.correo = document.getElementById('correo').value,
			              this.password = document.getElementById('password').value,
			              this.tipoUsuario = document.getElementById('tipoUsuario').value,
			             ]
			          }
			        })        
			        if(this.nombre == "" || this.area == "" || this.correo == "" || this.password == "" ||
			        this.tipoUsuario == ""){
			                Swal.fire({
			                  type: 'info',
			                  title: 'Datos incompletos',                                    
			                }) 
			        }       
			        else{          
			          this.alta();          
			          const Toast = Swal.mixin({
			              toast: true,
			              position: 'top-end',
			              showConfirmButton: false,
			              timer: 3000
			            });
			            Toast.fire({
			              type: 'success',
			              title: '¡Agregado!'
			            })                
			        }

                },
                
				btnEditar: async function(id, nombre, area, correo, password, tipoUsuario){

                    var tUsr = ''
                    if(tipoUsuario === '1'){
                        tUsr = 'Administrador'
                    }else{
                        tUsr = 'Usuario'
                    }
                    
					await Swal.fire({
			        title: 'EDITAR',
			        html:
			        '<div class="input-field"><input type="text" id="nombre" value="'+nombre+'"><label for="nombre">Nombre:</label></div><div><label class="left">Area:</label><select id="area" class="browser-default"><option value="'+area+'" disabled selected>'+area+'</option><option value="Dirección de Finanzas">Dirección de Finanzas</option><option value="Dirección de Instalaciones  Existentes">Dirección de Instalaciones Existentes</option><option value="Dirección de Nuevas Instalaciones">Dirección de Nuevas Instalaciones</option><option value="Dirección de Recursos Humanos">Dirección de Recursos Humanos</option><option value="Dirección General">Dirección General</option><option value="Dirección Técnica">Dirección Técnica</option></select></div><div><label class="left">Correo:</label><input type="email" id="correo" value="'+correo+'"></div><div><label class="left">Password:</label><input type="password" id="password" value="'+password+'"></div><div><label class="left">Tipo de Usuario:</label><select id="tipoUsuario" class="browser-default"><option value="'+tipoUsuario+'" disabled selected>'+tUsr+'</option><option value="2">Usuario</option><option value="1">Administrador</option></select></div>', 
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor:'#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor:'#3085d6',
			        }).then((result) => {
			          if (result.value) {
			            nombre = document.getElementById('nombre').value,    
			            area = document.getElementById('area').value,
			            correo = document.getElementById('correo').value,
			            password = document.getElementById('password').value,                    
			            tipoUsuario = document.getElementById('tipoUsuario').value                 
			            
			            this.editar(id, nombre, area, correo, password, tipoUsuario);
			            Swal.fire(
			              '¡Actualizado!',
			              'El registro ha sido actualizado.',
			              'success'
			            )                  
			          }
			        });

				},

                btnEliminar: function(id, nombre){
						Swal.fire({
				          title: '¿Está seguro de borrar el registro: '+nombre+" ?",         
				          type: 'warning',
				          showCancelButton: true,
				          confirmButtonColor:'#d33',
				          cancelButtonColor:'#3085d6',
				          confirmButtonText: 'Borrar'
				        }).then((result) => {
				          if (result.value) {            
				            this.borrarCausa(id);             
				            //y mostramos un msj sobre la eliminación  
				            Swal.fire(
				              '¡Eliminado!',
				              'El registro ha sido borrado.',
				              'success'
				            )
				          }
				        })

					},
                
                listaDatos() {
			        axios.post('../listaUsr/crud.app', {opcion:4}).then(response =>{
			           this.nomUsr = response.data;
			        });
                },
                
                //Procedimiento CREAR.
			    alta(){
			        axios.post('../listaUsr/crud.app', {opcion:1, nombre:this.nombre, area:this.area,correo:this.correo,
			        password:this.password, tipoUsuario:this.tipoUsuario }).then(response =>{
			            this.listaDatos();
			        }); 

			         this.nombre = "",
			         this.area = "",
			         this.correo = "",
			         this.password = "",
                     this.tipoUsuario = ""

                },

                //Procedimiento EDITAR.
				    editar (id, nombre, area, correo, password, tipoUsuario) {
				       axios.post('../listaUsr/crud.app', {opcion:2, id:id, nombre:nombre, area:area,
				       correo:correo, password:password, tipoUsuario:tipoUsuario}).then(response =>{
				           this.listaDatos();
				        });                              
				    },

                //Procedimiento BORRAR.
				    borrarCausa (id) {
				        axios.post('../listaUsr/crud.app', {opcion:3, id:id}).then(response =>{
				            this.listaDatos();
				            });
				    },    
                
            },
            created() {            
			   this.listaDatos();            
			},
        })
    </script>
    <script>
        // Script de Materialize

        document.addEventListener('DOMContentLoaded', function () {
            M.AutoInit();
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, {
                dismissible: false
            });
        });

        //Notificación de Guardado
        function guardado() {
            M.toast({
                html: 'Guardado',
                classes: 'green',
                displayLength: 800
            })
        }

        //Notificación de Sin guardar
        function cancelado() {
            M.toast({
                html: 'Sin guardar',
                classes: 'red',
                displayLength: 800
            })
        }

        //Notificación de Eliminado
        function eliminado() {
            M.toast({
                html: 'Eliminado',
                classes: 'red',
                displayLength: 800
            })
        }
    </script>
</body>
</html>