<template>
  <div>
  <Menu/>
  <h2><strong>Nova Missão</strong></h2>
  <hr>
  <div>
    <b-card class="text-center card1">
      <b-row>
        <b-col>
          <b-row>
            <b-col sm="2">
              <label class="lab1" for="input-default">Informe o nome da nova Missão:</label>
            </b-col>
            <b-col sm="10">
              <b-form-input class="input1" v-model="nameMission"  placeholder="Informe o nome da Missão"></b-form-input>
            </b-col>
          </b-row>
        </b-col>
      </b-row>
    </b-card>
    <b-row>
      <b-col class="col1MissionRegister">
          <b-button variant="primary" @click="saveMission">Confirmar</b-button>
          <b-button class="btnBackMission" @click="missionBack">Voltar</b-button>
      </b-col>
    </b-row>
  </div>
  <Footer/>
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
      user_id: this.$route.query.userId,
      isAdm: this.$route.query.isAdm,
      nameMission: null
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
    saveMission () {
      if (!this.isAdm) {
        this.errorMessage('Oops...', 'Apenas usuários com perfil "Administrador" poderão criar uma nova missão.')
        this.$router.push('/mission')
      }
      api
      .post("mission/store", {
        name: this.nameMission,
        user_id: this.user_id,
      })
      .then((response) => {
        if (response.status === 201) {
          Swal.fire(
            "",
            "Missão Cadastrada com sucesso.",
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
  
        if (error.response.data.errors.user_id) {
            this.errorMessage('', error.response.data.errors.user_id[0])
        }
        if (error.response.data.errors.name) {
            this.errorMessage('', error.response.data.errors.name[0])
        }
      })
    },
    missionBack () {
      this.$router.push('/missions')
    }  
  },
  mounted() {
    if (!this.$route.query.isAdm) {
      this.$router.push('/missions')
      }
  }
}
    

</script>

<style>
.card1 {
  margin: 20px 10px 0px 10px;
}
.lab1 {
  margin: 7px 0px 0px 0px ;
  padding-left: 19%;
}
.input1 {
  width: 40%;
}
.col1MissionRegister {
  padding-top: 20px;
  display: flex;
  justify-content: center;
}
.btnBackMission {
 margin-left: 10px;
}
</style>