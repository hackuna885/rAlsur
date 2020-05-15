Vue.component('procedimientos',{
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
                        <h5 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">collections_bookmark</i>Proceso: ${nomProceso}</h5>
                    </div>
                    <div class="col s12 blue-text text-darken-4" style="padding-left: 50px; margin-top: -20px;">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.2em;">book</i>Alta de Procedimientos</h4>
                    </div>
                    <div class="input-field col s9 m10 centrado-h-v">
                        <input id="procedimiento" type="text" class="validate" v-model="nProcedimiento">
                        <label for="procedimiento">Nuevo Procedimiento</label>
                    </div>
                    <div class="input-field col s3 m2 center">

                        <span v-if="nProcedimiento != '' && nDescripR != '' && nFactorR != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>


                    </div>
                    <div class="input-field col s12 center">
                        <textarea id="descripR" class="materialize-textarea" v-model="nDescripR"></textarea>
                        <label for="descripR">Descripción del Riesgo</label>
                    </div>
                    <div class="input-field col s12 center">
                        <select id="factorR" v-model="nFactorR">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option :value="fRiesgo" v-for="fRiesgo of factRiesgo">{{fRiesgo}}</option>
                        </select>
                        <label for="factorR">Factor de Riesgo</label>
                    </div>
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Lista de Procedimientos</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liPro of dataProcedimientos" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">book</i>
                                    {{liPro.procedimientoPro}}
                                    <!-- <span class="new badge red" data-badge-caption="pendientes">4</span> -->
                                    <span v-if="liPro.estatusAbie >= 1" class="new badge red" data-badge-caption="A">
                                        {{liPro.estatusAbie}}
                                    </span>
                                    <span v-if="liPro.estatusAten >= 1" class="new badge orange" data-badge-caption="P">
                                        {{liPro.estatusAten}}
                                    </span>
                                </div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <!-- <a href="#"> -->
                                        <a :href="'../causas/pro.app?nomProceso=${nomProceso}&nomProcedimiento='+liPro.procedimientoPro">
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block">
                                                Area: {{liPro.areaPro}} - {{liPro.idUsuarioPro}}
                                                <br>
                                                <i>Alta: {{liPro.fechaHoraRegPro}}</i>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light" @click="btnEditar(liPro.id, liPro.procedimientoPro, liPro.descripDelRiesgoPro, liPro.factDeRiesgoPro)"><i class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light" @click="btnEliminar(liPro.id, liPro.procedimientoPro)"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../procesos/pro.app" class="btn blue darken-4"><i
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
            factRiesgo: ['Economico', 'Humano', 'Infraestructura país', 'Medioambiental', 'Negocio', 'Político', 'Social', 'Tecnológico'],
            dataProcedimientos: [],
            nProcedimiento: '',
            nDescripR: '',
            nFactorR: ''
        }
    },
    methods: {
            btnEditar: async function (id, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<label class="left">Procedimiento:</label><input type="text" id="procedimientoPro" value="' + procedimientoPro + '"><label class="left">Descripción del Riesgo:</label><input type="text" id="descripDelRiesgoPro" value="' + descripDelRiesgoPro + '"><label class="left">Factor de Riesgo:</label><select class="browser-default" id="factDeRiesgoPro"><option value="' + factDeRiesgoPro + '" disabled selected>' + factDeRiesgoPro + '</option><option value="Economico">Economico</option><option value="Humano">Humano</option><option value="Infraestructura país">Infraestructura país</option><option value="Medioambiental">Medioambiental</option><option value="Negocio">Negocio</option><option value="Político">Político</option><option value="Social">Social</option><option value="Tecnológico">Tecnológico</option></select>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        procedimientoPro = document.getElementById('procedimientoPro').value,
                        descripDelRiesgoPro = document.getElementById('descripDelRiesgoPro').value,
                        factDeRiesgoPro = document.getElementById('factDeRiesgoPro').value,

                        this.editar(id, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, procedimientoPro) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + procedimientoPro + " ?",
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
                axios.post('../listaProcedimientos/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataProcedimientos = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaProcedimientos/crud.app', {
                    opcion: 1,
                    procedimientoPro: this.nProcedimiento,
                    descripDelRiesgoPro: this.nDescripR,
                    factDeRiesgoPro: this.nFactorR
                }).then(response => {
                    this.listaDatos();
                });

                this.nProcedimiento = "",
                this.nDescripR = "",
                this.nFactorR = ""

            },

            //Procedimiento EDITAR.
            editar(id, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro) {
                axios.post('../listaProcedimientos/crud.app', {
                    opcion: 2,
                    id: id,
                    procedimientoPro: procedimientoPro,
                    descripDelRiesgoPro: descripDelRiesgoPro,
                    factDeRiesgoPro: factDeRiesgoPro
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaProcedimientos/crud.app', {
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