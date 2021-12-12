export default [
  {
    path: "/missions",
    name: "missions.list",
    component: () => import("./views/List.vue"),
  },
  {
    path: "/mission",
    name: "mission.new",
    component: () => import("./views/Register.vue"),
  },
]
