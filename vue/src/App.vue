<script setup lang="ts">
import { onMounted } from "vue";
import SlidersTable from "@/pages/SlidersTable.vue";
import ajaxAxios from "@/utils/axios";
import { useGlobalStore } from "@/store/useGlobal";
import { PER_PAGE } from "@/constants/constants";
// import SliderEdit from "@/pages/SliderEdit.vue";

const globalStore = useGlobalStore();

const fetchSliders = async (page: number = 1) => {
  const { data } = await ajaxAxios.post("", {
    nonce: sliderPro.nonce,
    action: "sldp_get_sliders",
    perPage: PER_PAGE,
    page
  });

  globalStore.setSliders(data.data);
};

onMounted(() => {
  fetchSliders();
});
</script>

<template>
  <div class="container">
    <!-- <SliderEdit /> -->
    <SlidersTable @fetch-sliders="(page) => fetchSliders(page)" />
  </div>
</template>
