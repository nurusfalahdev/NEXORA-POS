import Dashboardview from "@/views/dashboardview.vue";
import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      redirect: "/dashboard",
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboardview,
    },
    {
      path: "/produk",
      name: "produk",
      component: () => import("@/views/produkview.vue"),
    },
    // {
    //   path: "/kirim",
    //   name: "kirim",
    //   component: () => import("@/views/kirimview.vue"),
    // },
    // {
    //   path: "/terjual",
    //   name: "terjual",
    //   component: () => import("@/views/terjualview.vue"),
    // },
  ],
});

export default router;
