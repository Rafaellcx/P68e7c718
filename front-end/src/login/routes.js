export default [
  {
    path: "/login",
    name: "login",
    component: () => import("./views/Login.vue"),
  },  
  {
    path: "/login/new",
    name: "login.new",
    component: () => import("./views/Register.vue"),
  },  
  {
    path: "/login/list",
    name: "login.list",
    component: () => import("./views/List.vue"),
  },  
]
