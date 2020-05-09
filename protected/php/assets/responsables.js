Vue.component('responsables',{
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
                        <h5 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">call_merge</i>Consecuencias: ${nomConsec}</h5>
                    </div>
                    <div class="col s12 blue-text text-darken-4" style="padding-left: 50px; margin-top: -20px;">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.2em;">person</i>Alta de Responsables</h4>
                    </div>
                    
                    <div class="input-field col s9 m10">
                        <input type="text" id="nomRespo" v-model="nNomRespo">
                        <label for="nomRespo">Responsable de Atención del Riesgo</label>
                    </div>
                    <div class="input-field col s3 m2 center">

                        <span v-if="nNomRespo != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>

                    </div>
                                   
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Responsables de Atención</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liRes of dataResponsables" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">call_merge</i>
                                    {{liRes.nomRespAtenRes}}
                                    <!-- Calificación VUE -->

                                    <span v-if="parseInt(liRes.calificaRCon) <= 10">
                                        <div class="green-text text-darken-1">
                                            <i class="material-icons right">check</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liRes.calificaRCon) > 10 && parseInt(liRes.calificaRCon) <= 20">
                                        <div class="yellow-text text-darken-2">
                                            <i class="material-icons right">wb_sunny</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liRes.calificaRCon) > 20 && parseInt(liRes.calificaRCon) <= 30">
                                        <div class="orange-text text-darken-2">
                                            <i class="material-icons right">warning</i>
                                        </div>
                                    </span>
                                    <span v-else>
                                        <div class="red-text text-darken-2">
                                            <i class="material-icons right">whatshot</i>
                                        </div>
                                    </span>
                                    
                                    <!-- Calificación VUE -->
                                    <span class="new badge red" data-badge-caption="pendientes">4</span></div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <a href="#">
                                        <!-- <a :href="'../procedimientos/pro.app?nomProceso='+liRes.proceso"> -->
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block" style="font-size: .9em;">
                                                <b>Calificación del Riesgo:</b>
                                                <br>
                                                <!-- Calificación VUE -->

                                                <span v-if="parseInt(liRes.calificaRCon) <= 10">
                                                    <div class="green-text text-darken-1" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">check</i>
                                                        <span style="font-size: 2em;">{{liRes.calificaRCon}} - Bajo</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liRes.calificaRCon) > 10 && parseInt(liRes.calificaRCon) <= 20">
                                                    <div class="yellow-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">wb_sunny</i>
                                                        <span style="font-size: 2em;">{{liRes.calificaRCon}} - Medio</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liRes.calificaRCon) > 20 && parseInt(liRes.calificaRCon) <= 30">
                                                    <div class="orange-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">warning</i>
                                                        <span style="font-size: 2em;">{{liRes.calificaRCon}} - Alto</span>
                                                    </div>
                                                </span>
                                                <span v-else>
                                                    <div class="red-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">whatshot</i>
                                                        <span style="font-size: 2em;">{{liRes.calificaRCon}} - Critico</span>
                                                    </div>
                                                </span>
                                                
                                                <!-- Calificación VUE -->
                                                <b>Proceso:</b> {{liRes.procesoRes}}
                                                <br>
                                                <b>Procedimiento:</b> {{liRes.procedimientoRes}}
                                                <br>
                                                <b>Causa:</b> {{liRes.causaRes}}
                                                <br>
                                                <div style="font-size: .9em;">
                                                    <b>Area:</b> {{liRes.areaRes}} - {{liRes.idUsuarioRes}}
                                                    <br>
                                                    <i>Alta: {{liRes.fechaHoraRegRes}}</i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light"
                                                @click="btnEditar(liRes.id, liRes.nomRespAtenRes)"><i
                                                    class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light"
                                                @click="btnEliminar(liRes.id)"><i
                                                    class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../consecuecias/pro.app?nomProceso=${nomProceso}&nomProcedimiento=${nomProcedimiento}&nomCausa=${nomCausa}"
                                class="btn blue darken-4"><i
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
            dataResponsables: [],
            nNomRespo: '',
        }
    },
    methods: {
            btnEditar: async function (id, nomRespAtenRes) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<label class="left">Responsable de Atención del Riesgo</label><input type="text" id="nomRespAtenRes" value="' + nomRespAtenRes + '">',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        nomRespAtenRes = document.getElementById('nomRespAtenRes').value

                        this.editar(id, nomRespAtenRes);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, nomRespAtenRes) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + nomRespAtenRes + " ?",
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
                axios.post('../listaResponsables/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataResponsables = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaResponsables/crud.app', {
                    opcion: 1,
                    nomRespAtenRes: this.nNomRespo,
                }).then(response => {
                    this.listaDatos();
                });

                this.nNomRespo = ""

            },

            //Procedimiento EDITAR.
            editar(id, nomRespAtenRes) {
                axios.post('../listaResponsables/crud.app', {
                    opcion: 2,
                    id: id,
                    nomRespAtenRes: nomRespAtenRes
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaResponsables/crud.app', {
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