import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import PrimeVue from "primevue/config";

import Noir from "@/presets/Noir";

const app = createApp(App);
app.use(PrimeVue, {
  theme: {
    preset: Noir,
    options: {
      prefix: "p",
      darkModeSelector: ".p-dark"
    }
  }
});

app.mount("#slider-pro-vue-app");
