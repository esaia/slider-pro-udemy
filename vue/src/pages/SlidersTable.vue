<script setup lang="ts">
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import { ref } from "vue";
import ajaxAxios from "@/utils/axios";
import { useGlobalStore } from "@/store/useGlobal";
import { storeToRefs } from "pinia";
import { PER_PAGE } from "@/constants/constants";

const emit = defineEmits<{
  (e: "fetchSliders", page: number): void;
}>();

const globalStore = useGlobalStore();
const { sliders } = storeToRefs(globalStore);

// const sliders = [
//   {
//     title: "slider",
//     shortcode: '[slider-pro id="48"]',
//     created_at: "12 september"
//   },
//   {
//     title: "slider",
//     shortcode: '[slider-pro id="48"]',
//     created_at: "12 september"
//   },
//   {
//     title: "slider",
//     shortcode: '[slider-pro id="48"]',
//     created_at: "12 september"
//   }
// ];

const isCreateModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
const title = ref("");
const errorMsg = ref("");
const loading = ref(false);
const first = ref();

const handleCreateSlider = async () => {
  errorMsg.value = "";

  if (loading.value) return;

  loading.value = true;

  try {
    await ajaxAxios.post("", {
      nonce: sliderPro.nonce,
      action: "sldp_create_slider",
      title: title.value
    });

    title.value = "";
    isCreateModalOpen.value = false;
  } catch (error) {
    errorMsg.value = "Something went wrong!";
  }

  loading.value = false;
};

const handlePageChange = (e: any) => {
  console.log("e", e);
  first.value = e.first;

  emit("fetchSliders", e.page + 1);
};
</script>
<template>
  <div>
    <div class="mb-6 flex items-center justify-between">
      <div class="text-2xl font-semibold">Slider Pro</div>
      <Button label="Add slider" class="w-fit" @click="isCreateModalOpen = true" />
    </div>

    <DataTable
      v-if="sliders?.data.length"
      v-model:first="first"
      :value="sliders?.data"
      :paginator="sliders.total > sliders.per_page"
      :rows="PER_PAGE"
      :totalRecords="sliders.total"
      tableStyle="min-width: 50rem"
      lazy
      @page="handlePageChange"
    >
      <Column field="title" header="Title"></Column>

      <Column field="shortcode" header="Shortcode">
        <template #body="slotProps">
          <InputText type="text" :value="`[slider-pro id='${slotProps.data.id}']`" />
        </template>
      </Column>

      <Column field="created_at" header="Date"></Column>

      <Column header="Actions">
        <template #body>
          <Button label="Open" variant="text" size="small" />
          <Button label="Delete" variant="text" size="small" severity="danger" @click="isDeleteModalOpen = true" />
        </template>
      </Column>
    </DataTable>

    <Dialog v-model:visible="isCreateModalOpen" modal header="Create Slider" :style="{ width: '25rem' }">
      <form @submit.prevent="handleCreateSlider">
        <InputText v-model="title" placeholder="title" class="w-full" />
        <Button label="Create" class="mt-4 w-full" type="submit" />
        <p v-if="errorMsg" class="p-2 font-semibold text-red-500">{{ errorMsg }}</p>
      </form>
    </Dialog>

    <Dialog v-model:visible="isDeleteModalOpen" modal header="Delete Slider" :style="{ width: '25rem' }">
      <div>
        <p>Are you sure to delete slider with id ?</p>
        <Button label="Delete" class="mt-4 w-full" severity="danger" />
      </div>
    </Dialog>
  </div>
</template>
