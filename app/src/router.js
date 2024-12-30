import { createRouter, createWebHistory } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
import AboutPage from "./components/AboutPage.vue";
import HomePage from "./components/HomePage.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: HomePage },
    { path: "/HelloWorld", component: HelloWorld },
    { path: "/AboutPage", component: AboutPage },
  ],
});
export default router;
