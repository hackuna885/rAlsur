Vue.component('home-panel',{
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
        <div class="container section">
            <div class="row">
                <div class="col s12 m6 center">
                    <div class="card contenidoCard">
                        <div class="card-title blue darken-4 white-text">Procesos</div>
                        <div class="card-content">
                            <div class="row blue-text text-darken-4">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">collections_bookmark</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 center">
                    <div class="card contenidoCard">
                        <div class="card-title blue darken-4 white-text">Procedimientos</div>
                        <div class="card-content">
                            <div class="row blue-text text-darken-4">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">book</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 center">
                    <div class="card contenidoCard">
                        <div class="card-title blue darken-4 white-text">Riesgos</div>
                        <div class="card-content centrado-h-v">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3 center">
                    <div class="card contenidoCard">
                        <div class="card-title red darken-2 white-text">Riesgos Criticos</div>
                        <div class="card-content">
                            <div class="row red-text text-darken-2">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">whatshot</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3 center">
                    <div class="card contenidoCard">
                        <div class="card-title orange darken-2 white-text">Riesgos Altos</div>
                        <div class="card-content">
                            <div class="row orange-text text-darken-2">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">warning</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3 center">
                    <div class="card contenidoCard">
                        <div class="card-title yellow darken-2 white-text">Riesgos Medios</div>
                        <div class="card-content">
                            <div class="row yellow-text text-darken-2">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">wb_sunny</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m6 l3 center">
                    <div class="card contenidoCard">
                        <div class="card-title green darken-1 white-text">Riesgos Bajos</div>
                        <div class="card-content">
                            <div class="row green-text text-darken-1">
                                <div class="col s6 centrado-h-v">
                                    <i class="material-icons large">check</i>
                                </div>
                                <div class="col s6 centrado-h-v">
                                    <div class="center-align">
                                        <p style="font-size: 3em;">1</p>
                                        <p>Registros</p>
                                    </div>
                                </div>
                            </div>
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
            
        }
    },
})