import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createPinia } from "pinia";
import PrimeVue from "primevue/config";

import Noir from "@/presets/Noir";

const app = createApp(App);
const pinia = createPinia();

app.use(pinia);

app.use(PrimeVue, {
  theme: {
    preset: Noir,
    options: {
      prefix: "p",
      darkModeSelector: ".p-dark"
    }
  }
});

app.config.globalProperties.sliderPro = sliderPro;

app.mount("#slider-pro-vue-app");
