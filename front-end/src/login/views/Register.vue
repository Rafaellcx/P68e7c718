<template>
  <div>
    <Menu />
    <h2><strong>Cadastrar Usuário</strong></h2>
    <div class="card1">
        <b-card class="text-center">
          <b-row>
            <b-col>
              <b-form-group
                class="form1"
                label="Name:"
                label-for="input-2"
              >
                <b-form-input
                  v-model="form.name"
                  required
                ></b-form-input>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group
                class="form1"
                label="E-mail:"
                label-for="input-1"
                description=""
              >
                <b-form-input
                  v-model="form.email"
                  type="email"
                  required
                ></b-form-input>
              </b-form-group>
            </b-col>
          </b-row>
          <b-row>
            <b-col>
              <b-form-group
                class="form1"
                label="Senha:"
                label-for="input-2"
              >
                <b-form-input
                  v-model="form.password"
                  required
                  type="password"
                ></b-form-input>
              </b-form-group>
            </b-col>
            <b-col>
              <b-form-group
                class="form1"
                label="Confirmar Senha:"
                label-for="input-2"
              >
                <b-form-input
                  v-model="confirmPassword"
                  required
                  type="password"
                ></b-form-input>
              </b-form-group>
            </b-col>
          <b-row>
          </b-row>
            <b-col>
              <b-form-group
                class="form1"
                label="Tipo de Usuário:"
                label-for="input-3"
              >
                <b-form-select class="sel1"
                  v-model="typeUser"
                  :options="options"
                  required
                ></b-form-select>
              </b-form-group>
            </b-col>
            <b-col>
            </b-col>
          </b-row>
        </b-card>
        <b-row>
          <b-col class="col1">
            <b-button @click="saveUser" variant="primary">Salvar</b-button>
            <b-button class="btnBackUser" @click="userBack">Voltar</b-button>
          </b-col>
        </b-row>
    </div>
    <Footer />
  </div>
</template>

<script>
import Menu from "../../components/Menu.vue"
import Footer from "../../components/Footer.vue"
import Swal from "sweetalert2"
import api from "../../services/api"
export default {
  components: {
    Menu,
    Footer,
  },
  data() {
    return {
      confirmPassword: null,
      form: {
        name: null,
        email: null,
        password: null
      },
      options: [],
      isAdm: null,
      typeUser: null,
    }
  },
  methods: {
    errorMessage (title, message) {
      Swal.fire({
        icon: 'error',
        title: title,
        text: message,
      })
    },  
    getUserData(user_id) {
      return api
        .get("user/show/" + user_id)
        .then((response) => {
          if (response.status === 200) {
            this.isAdm = response.data.isAdmin
          }
        })
        .catch((error) => {
          if (error.response.data.error) {
            this.errorMessage("", error.response.data.error)
          }
        })
    },
    saveUser () {
       console.log('this.typeUser:', this.typeUser)
       if (!this.isAdm) {
         this.errorMessage("", 'Apenas usuários Administradores podem criar Novos usuários.')
         return
       } 
       if (!this.typeUser) {
         this.errorMessage("", 'Tipo de Usuário não selecionado.')
         return
       }
       if (this.form.password !== this.confirmPassword) {
         this.errorMessage("", 'Senha não confere.')
         return
       }
       api
      .post("user/store", {
        type_user_id: this.typeUser,  
        name: this.form.name,
        email: this.form.email,
        password: this.form.password,
      })
      .then((response) => {
        if (response.status === 201) {
          Swal.fire(
            "",
            "Usuário Cadastrado com sucesso.",
            "success"
          )
        }
        this.$router.push({ path: '/missions' })
      })
      .catch((error) => {
        if (error.response.data.status === 401) {
          this.errorMessage("", error.response.data.erro)
          this.$router.push({ path: '/login' })  
        }
  
        if (error.response.data.errors.type_user_id) {
          this.errorMessage('', error.response.data.errors.type_user_id[0])
        }
        if (error.response.data.errors.email) {
          this.errorMessage('', error.response.data.errors.email[0])
        }
        if (error.response.data.errors.name) {
          this.errorMessage('', error.response.data.errors.name[0])
        }
        if (error.response.data.errors.password) {
          this.errorMessage('', error.response.data.errors.password[0])
        }
      }) 
    },
    userBack () {
      this.$router.push('/login/list')
    },
    getTypeUser () {
      api
        .get("type-user/all")
        .then((response) => {
          if (response.status === 200) {
            response.data.forEach((type) => {
              this.options.push({
                value: type.id,
                text: type.name
              })
            })
          }
        })
        .catch((error) => {
          if (error.response.data.error) {
            this.errorMessage("", error.response.data.error)
          }
        })  
    }    
  },
  async mounted() {
    const token = JSON.parse(localStorage.getItem("pulses_dadosUsuario"))
    await this.getUserData(token.id).then(() => {
    this.getTypeUser()
    })
  },
}
</script>

<style>
.card1 {
  margin: 0px 20px 0px 20px;
}
.form1 {
  margin: 20px 0px 20px 0px;
}
.sel1 {
  height: 38px;
  width: 100%;
  margin: 0;
  border-color: lightgray;
  background-color: white;
  border-radius: 0.25rem;
  font-family: inherit;  
}
.col1 {
  padding-top: 20px;
  display: flex;
  justify-content: center;
}
.btnBackUser {
 margin-left: 10px;
}
</style>