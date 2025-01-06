import { createRouter, createWebHistory } from "vue-router";
import HelloWorld from "./page/HelloWorld.vue";
import AboutPage from "./page/AboutPage.vue";
import MenuComponent from "./components/MenuComponent.vue";
import TestPage from "./page/TestPage.vue";
import LoginPage from "./page/LoginPage.vue";
import RegisterPage from "./page/RegisterPage.vue";
import ShoppingCart from "./page/ShoppingCart.vue";
import ProductOverviews from "./page/ProductOverviews.vue";
import TestA from "./page/TestA.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: MenuComponent },
    { path: "/HelloWorld", component: HelloWorld },
    { path: "/TestPage", component: TestPage },
    { path: "/AboutPage", component: AboutPage },
    { path: "/Login", component: LoginPage },
    { path: "/Register", component: RegisterPage },
    { path: "/ShoppingCart", component: ShoppingCart },
    { path: "/ProductOverviews", component: ProductOverviews },
    { path: "/TestA", component: TestA },
  ],
});
export default router;
