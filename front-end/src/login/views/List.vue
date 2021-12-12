<template>
  <div>
    <Menu />
    <h2><strong>Usuários</strong></h2>
    <hr />
    <div>
      <b-row>
        <b-col class="col1User">
          <b-button variant="primary" @click="newUser">Novo Usuário</b-button>
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <b-card header="" header-tag="" footer="" footer-tag="" title="">
            <div>
            <b-table
              :items="items"
              :fields="fields"
              :current-page="currentPage"
              :per-page="perPage"
              :sort-by.sync="sortBy"
              :sort-desc.sync="sortDesc"
              responsive="sm"
            >
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
        { key: "usuário", sortable: false },
        { key: "e_mail", sortable: false },
        { key: "tipo", sortable: false },
        { key: "criada_em", sortable: false },
      ],
      items: [],
      totalRows: 0,
      currentPage: 1,
      perPage: 10,
      user_id: 0,
      isAdm: false,
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
    newUser () {
      if (!this.isAdm) {
        this.errorMessage(
          "Oops...",
          "Apenas usuários com perfil administrador criar um novo usuário."
        )
        return
      }
      this.$router.push('/login/new')
    },
    listUsers () {
      api
      .get("user/all").then((response) => {
        if (response.status === 200) {
          this.items = []
          this.totalRows = response.data.length
          response.data.forEach(element => {
            this.items.push({
              criada_em: element.created_at,
              tipo: element.typeUser,
              usuário: element.name,
              e_mail: element.email,
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
    this.listUsers()
    })
  }
}
</script>

<style>
.card {
  margin: 0px 20px 0px 20px;
  background-color: lightblue;
}
.button1 {
  margin: 0px 20px 10px 0px;
}
.col1User {
  display: flex;
  justify-content: flex-end;
  margin: 0px 20px 10px 0px;
}
.button2 {
  margin: 0px 10px 0px 0px;
}
.divTable {
  border: 1px solid lightgray;
}
</style>