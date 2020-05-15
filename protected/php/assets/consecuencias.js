Vue.component('consecuencias', {
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
                        <h5 class="left-align"><i class="material-icons left" style="font-size: 1.4em;">call_split</i>Causa: ${nomCausa}</h5>
                    </div>
                    <div class="col s12 blue-text text-darken-4" style="padding-left: 50px; margin-top: -20px;">
                        <h4 class="left-align"><i class="material-icons left" style="font-size: 1.2em;">call_merge</i>Alta de Consecuencias</h4>
                    </div>
                    
                    <div class="input-field col s9 m10">
                        <select v-model="nConsecuencia">
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option :value="optCon" v-for="optCon of optConsecuencias">{{optCon}}</option>
                        </select>
                        <label>Nueva consecuencia</label>
                    </div>
                    <div class="input-field col s3 m2 center">

                        <span v-if="nConsecuencia != '' && nPro != '' && nImp != '' && nPro != '' && nEstatus != '' && nFechaIdent != ''">
                            <button class="btn-floating btn-large waves-effect waves-light red center" @click="alta"><i class="material-icons">add</i></button>
                        </span>
                        <span v-else>
                            <button class="btn-floating btn-large waves-effect waves-light red center disabled"><i class="material-icons">add</i></button>
                        </span>

                    </div>
                    <div class="input-field col s3">
                        <select v-model="nPro">
                            <option value="" disabled selected>---</option>
                            <option value="2">2</option>
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="9">9</option>
                        </select>
                        <label>Probabilidad</label>
                    </div>
                    <div class="input-field col s3">
                        <select v-model="nImp">
                            <option value="" disabled selected>---</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select>
                        <label>Impacto</label>
                    </div>
                    <div class="input-field col s6" style="margin-top: -10px;">
                        <b class="grey-text light" style="font-size: .8em;">Calificación del Riesgo</b>
                        <div class="centrado-h-v" :class="colorCalificacion">
                            <i class="material-icons left" style="font-size: 3em;">{{figuraIcon}}</i>
                            <span style="font-size: 3em; margin-top: -7px;">{{sumaRiesgos}}</span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <select v-model="nEstatus">
                            <option value="" disabled selected>---</option>
                            <option value="Abierto">Abierto</option>
                            <option value="Cerrado">Cerrado</option>
                            <option value="En Atención">En Atención</option>
                        </select>
                        <label>Estatus</label>
                    </div>
                    <div class="col s12">
                        <label class="left">Identificación del Riesgo</label>
                        <input type="date" v-model="nFechaIdent">
                    </div>                    
                </div>

                <div style="padding: 10px; height: 430px; margin-top: -32px;">
                    <h5 class="light left-align" style="margin-bottom: 20px;">Lista de Consecuencias</h5>
                    <div>
                        <ul class="collapsible" style="max-height: 320px; display: block; overflow-y: auto;">
                            <li v-for="liCon of dataConsecuencia" class="left-align">
                                <div class="collapsible-header">
                                    <i class="material-icons">call_merge</i>
                                    {{liCon.consecuenciaCon}}
                                    <!-- Calificación VUE -->

                                    <span v-if="parseInt(liCon.calificaRCon) <= 10">
                                        <div class="green-text text-darken-1">
                                            <i class="material-icons right">check</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liCon.calificaRCon) > 10 && parseInt(liCon.calificaRCon) <= 20">
                                        <div class="yellow-text text-darken-2">
                                            <i class="material-icons right">wb_sunny</i>
                                        </div>
                                    </span>
                                    <span v-else-if="parseInt(liCon.calificaRCon) > 20 && parseInt(liCon.calificaRCon) <= 30">
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
                                    <span v-if="liCon.estatusCon === 'Abierto'" class="new badge red" data-badge-caption="A">
                                        1
                                    </span>
                                    <span v-if="liCon.estatusCon === 'En Atención'" class="new badge orange" data-badge-caption="P">
                                        1
                                    </span>
                                </div>
                                <div class="collapsible-body white" style="font-size: .9em;">
                                    <div class="row" style="margin: 0px; padding: 0px;">
                                        <!-- <a href="#"> -->
                                        <a
                                            :href="'../responsables/pro.app?nomProceso=${nomProceso}&nomProcedimiento=${nomProcedimiento}&nomCausa=${nomCausa}&nomConsec='+liCon.consecuenciaCon+'&cali='+liCon.calificaRCon+'&estatus='+liCon.estatusCon">
                                            <div class="col s7 m8 left-align grey-text waves-effect waves-block" style="font-size: .9em;">
                                                <b>Calificación del Riesgo:</b>
                                                <br>
                                                <!-- Calificación VUE -->

                                                <span v-if="parseInt(liCon.calificaRCon) <= 10">
                                                    <div class="green-text text-darken-1" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">check</i>
                                                        <span style="font-size: 2em;">{{liCon.calificaRCon}} - Bajo</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liCon.calificaRCon) > 10 && parseInt(liCon.calificaRCon) <= 20">
                                                    <div class="yellow-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">wb_sunny</i>
                                                        <span style="font-size: 2em;">{{liCon.calificaRCon}} - Medio</span>
                                                    </div>
                                                </span>
                                                <span v-else-if="parseInt(liCon.calificaRCon) > 20 && parseInt(liCon.calificaRCon) <= 30">
                                                    <div class="orange-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">warning</i>
                                                        <span style="font-size: 2em;">{{liCon.calificaRCon}} - Alto</span>
                                                    </div>
                                                </span>
                                                <span v-else>
                                                    <div class="red-text text-darken-2" style="display: flex; align-items: center;">
                                                        <i class="material-icons left">whatshot</i>
                                                        <span style="font-size: 2em;">{{liCon.calificaRCon}} - Critico</span>
                                                    </div>
                                                </span>
                                                
                                                <!-- Calificación VUE -->
                                                <b>Proceso:</b> {{liCon.procesoCon}}
                                                <br>
                                                <b>Procedimiento:</b> {{liCon.procedimientoCon}}
                                                <br>
                                                <b>Causa:</b> {{liCon.causaCon}}
                                                <br>
                                                <b>Estatus:</b>
                                                <span v-if="liCon.estatusCon === 'Abierto'">
                                                    <span class="red-text">{{liCon.estatusCon}}</span>
                                                </span>
                                                <span v-else-if="liCon.estatusCon === 'En Atención'">
                                                    <span class="orange-text">{{liCon.estatusCon}}</span>
                                                </span>
                                                <span v-else>
                                                    <span class="green-text">{{liCon.estatusCon}}</span>
                                                </span>
                                                 
                                                <br>
                                                <b>Fecha de Identificación del Riesgo:</b> {{liCon.fechaIdentRCon}}
                                                <br>
                                                <div style="font-size: .9em;">
                                                    <b>Area:</b> {{liCon.areaCon}} - {{liCon.idUsuarioCon}}
                                                    <br>
                                                    <i>Alta: {{liCon.fechaHoraRegCon}}</i>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="col s5 m4">
                                            <button class="btn blue darken-4 white-text waves-effect waves-light"
                                                @click="btnEditar(liCon.id, liCon.consecuenciaCon, liCon.probabilidadCon, liCon.impactoCon, liCon.estatusCon, liCon.fechaIdentRCon)"><i
                                                    class="material-icons">edit</i></button>
                                            <button class="btn grey white-text waves-effect waves-light"
                                                @click="btnEliminar(liCon.id, liCon.consecuenciaCon)"><i
                                                    class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col s12">
                        <div class="left" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="../causas/pro.app?nomProceso=${nomProceso}&nomProcedimiento=${nomProcedimiento}" class="btn blue darken-4"><i
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
            optConsecuencias: ['Ambiental','Economica','Imagen','Legales o Normativa','Operativa','Otros'],
            dataConsecuencia: [],
            nConsecuencia: '',
            nPro: '',
            nImp: '',
            totCalR: 0,
            iconCalifica: '',
            nEstatus:'',
            nFechaIdent: '',
            calResBase: ''
        }
    },
    methods: {
            btnEditar: async function (id, consecuenciaCon, probabilidadCon, impactoCon, estatusCon, fechaIdentRCon) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="row"><div class="col s12"><label class="left">Consecuencia:</label><select class="browser-default" id="consecuenciaCon"><option value="'+ consecuenciaCon +'" disabled selected>'+ consecuenciaCon +'</option><option value="Ambiental">Ambiental</option><option value="Economica">Economica</option><option value="Imagen">Imagen</option><option value="Legales o Normativa">Legales o Normativa</option><option value="Operativa">Operativa</option><option value="Otros">Otros</option></select></div><div class="col s6"><label class="left">Probabilidad:</label><select class="browser-default" id="probabilidadCon"><option value="'+ probabilidadCon +'" disabled selected>'+ probabilidadCon +'</option><option value="2">2</option><option value="5">5</option><option value="7">7</option><option value="9">9</option></select></div><div class="col s6"><label class="left">Impacto</label><select class="browser-default" id="impactoCon"><option value="'+ impactoCon +'" disabled selected>'+ impactoCon +'</option><option value="2">2</option><option value="4">4</option><option value="6">6</option></select></div><div class="col s6"><label class="left">Estatus</label><select class="browser-default" id="estatusCon"><option value="'+ estatusCon +'" disabled selected>'+ estatusCon +'</option><option value="Abierto">Abierto</option><option value="Cerrado">Cerrado</option><option value="En Atención">En Atención</option></select></div><div class="col s6"><label class="left">Identificación del Riesgo</label><input type="date" id="fechaIdentRCon" value="' + fechaIdentRCon + '"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#3085d6',
                }).then((result) => {
                    if (result.value) {
                        consecuenciaCon = document.getElementById('consecuenciaCon').value,
                        probabilidadCon = document.getElementById('probabilidadCon').value,
                        impactoCon = document.getElementById('impactoCon').value,
                        estatusCon = document.getElementById('estatusCon').value,
                        fechaIdentRCon = document.getElementById('fechaIdentRCon').value,

                        this.editar(id, consecuenciaCon, probabilidadCon, impactoCon, estatusCon, fechaIdentRCon);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: function (id, consecuenciaCon) {
                Swal.fire({
                    title: '¿Está seguro de borrar el registro: ' + consecuenciaCon + " ?",
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
                axios.post('../listaConsecuencias/crud.app', {
                    opcion: 4
                }).then(response => {
                    this.dataConsecuencia = response.data;
                });
            },

            //Procedimiento CREAR.
            alta() {
                axios.post('../listaConsecuencias/crud.app', {
                    opcion: 1,
                    consecuenciaCon: this.nConsecuencia,
                    probabilidadCon: this.nPro,
                    impactoCon: this.nImp,
                    calificaRCon: this.totCalR,
                    estatusCon: this.nEstatus,
                    fechaIdentRCon: this.nFechaIdent,
                }).then(response => {
                    this.listaDatos();
                });

                this.nConsecuencia = "",
                this.nPro = "",
                this.nImp = "",
                this.nEstatus = "",
                this.nFechaIdent = ""

            },

            //Procedimiento EDITAR.
            editar(id, consecuenciaCon, probabilidadCon, impactoCon, estatusCon, fechaIdentRCon) {
                axios.post('../listaConsecuencias/crud.app', {
                    opcion: 2,
                    id: id,
                    consecuenciaCon: consecuenciaCon,
                    probabilidadCon: probabilidadCon,
                    impactoCon: impactoCon,
                    estatusCon: estatusCon,
                    fechaIdentRCon: fechaIdentRCon
                }).then(response => {
                    this.listaDatos();
                });
            },

            //Procedimiento BORRAR.
            borrar(id) {
                axios.post('../listaConsecuencias/crud.app', {
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
    computed: {
        sumaRiesgos(){
            this.totCalR = 0
            this.totCalR = this.nPro * this.nImp
            return this.totCalR
        },
        colorCalificacion () {
            return {
                'green-text text-darken-1': this.sumaRiesgos <= 10,
                'yellow-text text-darken-2': this.sumaRiesgos > 10 && this.sumaRiesgos <= 20,
                'orange-text text-darken-2 ': this.sumaRiesgos > 20 && this.sumaRiesgos <= 30,
                'red-text text-darken-2': this.sumaRiesgos > 30,
            }
        },
        figuraIcon () {
            
            if(this.sumaRiesgos <= 10){
                this.iconCalifica = 'check'
                return this.iconCalifica
            }else if(this.sumaRiesgos > 10 && this.sumaRiesgos <= 20){
                this.iconCalifica = 'wb_sunny'
                return this.iconCalifica
            }else if(this.sumaRiesgos > 20 && this.sumaRiesgos <= 30){
                this.iconCalifica = 'warning'
                return this.iconCalifica
            }else{
                this.iconCalifica = 'whatshot'
                return this.iconCalifica
            }
        },
        colorCalificacionLista () {
            return {
                'green-text text-darken-1': this.sumaRiesgos <= 10,
                'yellow-text text-darken-2': this.sumaRiesgos > 10 && this.sumaRiesgos <= 20,
                'orange-text text-darken-2 ': this.sumaRiesgos > 20 && this.sumaRiesgos <= 30,
                'red-text text-darken-2': this.sumaRiesgos > 30,
            }
        },
    },
})