<script setup lang="ts">
import { onMounted, ref } from "vue";
import SlidersTable from "@/pages/SlidersTable.vue";
import ajaxAxios from "@/utils/axios";
import { useGlobalStore } from "@/store/useGlobal";
import { PER_PAGE } from "@/constants/constants";
import SliderEdit from "@/pages/SliderEdit.vue";

const params = new URLSearchParams(window.location.search);
const sliderId = params.get("slider");

const globalStore = useGlobalStore();

const loading = ref(true);

const fetchSliders = async (page: number = 1) => {
  loading.value = true;

  try {
    if (sliderId) {
      const { data } = await ajaxAxios.post("", {
        nonce: sliderPro.nonce,
        action: "sldp_get_slider",
        id: sliderId
      });
      globalStore.setActiveSlider(data.data);
    } else {
      const { data } = await ajaxAxios.post("", {
        nonce: sliderPro.nonce,
        action: "sldp_get_sliders",
        perPage: PER_PAGE,
        page
      });

      globalStore.setSliders(data.data);
    }
  } catch (error) {
    loading.value = false;
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  fetchSliders();
});
</script>

<template>
  <div class="container">
    <div v-if="loading">Loading</div>
    <SliderEdit v-else-if="sliderId" />
    <SlidersTable v-else @fetch-sliders="(page) => fetchSliders(page)" />
  </div>
</template>
