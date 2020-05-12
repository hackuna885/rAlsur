Vue.component('procesos',{
    template: /*html*/
    `
<div>
    <div class="container section centrado-h-v" id="precarga">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="hide" id="contenido">
        <div class="centrado-h-v">
            <div class="container section" style="width: 500px; padding: 10px;">
                <div class="row">
                    <div class="col s12 blue-text text-darken-4">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">collections_bookmark</i>Alta de Procesos</h4>
                    </div>
                    <div class="input-field col s9 m10 centrado-h-v">
                        <input id="nProceso" type="text" class="validate" v-model="nProceso">
                        <label for="nProceso">Nuevo Proceso</label>
                    </div>
                    <div class="input-field col s3 m2 center">                        
                        <span v-if="nProceso != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>
                    </div>
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Lista de Procesos</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liPro of dataProcesos" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">collections_bookmark</i>
                                    {{liPro.proceso}}
                                    <span class="new badge red" data-badge-caption="pendientes">4</span></div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <a :href="'../procedimientos/pro.app?nomProceso='+liPro.proceso+'&nomArea='+liPro.area">
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block">
                                                Area: {{liPro.area}} - {{liPro.idUsuario}}
                                                <br>
                                                <i>Alta: {{liPro.fechaHoraReg}}</i>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light" @click="btnEditar(liPro.id, liPro.proceso)"><i class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light" @click="btnEliminar(liPro.id, liPro.proceso)"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../inicio/home.app" class="btn blue darken-4"><i class="material-icons left">keyboard_arrow_left</i>Regresar</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>    
    </div>
    
</div>
    `,
    data() {
        return {
            dataProcesos: [],
            nProceso: ''
        }
    },
    methods: {
            btnEditar: async function (id, proceso) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="input-field"><input type="text" id="proceso" value="' + proceso + '"><label for="proceso">Proceso:</label></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        proceso = document.getElementById('proceso').value,

                        this.editar(id, proceso);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, proceso) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + proceso + " ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Borrar'
                }).then((result) => {
                    if (result.value) {
                        this.borrar(id);
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
                axios.post('../listaProcesos/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataProcesos = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaProcesos/crud.app', {
                    opcion: 1,
                    proceso: this.nProceso,
                }).then(response => {
                    this.listaDatos();
                });

                this.nProceso = ""

            },

            //Procedimiento EDITAR.
            editar(id, proceso) {
                axios.post('../listaProcesos/crud.app', {
                    opcion: 2,
                    id: id,
                    proceso: proceso
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaProcesos/crud.app', {
                    opcion: 3,
                    id: id
                }).then(response => {
                    this.listaDatos();
                });
            },
    },
    created() {
        this.listaDatos();
    },
})