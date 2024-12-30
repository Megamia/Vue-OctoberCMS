import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "./style.css";
import { Menu, Switch } from "ant-design-vue";

createApp(App).use(router).use(Menu).use(Switch).mount("#app");
