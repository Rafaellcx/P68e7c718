<template>
  <div>
    <div class="fimMenu">
     <b-row class="row1">
       <b-col class="col1">
         <p><strong>Usuário:</strong> {{dadosUsuario.name}}</p>
         <p style="padding-left: 20px"><strong>Tipo:</strong> {{dadosUsuario.typeUser}}</p>
        </b-col>
       <b-col>
         <div class="menu">
           <b-button-group>
             <b-dropdown right text="Principal">
               <b-dropdown-item to="/missions">Missão</b-dropdown-item>
             </b-dropdown>
             <b-dropdown right text="Usuário">
               <b-dropdown-item to="/login/list">Cadastrar</b-dropdown-item>
             </b-dropdown>
             <b-button @click="login">Sair</b-button>
           </b-button-group>
         </div>
       </b-col>
     </b-row>
      <!-- <div class="menu">
        <b-button-group>
          <b-dropdown right text="Principal">
            <b-dropdown-item to="/missions">Missão</b-dropdown-item>
          </b-dropdown>
          <b-dropdown right text="Usuário">
            <b-dropdown-item to="/login/list">Cadastrar</b-dropdown-item>
          </b-dropdown>
          <b-button @click="login">Sair</b-button>
        </b-button-group>
      </div> -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dadosUsuario: {
        name: '',
        typeUser: ''
      }
      
    }
  },
  methods: {
    login () {
      localStorage.removeItem('pulses_dadosUsuario')
      this.$router.push('/login')
    }
  },
  async mounted() {
    this.dadosUsuario = await JSON.parse(localStorage.getItem("pulses_dadosUsuario"))
  }
}
</script>

<style scoped>
.userData1 {
background-color: red;
height: 200px;
}
.userData2 {
background-color: blue;
height: 200px;
}
.menu {
  background-color:#6c757d;
  display:flex;
  justify-content: flex-end;
}
.row1 {
  display:flex;
  background-color:#6c757d;
}
.col1 {
  background-color:#6c757d;
  display:flex;
  justify-content: flex-start;
  color: white;
  padding: 6px 0px 0px 20px ;
}
.col2 {
  background-color:#6c757d;
  display:flex;
  justify-content: flex-end;
  color: white;
}
.fimMenu {
  padding-bottom: 20px;
}
</style>