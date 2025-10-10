<script setup lang="ts">
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import UploadImage from "@/components/form/UploadImage.vue";
import SliderSettingTabs from "@/components/UI/SliderSettingTabs.vue";
import { useGlobalStore } from "@/store/useGlobal";
import { storeToRefs } from "pinia";
import { ref } from "vue";

const globalStore = useGlobalStore();
const { activeSlider } = storeToRefs(globalStore);

const title = ref(activeSlider.value?.title || "");
</script>
<template>
  <div v-if="!activeSlider">Slider not found <a :href="sliderPro.plugin_url">go back</a></div>

  <div v-else class="space-y-6">
    <a :href="sliderPro.plugin_url">
      <Button label="Back to sliders list" variant="link" class="mb-2 w-fit !p-0" />
    </a>

    <div class="flex items-center gap-3">
      <InputText v-model="title" placeholder="title" class="w-full" />

      <span>Shortcode:</span>
      <InputText :value="`[slider-pro id='${activeSlider?.id}']`" />

      <Button label="Save" class="w-32" />
    </div>

    <div class="bg-white">
      <div
        class="flex w-full items-center justify-between bg-gradient-to-r from-fuchsia-500 to-cyan-500 p-4 text-white"
      >
        <div class="text-2xl">Slider Pro</div>
        <Button label="get support" variant="link" class="[&_span]:text-white" />
      </div>

      <UploadImage class="p-4" />
    </div>

    <SliderSettingTabs />
  </div>
</template>
