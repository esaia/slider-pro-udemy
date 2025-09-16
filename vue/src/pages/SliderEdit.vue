<script setup lang="ts">
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import UploadImage from "@/components/form/UploadImage.vue";
</script>
<template>
  <div class="space-y-6">
    <Button label="Back to sliders list" variant="link" class="mb-2 w-fit !p-0" />

    <div class="flex items-center gap-3">
      <InputText placeholder="title" class="w-full" />

      <span>Shortcode:</span>
      <InputText placeholder="title" value="[slider-pro id='1']" />

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
  </div>
</template>
