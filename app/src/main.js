import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import "./style.css";
import { Menu, Switch, Image } from "ant-design-vue";

createApp(App).use(router).use(Menu).use(Switch).use(Image).mount("#app");
