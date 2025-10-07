import { ComponentCustomProperties } from "vue";

declare module "@vue/runtime-code" {
  interface ComponentCustomProperties {
    sliderPro: {
      nonce: string;
      ajax_url: string;
    };
  }
}
