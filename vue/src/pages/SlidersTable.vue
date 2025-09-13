<script setup lang="ts">
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Dialog from "primevue/dialog";
import { ref } from "vue";

const sliders = [
  {
    title: "slider",
    shortcode: '[slider-pro id="48"]',
    created_at: "12 september"
  },
  {
    title: "slider",
    shortcode: '[slider-pro id="48"]',
    created_at: "12 september"
  },
  {
    title: "slider",
    shortcode: '[slider-pro id="48"]',
    created_at: "12 september"
  }
];

const isCreateModalOpen = ref(false);
const isDeleteModalOpen = ref(false);
</script>
<template>
  <div>
    <div class="mb-6 flex items-center justify-between">
      <div class="text-2xl font-semibold">Slider Pro</div>
      <Button label="Add slider" class="w-fit" @click="isCreateModalOpen = true" />
    </div>

    <DataTable :value="sliders" tableStyle="min-width: 50rem">
      <Column field="title" header="Title"></Column>

      <Column field="shortcode" header="Shortcode">
        <template #body="slotProps">
          <InputText type="text" :value="slotProps.data.shortcode" />
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
      <div>
        <InputText placeholder="title" class="w-full" />
        <Button label="Create" class="mt-4 w-full" />
      </div>
    </Dialog>

    <Dialog v-model:visible="isDeleteModalOpen" modal header="Delete Slider" :style="{ width: '25rem' }">
      <div>
        <p>Are you sure to delete slider with id ?</p>
        <Button label="Delete" class="mt-4 w-full" severity="danger" />
      </div>
    </Dialog>
  </div>
</template>
