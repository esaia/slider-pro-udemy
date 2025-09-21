<script setup lang="ts">
import { useSelectImage } from "@/composables/useSelectImage";
import GalleryIcon from "@components/icons/GalleryIcon.vue";
import TrashIcon from "@components/icons/TrashIcon.vue";
import { createSwapy, type Swapy } from "swapy";
import { nextTick, onMounted, ref, watch } from "vue";

const { selectImage, selectedImages } = useSelectImage(true);

let swapyInstance: null | Swapy = null;

const container = ref();
const data = ref<string[]>([]);

const removeImage = (url: string) => {
  selectedImages.value = selectedImages.value?.filter((image) => image.url !== url) || [];
};

const initializeSwapy = () => {
  if (swapyInstance) {
    swapyInstance.destroy();
    swapyInstance = null;
  }

  if (!container.value || data.value.length === 0) return;

  swapyInstance = createSwapy(container.value, {
    animation: "dynamic"
  });

  swapyInstance.onSwapEnd((e) => {
    data.value = Object.values(e.slotItemMap.asObject);
  });
};

watch(
  () => selectedImages.value,
  () => {
    const urls = selectedImages.value?.map((img) => img.url) || [];
    data.value = [...new Set(urls)];
  },
  {
    deep: true
  }
);

watch(
  () => data.value,
  async () => {
    await nextTick();

    initializeSwapy();
  },
  {
    deep: true,
    flush: "post"
  }
);

onMounted(() => {
  initializeSwapy();
});
</script>
<template>
  <div ref="container" class="flex flex-wrap items-center gap-3">
    <div
      class="flex size-36 cursor-pointer flex-col items-center justify-center gap-2 rounded-sm bg-green-500 transition-all hover:scale-105"
      @click="selectImage"
    >
      <GalleryIcon class="[&_path]:stroke-white" />
      <div class="text-lg text-white">ADD IMAGE</div>
    </div>

    <div
      v-for="(url, index) in data"
      :key="url + index"
      :data-swapy-slot="`slot-${index}`"
      class="group relative cursor-all-scroll"
    >
      <div :data-swapy-item="url">
        <div
          class="absolute top-2 right-2 z-10 flex scale-0 cursor-pointer items-center gap-2 rounded-[999px] bg-white p-2 opacity-0 transition-all group-hover:scale-100 group-hover:opacity-100 hover:scale-105"
          @click="removeImage(url)"
        >
          <TrashIcon class="size-4" />
        </div>
        <img :src="url" class="size-36 rounded-sm object-cover" />
      </div>
    </div>
  </div>
</template>
