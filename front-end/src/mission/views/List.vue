<template>
  <div>
    <Menu />
    <h2><strong>Missões</strong></h2>
    <hr />
    <div>
      <b-row>
        <b-col class="col1Mission" v-if="isAdm && !hasFinished">
          <router-link
            :to="{
            path: '/mission',
            query: {isAdm: isAdm, userId: user_id}
          }"
            class="button is-small is-primary"
          >
          <b-button variant="primary">Nova Missão</b-button>
          </router-link>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-card>
            <div class="divTable">
              <b-table
                :items="items"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                responsive="sm"
              >
                <template #cell(actions)="row">
                  <router-link
                    :to="{
                    path: '/space-shuttle',
                    query: {mission_id: row.item.id}
                  }"
                    class="button is-small is-primary"
                  >
                    <b-button size="sm" @click="controlPanel(row.item)" v-if="row.item.concluída == 'NÃO'" class="mr-1" variant="primary">
                      Painel de Controle
                    </b-button>
                  </router-link>
                </template>
              </b-table>
            </div>
          </b-card>
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
      sortBy: "tipo_usuário",
      sortDesc: false,
      fields: [
        { key: "missão", sortable: false },
        { key: "usuário", sortable: false },
        { key: "tipo", sortable: false },
        { key: "concluída", sortable: false },
        { key: "criada_em", sortable: false },
        { key: 'actions', label: 'Ação' },
      ],
      items: [],
      totalRows: 0,
      currentPage: 1,
      perPage: 10,
      user_id: 0,
      isAdm: false,
      hasFinished: false
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
    controlPanel(row) {
      console.log(row)
    },  
    listMissions () {
      api
      .get("mission/all").then((response) => {
        if (response.status === 200) {
          this.items = []
          this.totalRows = response.data.length
          response.data.forEach(element => {
            if (element.statusMission == 'NÃO') {
              this.hasFinished = true
            }
            this.items.push({
              criada_em: element.created_at,
              tipo: element.typeUserName,
              concluída: element.statusMission,
              usuário: element.user,
              missão: element.name,
              id: element.id
            })
          })
        }
        if (response.status === 404) {
          console.log(response.data)
        }
      })
      .catch((error) => {
        console.log(error)
      })
    },
    async getUserData(user_id) {
      try {
        const response=await api
          .get("user/show/"+user_id)
        if(response.status===200) {
          this.user_id = response.data.id
          this.isAdm = response.data.isAdmin
        }
      } catch(error) {
        if(error.response.data.error) {
          this.errorMessage("", error.response.data.error)
        }
      }
  }
  },
  async mounted() {
    await this.getUserData(JSON.parse(localStorage.getItem("pulses_dadosUsuario")).id).then(() => {
    this.listMissions()
    })
  }
}
</script>

<style>
.divTable {
  border: 1px solid lightgray;
}
.card {
  margin: 0px 20px 0px 20px;
  background-color: lightblue;
}
.col1Mission {
  display: flex;
  justify-content: flex-end;
  margin: 0px 20px 10px 0px;
}
.button2 {
  margin: 0px 10px 0px 0px;
}
</style>