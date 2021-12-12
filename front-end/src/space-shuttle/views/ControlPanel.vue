<template>
  <div>
    <Menu />
    <h2><strong>Painel de controle</strong></h2>
    <hr />
    <b-row cols="2">
      <b-col class="colun1">
        <b-card
          header="Quadro de Instrumentos"
          header-tag="header"
          footer=""
          footer-tag="footer"
          title="lista de Comandos"
          class="card"
        >
          <b-card-text
            >"Execute atenciosamente cada comando, o sucesso da missão depende
            de você!"</b-card-text
          >
          <div>
            <b-row>
              <b-col>
                <b-button
                  class="button1"
                  @click="executeCommand('Ligar propulsores', false, false)"
                  variant="primary"
                  >Ligar propulsores</b-button
                >
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  @click="executeCommand('Iniciar Lançamento', true, false)"
                  variant="primary"
                  >Iniciar Lançamento</b-button
                >
              </b-col>
            </b-row>
            <b-row>
              <b-col>
                <b-button
                  class="button1"
                  @click="executeCommand('Acelerar', false, false)"
                  variant="primary"
                  >Acelerar
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Desacelerar', false, false)"
                  >Desacelerar
                </b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col class="col1">
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Cima', false, false)"
                  >Cima
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="
                    executeCommand(
                      'Girar 90° Graus sob próprio eixo (sentido horário)',
                      false,
                      false
                    )
                  "
                  >Girar 90° Graus sob próprio eixo (sentido horário)
                </b-button>
              </b-col>
              <b-col class="col1">
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Baixo', false, false)"
                  >Baixo
                </b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Esquerda', false, false)"
                  >Esquerda
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Direita', false, false)"
                  >Direita
                </b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Ativar trem de polso', false, false)"
                  >Ativar trem de polso
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="
                    executeCommand('Desativar trem de polso', false, false)
                  "
                  >Desativar trem de polso
                </b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col>
                <b-button
                  class="button1"
                  variant="primary"
                  @click="executeCommand('Desligar propulsores', false, false)"
                  >Desligar propulsores
                </b-button>
              </b-col>
              <b-col>
                <b-button
                  class="button1"
                  @click="executeCommand('Encerrar Missão', true, true)"
                  variant="primary"
                  >Encerrar Missão</b-button
                >
              </b-col>
            </b-row>
          </div>
        </b-card>
      </b-col>
      <b-col>
        <b-card header="Log de Comandos">
          <div class="divTable">
            <b-table
              :items="items"
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              responsive="sm"
            ></b-table>
          </div>
          <b-col sm="7" md="6" class="my-1">
            <b-pagination
              v-model="currentPage"
              :total-rows="totalRows"
              :per-page="perPage"
              align="fill"
              size="sm"
              class="my-0"
            ></b-pagination>
          </b-col>
        </b-card>
      </b-col>
    </b-row>
    <Footer />
  </div>
</template>

<script>
import api from "../../services/api"
import Menu from "../../components/Menu.vue"
import Footer from "../../components/Footer.vue"
import Swal from "sweetalert2"
export default {
  components: {
    Menu,
    Footer,
  },
  data() {
    return {
      sortBy: "tipo_usuário",
      sortDesc: false,
      fields: [
        { key: "comando", sortable: false },
        { key: "usuario", sortable: false },
        { key: "tipo_usuario", sortable: false },
        { key: "data_hora_comando", sortable: false },
      ],
      items: [],
      totalRows: 0,
      currentPage: 1,
      perPage: 5,
      user_id: 0,
      mission_id: this.$route.query.mission_id,
      isAdm: null,
      mission: {},
    }
  },
  methods: {
    errorMessage(title, message) {
      Swal.fire({
        icon: "error",
        title: title,
        text: message,
      })
    },
    executeCommand(descCommand, isAdm, finish) {
      if (isAdm === true && this.isAdm === false) {
        this.errorMessage(
          "Oops...",
          "Apenas usuários da base de lançamento(perfil administrador) podem executar esse comando."
        )
        return
      }
      Swal.fire({
        title: "Tem certeza que deseja executar o comando?",
        text: "Você não será capaz de reverter isso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, Execute!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.saveCommand(descCommand)
          if (finish) {
            this.finishMission()
          }
        }
      })
    },
    finishMission() {
      api
        .post("mission/finish", {
          id: this.mission_id,
          user_id: this.user_id,
        }).then((response) => {
          if (response.status === 201) {
            this.logCommandsMission()
            Swal.fire(
              "Comando executado!",
              "Seu Comando foi Executado com sucesso.",
              "success"
            )
          }
        })
        .catch((error) => {
          console.log(error)
          if (error.response.data.error) {
            console.log(error.response.data.error)
          }
        })
    },
    saveCommand(descCommand) {
      api
        .post("log-mission/store", {
          description: descCommand,
          mission_id: this.mission_id,
          user_id: this.user_id,
        }).then((response) => {
          if (response.status === 201) {
            this.logCommandsMission()
            Swal.fire(
              "Comando executado!",
              "Seu Comando foi Executado com sucesso.",
              "success"
            )
          }
        })
        .catch((error) => {
          console.log(error)
          if (error.response.data.error) {
            console.log(error.response.data.error)
          }
        })
    },
    logCommandsMission() {
      api
        .get("log-mission/commands-mission/" + this.mission_id).then((response) => {
          if (response.status === 200) {
            this.items = []
            this.totalRows = response.data.length
            response.data.forEach((element) => {
              this.items.push({
                data_hora_comando: element.created_at,
                tipo_usuario: element.typeUserName,
                usuario: element.user,
                comando: element.description,
              })
            })
          }
          if (response.status === 404) {
            console.log(response.data)
          }
        })
        .catch((error) => {
          if (error.response.data.error) {
            console.log(error.response.data.error)
          }
        })
    },
    getUserData(user_id) {
      return api
        .get("user/show/" + user_id).then((response) => {
            if (response.status === 200) {
              this.user_id = response.data.id
              this.isAdm = response.data.isAdmin
            }
        })
        .catch((error) => {
          console.log(error)
          if (error.response.data.error) {
            this.errorMessage("", error.response.data.error)
          }
        })
    },
  },
  async mounted() {
    await this.getUserData(JSON.parse(localStorage.getItem("pulses_dadosUsuario")).id).then(() => {
      this.logCommandsMission()
    })
  }
}
</script>

<style scoped>
.divTable {
  border: 1px solid lightgray;
}
.col1 {
  padding-top: 13px;
}
.colun1 {
  padding-left: 25px;
}
.col2 {
  padding-right: 25px;
  overflow: scroll;
}
.card {
  height: 680px;
  background-color: lightblue;
}
.button1 {
  margin: 5px 0px 5px 0px;
  justify-content: center;
  width: 100%;
}
</style>