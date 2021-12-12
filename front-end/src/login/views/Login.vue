<template>
  <div>
    <b-row class="vh-100 vw-100 row-login">
      <b-col sm="3">
      </b-col>
      <b-col
        sm="6"
        class="d-flex justify-content-center align-items-center"
      >
        <b-card class="text-center card1">
        <div>
          <h2 class="text-center mb-5 title-login">Faça o login</h2>
          <b-form>
            <b-form-group label="E-mail" label-for="email">
              <b-form-input
                type="email"
                placeholder="E-mail"
                autocomplete="off"
                required
                v-model="form.email"
              >
              </b-form-input>
            </b-form-group>
            <b-form-group label-for="password">
              <label class="d-flex justify-content-between">
                Senha
              </label>
              <b-form-input
                id="password"
                type="password"
                placeholder="Digite sua senha"
                required
                v-model="form.password"
              ></b-form-input>
            </b-form-group>
            <div class="divBtnEnter">
              <b-button class="button1" block variant="primary" @click="login">Entrar</b-button>
            </div>
          </b-form>
        </div>
        </b-card>
      </b-col>
      <b-col sm="3"></b-col>
    </b-row>
    <Footer />
  </div>
</template>

<script>
import Footer from "../../components/Footer.vue"
import Swal from "sweetalert2"
import axios from "axios"
export default {
  components: {
    Footer,
  },
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    errorMessage (title, message) {
      Swal.fire({
        icon: 'error',
        title: title,
        text: message,
      })
    }, 
    login () {
     if (!this.form.email || !this.form.password) {
       this.errorMessage('','E-email e senha devem ser informados.')
       return
     }
     axios
      .post("http://localhost:8000/api/authenticate/login", {
        email: this.form.email,
        password: this.form.password,
      })
      .then((response) => {
        if (response.status === 200) {
          const user = {
            id: response.data.user.id,
            name: response.data.user.name,
            email: response.data.user.email,
            typeUser: response.data.user.typeUser,
            accessToken: response.data.accessToken
          }
          localStorage.removeItem('pulses_dadosUsuario')
          localStorage.pulses_dadosUsuario = JSON.stringify(user)
          this.$router.push('/missions')
        }
      })
      .catch((error) => {
        if (error.response.data.error) {
          this.errorMessage('', error.response.data.error)
        }
      })
    }
  },
  mounted () {
    // localStorage.removeItem('pulses_dadosUsuario')
  }
};
</script>

<style>

.row1 {
 background-color: springgreen;
}
.button1 {
  padding-left: 50px;
  padding-right: 50px;
  margin: 20px 0px 0px 0px;
}
.card1 {
  background-color: #f7f7f7;
}
*, /*resetar o estilo da página*/
*::after,
*::before {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
}
 
.row-login {
  margin-left: 0;
}
 
.title-login {
  font-weight: bold;
}
.divBtnEnter {
   padding: 20px; 
   display: flex; 
   justify-content: center;
}
</style>