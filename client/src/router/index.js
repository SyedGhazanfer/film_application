import { createRouter, createWebHistory } from "vue-router";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import NotFound from "../pages/404.vue";
import Home from "../pages/Home.vue";
import FilmDetail from "../pages/FilmDetailPage.vue";
import CreateFilm from "../pages/CreateFilm.vue";
import Layout from "../pages/layout/Layout.vue";
import { LoginSuccess } from "../config/helper";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Landing Page",
      beforeEnter: () => {
        if (!LoginSuccess()) router.push("/login");
      },
      component: Layout,
      redirect: "/films",
      children: [
        { path: "/films", component: Home },
        { path: "/films/:id", component: FilmDetail },
        { path: "/create/film", component: CreateFilm },
        {
          path: "/:pathMatch(.*)*",
          name: "404",
          component: NotFound,
        },
      ],
    },
    {
      path: "/login",
      name: "Login",
      component: Login,
      beforeEnter: () => {
        if (LoginSuccess()) router.push("/");
      },
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
      beforeEnter: () => {
        if (LoginSuccess()) router.push("/");
      },
    },

    {
      path: "/:pathMatch(.*)*",
      name: "404",
      component: NotFound,
    },
  ],
});

export default router;
