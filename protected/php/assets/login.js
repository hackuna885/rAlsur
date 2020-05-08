Vue.component('login',{
template: /*html*/
`
        <div class="card" style="width: 350px; border-radius: 10px; margin: 10px;">
            <div class="card-image blue darken-4" style="padding: 20px; border-radius: 10px 10px 0px 0px;">
                <div class="white" style="width: 150px; height: 150px; border-radius: 50%; padding: 20px; margin: auto;">
                    <img src="img/logo.svg" style="margin-top: 3px;">
                </div>
            </div>
            <div class="card-content">
                <form action="valida/seguridad.app" method="POST">
                    <div class="input-field">
                        <!-- <div class="prefix"><img class="responsive-img" src="img/icons/usr.svg"></div> -->
                        <input type="email" id="correo" class="validate" required v-model="correoUsr" name="txtUsr">
                        <label for="correo"><img class="responsive-img" src="img/icons/usr.svg" style="margin-right: 5px;">Correo</label>
                    </div>
                    <div class="input-field">
                        <!-- <div class="prefix"><img class="responsive-img" src="img/icons/pw.svg"></div> -->
                        <input type="password" id="password" class="validate" minlength="3" required v-model="passUsr" name="txtPwd">
                        <label for="password"><img class="responsive-img" src="img/icons/pw.svg " style="margin-right: 5px;">Password
                        </label>
                    </div>
                    <div class="section right-align">
                        <span v-if="correoUsr != '' && passUsr != ''">
                            <button class="btn-large blue darken-4 waves-effect waves-light">Continuar</button>
                        </span>
                        <span v-else>
                            <button class="btn-large blue darken-4 disabled">Continuar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
`,
data() {
    return {
        correoUsr: '',
        passUsr:''
    }
},
})

new Vue({
    el: '#app'
})