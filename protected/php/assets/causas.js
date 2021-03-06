Vue.component('causas',{
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
                        <h5 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">book</i>Procedimiento: ${nomProcedimiento}</h5>
                    </div>
                    <div class="col s12 blue-text text-darken-4" style="padding-left: 50px; margin-top: -20px;">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.2em;">call_split</i>Alta de Causas</h4>
                    </div>
                    <div class="input-field col s9 m10 centrado-h-v">
                        <input id="procedimiento" type="text" class="validate" v-model="nCausa">
                        <label for="procedimiento">Nueva Causa o Raíz</label>
                    </div>
                    <div class="input-field col s3 m2 center">

                        <span v-if="nCausa != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>

                    </div>
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Lista de Causas</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liCau of dataCausa" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">call_split</i>
                                    {{liCau.causaCau}}
                                    <!-- <span class="new badge red" data-badge-caption="pendientes">4</span> -->
                                    <span v-if="liCau.estatusAbie >= 1" class="new badge red" data-badge-caption="A">
                                        {{liCau.estatusAbie}}
                                    </span>
                                    <span v-if="liCau.estatusAten >= 1" class="new badge orange" data-badge-caption="P">
                                        {{liCau.estatusAten}}
                                    </span>
                                </div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <!-- <a href="#"> -->
                                        <a :href="'../consecuecias/pro.app?nomProceso=${nomProceso}&nomProcedimiento=${nomProcedimiento}&nomCausa='+liCau.causaCau">
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block">
                                                Area: {{liCau.areaCau}} - {{liCau.idUsuarioCau}}
                                                <br>
                                                <i>Alta: {{liCau.fechaHoraRegCau}}</i>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light"
                                                @click="btnEditar(liCau.id, liCau.causaCau)"><i
                                                    class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light"
                                                @click="btnEliminar(liCau.id, liCau.causaCau)"><i
                                                    class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../procedimientos/pro.app?nomProceso=${nomProceso}&nomArea=${nomArea}" class="btn blue darken-4"><i
                                    class="material-icons left">keyboard_arrow_left</i>Regresar</a>
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
            dataCausa: [],
            nCausa: ''
        }
    },
    methods: {
            btnEditar: async function (id, causaCau) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<label class="left">Causa o Raíz:</label><input type="text" id="causaCau" value="' + causaCau + '">',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        causaCau = document.getElementById('causaCau').value

                        this.editar(id, causaCau);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, causaCau) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + causaCau + " ?",
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
                axios.post('../listaCausas/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataCausa = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaCausas/crud.app', {
                    opcion: 1,
                    causaCau: this.nCausa
                }).then(response => {
                    this.listaDatos();
                });

                this.nCausa = ""

            },

            //Procedimiento EDITAR.
            editar(id, causaCau) {
                axios.post('../listaCausas/crud.app', {
                    opcion: 2,
                    id: id,
                    causaCau: causaCau
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaCausas/crud.app', {
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