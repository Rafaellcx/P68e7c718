import Vue from 'vue'
import VueRouter from 'vue-router'
// import Home from '../views/Home.vue'
import ControlPanel from "../space-shuttle/routes"
import Missions from "../mission/routes"
import Login from "../login/routes"

Vue.use(VueRouter)

const routes = [
  ...ControlPanel,
  ...Missions,
  ...Login,
  {
    path: "/",
    name: "login",
    component: () => import("../login/views/Login.vue"),
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
