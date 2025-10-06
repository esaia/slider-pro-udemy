import { ComponentCustomProperties } from "vue";

declare module "@vue/runtime-code" {
  interface ComponentCustomProperties {
    sliderPro: {
      ajax_url: string;
    };
  }
}
