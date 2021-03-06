Vue.component('menu-principal', {
    template: /*html*/
        `
        <div>
                <nav>
                    <div class="nav-wrapper blue darken-4">
                        <ul id="nav-mobile" class="left hide-on-med-and-down valign-wrapper">
                            <div class="sidenav-trigger" data-target="menuPrincipal">
                                <li><a href="#"><i class="material-icons left"><img src="../img/icons/menu.svg"></i>Menu</a></li>
                            </div>
                        </ul>
                        <!-- NOMBRE EMPRESA -->
                        <!-- <a href="#" class="brand-logo center"> -->
                        <a href="../inicio/home.app" class="brand-logo center">
                            <!-- <div class="sidenav-trigger" data-target="menuPrincipal"> -->
                            <div>
                                <b>ALSUR</b>
                            </div>
                        </a>
                        <!-- NOMBRE EMPRESA -->
                        <a href="#" data-target="menuPrincipal" class="sidenav-trigger valign-wrapper">
                            <div class="valign-wrapper">
                                <img src="../img/icons/menu.svg">
                            </div>
                        </a>
                        <ul id="nav-mobile" class="right valign-wrapper">
                            <li><a class="dropdown-trigger iconMenuNotifica" href="#" data-target="notificacion" style="width: 220px;"><i class="material-icons"><img src="../img/icons/notifica.svg"></i></a>

                                <!-- Dropdown Notificación -->
                                <!-- <ul id="notificacion" class="dropdown-content">
                                    <li v-for="liNotifica of dataNotifica"><a
                                            href="#!" style="font-size: .8em;">{{liNotifica.accPen}} - {{liNotifica.notaEspecial}}</a></li>
                                </ul> -->
                                
                                <ul class="collection dropdown-content" id="notificacion">
                                    <a :href="'../acciones/pro.app?nomProceso='+liNotifica.procesoAcc+'&nomProcedimiento='+liNotifica.procedimientoAcc+'&nomCausa='+liNotifica.causaAcc+'&nomConsec='+liNotifica.consecuenciaAcc+'&cali='+liNotifica.calificaRAcc+'&estatus='+liNotifica.estatusAcc+'&nomRespAtenRes='+liNotifica.nomRespAtenAcc" v-for="liNotifica of dataNotifica" style="padding: 0px;">
                                        <li class="collection-item avatar" style="font-size: .6em; line-height: 1.3em;">
                                            

                                                <img src="../img/usrLogin.svg" alt="" class="circle">
                                                <p class="left-align blue-text text-darken-4" style="padding: 0px;">
                                                    <b>{{liNotifica.procesoAcc}}</b>
                                                </p>
                                                <p>
                                                    <b>{{liNotifica.procedimientoAcc}}</b>
                                                </p>
                                                <p style="font-style: italic;">{{liNotifica.accionesAcc}}</p>
                                                <p class="red-text">{{liNotifica.notaEspecial}}</p>
                                            
                                            
                                        
                                        </li>
                                    </a>
                                </ul>

                            </li>
                            <li class="hide-on-med-and-down"><a href="#" @click="cerrarSesion">Cerrar sesión<i
                                        class="material-icons right"><img
                                            src="../img/icons/apagar.svg"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <ul id="menuPrincipal" class="sidenav">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <img src="../img/galeria/sidevar.jpg" class="responsive-img">
                            </div>
                            <div class="centrado-h-v">
                                <a href="#user"><img class="circle" src="../img/${imgLoginUsr}"
                                        style="width: 80px; height: 80px;"></a>
                            </div>
                            <a href="#name"><span class="white-text name">${nombre}</span></a>
                            <a href="#email"><span class="white-text email">${correo}</span></a>
                        </div>
                    </li>
                    <li><a href="../inicio/home.app"><i class="material-icons">home</i>Inicio</a></li>
                    <li><a href="../procesos/pro.app"><i class="material-icons">collections_bookmark</i>Procesos</a></li>
                    <li><a href="#!">Sub Menu</a></li>
                    <li>
                        <div class="divider"></div>
                    </li>
                    <li><a class="subheader">Sub Menu</a></li>
                    <li><a href="#" @click="cerrarSesion"><i class="material-icons"><img src="../img/icons/powerDos.svg"
                                    style="width: 20px;"></i><b>Cerrar sesión</b></a></li>
                </ul>
            </div>
                
                `,
    data() {
        return {
            dataNotifica:[]
            
        }
    },

    methods: {
        cerrarSesion() {
            Swal.fire({
                title: '¿Estas seguro de salir?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    window.location = '../index.php';
                }
            })
        },
        listaDatos() {
            axios.post('../notifica/lista.app', {
            }).then(response => {
                this.dataNotifica = response.data;
            });
        },
    },
    created() {
        this.listaDatos();
    },
})
