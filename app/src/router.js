import { createRouter, createWebHistory } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
import AboutPage from "./components/AboutPage.vue";
import TestPage from "./components/TestPage.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: TestPage },
    { path: "/HelloWorld", component: HelloWorld },
    { path: "/AboutPage", component: AboutPage },
  ],
});
export default router;
