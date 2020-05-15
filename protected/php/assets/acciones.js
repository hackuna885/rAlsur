Vue.component('acciones',{
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
                        <h5 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">person</i>Responsable: ${nomRespAtenRes}</h5>
                    </div>
                    <div class="col s12 blue-text text-darken-4" style="padding-left: 50px; margin-top: -20px;">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.2em;">pan_tool</i>Acciones de Mitigación</h4>
                    </div>
                    
                    <div class="input-field col s9 m10">
                        <input type="text" id="nomAccion" v-model="nAccionesAcc">
                        <label for="nomAccion">Acción de Mitigación</label>
                    </div>
                    <div class="input-field col s3 m2 center">

                        <span v-if="nAccionesAcc != '' && nFechaSegui != '' && nFechaCumpli != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>

                    </div>
                    <div class="col s6">
                        <label class="left">Fecha de Seguimiento</label>
                        <input type="date" v-model="nFechaSegui">
                    </div>
                    <div class="col s6">
                        <label class="left">Fecha de Cumplimiento</label>
                        <input type="date" v-model="nFechaCumpli">
                    </div>
                                   
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Lista de Acciones de Mitigación</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liAcc of dataAcciones" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">pan_tool</i>
                                    {{liAcc.accionesAcc}}
                                    <!-- Calificación VUE -->

                                    <span v-if="parseInt(liAcc.calificaRAcc) <= 10">
                                        <div class="green-text text-darken-1">
                                            <i class="material-icons right">check</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liAcc.calificaRAcc) > 10 && parseInt(liAcc.calificaRAcc) <= 20">
                                        <div class="yellow-text text-darken-2">
                                            <i class="material-icons right">wb_sunny</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liAcc.calificaRAcc) > 20 && parseInt(liAcc.calificaRAcc) <= 30">
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
                                    <!-- <span class="new badge red" data-badge-caption="pendientes">4</span> -->
                                    <span v-if="liAcc.estatusAcc === 'Abierto'" class="new badge red" data-badge-caption="A">
                                        1
                                    </span>
                                    <span v-if="liAcc.estatusAcc === 'En Atención'" class="new badge orange" data-badge-caption="P">
                                        1
                                    </span>
                                </div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <a href="#">
                                        <!-- <a :href="'../procedimientos/pro.app?nomProceso='+liAcc.proceso"> -->
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block" style="font-size: .9em;">
                                                <b>Calificación del Riesgo:</b>
                                                <br>
                                                <!-- Calificación VUE -->

                                                <span v-if="parseInt(liAcc.calificaRAcc) <= 10">
                                                    <div class="green-text text-darken-1" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">check</i>
                                                        <span style="font-size: 2em;">{{liAcc.calificaRAcc}} - Bajo</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liAcc.calificaRAcc) > 10 && parseInt(liAcc.calificaRAcc) <= 20">
                                                    <div class="yellow-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">wb_sunny</i>
                                                        <span style="font-size: 2em;">{{liAcc.calificaRAcc}} - Medio</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liAcc.calificaRAcc) > 20 && parseInt(liAcc.calificaRAcc) <= 30">
                                                    <div class="orange-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">warning</i>
                                                        <span style="font-size: 2em;">{{liAcc.calificaRAcc}} - Alto</span>
                                                    </div>
                                                </span>
                                                <span v-else>
                                                    <div class="red-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">whatshot</i>
                                                        <span style="font-size: 2em;">{{liAcc.calificaRAcc}} - Critico</span>
                                                    </div>
                                                </span>
                                                
                                                <!-- Calificación VUE -->
                                                <b>Proceso:</b> {{liAcc.procesoAcc}}
                                                <br>
                                                <b>Procedimiento:</b> {{liAcc.procedimientoAcc}}
                                                <br>
                                                <b>Causa:</b> {{liAcc.causaAcc}}
                                                <br>
                                                <div style="font-size: .9em;">
                                                    <b>Consecuencia:</b> {{liAcc.consecuenciaAcc}}
                                                    <br>
                                                    <b>Responsable en Atención:</b> {{liAcc.nomRespAtenAcc}}
                                                    <br>
                                                    <b>Acción:</b> {{liAcc.accionesAcc}}
                                                    <br>
                                                    <b>Fecha de Seguimiento:</b> {{liAcc.fechaSeguiAcc}}
                                                    <br>
                                                    <b>Fecha de Cumplimiento:</b> {{liAcc.fechaCumpliAcc}}
                                                    <br>
                                                    <b>Area:</b> {{liAcc.areaAcc}} - {{liAcc.idUsuarioAcc}}
                                                    <br>
                                                    <i>Alta: {{liAcc.fechaHoraRegAcc}}</i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light"
                                                @click="btnEditar(liAcc.id, liAcc.accionesAcc, liAcc.fechaSeguiAcc, liAcc.fechaCumpliAcc)"><i
                                                    class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light"
                                                @click="btnEliminar(liAcc.id)"><i
                                                    class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../responsables/pro.app?nomProceso=${nomProceso}&nomProcedimiento=${nomProcedimiento}&nomCausa=${nomCausa}&nomConsec=${nomConsec}&cali=${cali}&estatus=${estatus}"
                                class="btn blue darken-4"><i
                                    class="material-icons left">keyboard_arrow_left</i>Regresar</a>
                        </div>
                        <div class="right" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../inicio/home.app"
                                class="btn blue darken-4">Terminar<i
                                class="material-icons right">keyboard_arrow_right</i></a>
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
            dataAcciones: [],
            nAccionesAcc: '',
            nFechaSegui: '',
            nFechaCumpli: '',
        }
    },
    methods: {
            btnEditar: async function (id, accionesAcc, fechaSeguiAcc, fechaCumpliAcc) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="row"><div class="col s12"><label class="left">Responsable de Atención del Riesgo</label><input type="text" id="accionesAcc" value="' + accionesAcc + '"></div><div class="col s6"><label class="left">Fecha de Seguimiento</label><input type="date" id="fechaSeguiAcc" value="' + fechaSeguiAcc + '"></div><div class="col s6"><label class="left">Fecha de Cumplimiento</label><input type="date" id="fechaCumpliAcc" value="' + fechaCumpliAcc + '"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        accionesAcc = document.getElementById('accionesAcc').value,
                        fechaSeguiAcc = document.getElementById('fechaSeguiAcc').value,
                        fechaCumpliAcc = document.getElementById('fechaCumpliAcc').value

                        this.editar(id, accionesAcc, fechaSeguiAcc, fechaCumpliAcc);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, nAccionesAcc) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + nAccionesAcc + " ?",
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
                axios.post('../listaAcciones/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataAcciones = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaAcciones/crud.app', {
                    opcion: 1,
                    accionesAcc: this.nAccionesAcc,
                    fechaSeguiAcc: this.nFechaSegui,
                    fechaCumpliAcc: this.nFechaCumpli,
                }).then(response => {
                    this.listaDatos();
                });

                this.nAccionesAcc = "",
                this.nFechaSegui = "",
                this.nFechaCumpli = ""

            },

            //Procedimiento EDITAR.
            editar(id, accionesAcc, fechaSeguiAcc, fechaCumpliAcc) {
                axios.post('../listaAcciones/crud.app', {
                    opcion: 2,
                    id: id,
                    accionesAcc: accionesAcc,
                    fechaSeguiAcc: fechaSeguiAcc,
                    fechaCumpliAcc: fechaCumpliAcc
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaAcciones/crud.app', {
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