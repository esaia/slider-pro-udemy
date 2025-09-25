<script setup lang="ts">
import { CLICK_ACTIONS, DEVICES, DIRECTIONS, ORDER_BY_OPTIONS, TRANSITIONS } from "@/constants/constants";
import ConfigWrapper from "@components/UI/ConfigWrapper.vue";
import Select from "primevue/select";
import InputText from "primevue/inputtext";
import ToggleButton from "primevue/togglebutton";
import InputGroup from "primevue/inputgroup";
import InputGroupAddon from "primevue/inputgroupaddon";
import SelectButton from "primevue/selectbutton";
</script>
<template>
  <div class="space-y-6">
    <ConfigWrapper title="slide effect" desc="Select a slide transition effect.">
      <Select :options="TRANSITIONS" option-label="name" placeholder="Select a transition" size="small" class="w-56" />
    </ConfigWrapper>

    <ConfigWrapper title="Columns" desc="Set number of column on device.">
      <div class="flex items-center gap-2">
        <InputGroup v-for="device in DEVICES">
          <InputGroupAddon> {{ device }} </InputGroupAddon>
          <InputText type="number" step="0.1" class="!w-20" />
        </InputGroup>
      </div>
    </ConfigWrapper>

    <ConfigWrapper title="Padding top" desc="Set a padding top & in range 1-100.">
      <InputGroup>
        <InputText type="number" class="!w-20" />
        <InputGroupAddon> % </InputGroupAddon>
      </InputGroup>
    </ConfigWrapper>

    <ConfigWrapper title="Space between" desc="Set a space between of the items.">
      <InputGroup>
        <InputText type="number" class="!w-20" />
        <InputGroupAddon> px </InputGroupAddon>
      </InputGroup>
    </ConfigWrapper>

    <ConfigWrapper title="Click action type" desc="Set a click action type for the items.">
      <SelectButton :options="CLICK_ACTIONS" size="small" option-label="name" />
    </ConfigWrapper>

    <ConfigWrapper title="Order by" desc="Set an order by option.">
      <SelectButton :options="ORDER_BY_OPTIONS" size="small" option-label="name" />
    </ConfigWrapper>

    <ConfigWrapper title="Infinite loop" desc="Enable/Disable infinite loop mode.">
      <ToggleButton onLabel="On" offLabel="Off" />
    </ConfigWrapper>

    <ConfigWrapper title="Slider direction" desc="Choose a slider direction.">
      <SelectButton :options="DIRECTIONS" size="small" option-label="name" />
    </ConfigWrapper>

    <ConfigWrapper title="Center slides" desc="Enable/Disable center slide mode.">
      <ToggleButton onLabel="On" offLabel="Off" />
    </ConfigWrapper>
  </div>
</template>
