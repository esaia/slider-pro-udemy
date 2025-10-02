<script setup lang="ts">
import { ALL_DIRECTIONS, ORIENTATION, PAGINATION_STYLES } from "@/constants/constants";

import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";

import ConfigWrapper from "@components/UI/ConfigWrapper.vue";

import ToggleButton from "primevue/togglebutton";
import InputGroup from "primevue/inputgroup";
import InputGroupAddon from "primevue/inputgroupaddon";
import InputText from "primevue/inputtext";
import SelectButton from "primevue/selectbutton";
import ColorPicker from "primevue/colorpicker";

import { useGlobalStore } from "@/store/useGlobal";
import { storeToRefs } from "pinia";

const globalStore = useGlobalStore();
const { metaData } = storeToRefs(globalStore);
</script>
<template>
  <div>
    <Tabs value="0">
      <TabList>
        <Tab value="0">Autoplay</Tab>
        <Tab value="1">Navigation</Tab>
        <Tab value="2">Pagination</Tab>
      </TabList>
      <TabPanels>
        <TabPanel value="0">
          <div class="space-y-6">
            <ConfigWrapper title="Autoplay" desc="Enable/disable autoplay">
              <ToggleButton v-model="metaData.autoplay" onLabel="On" offLabel="Off" />
            </ConfigWrapper>

            <ConfigWrapper title="Slider autoplay delay" desc="Set autoplay scroll speed delay in milliseconds.">
              <InputGroup>
                <InputText v-model="metaData.autoplayDelay" type="number" class="!w-24" />
                <InputGroupAddon>MS</InputGroupAddon>
              </InputGroup>
            </ConfigWrapper>

            <ConfigWrapper title="Slider orientation" desc="Set slider orientation.">
              <SelectButton
                v-model="metaData.reversedDirection"
                :options="ORIENTATION"
                size="small"
                option-label="name"
                option-value="value"
              />
            </ConfigWrapper>

            <ConfigWrapper title="Pause on hover" desc="Pause slider on hover">
              <ToggleButton v-model="metaData.pauseonhover" onLabel="On" offLabel="Off" />
            </ConfigWrapper>

            <ConfigWrapper title="Stop on last slide" desc="Enable/disable autoplay stop or not on last slide.">
              <ToggleButton v-model="metaData.stopOnLastSlide" onLabel="On" offLabel="Off" />
            </ConfigWrapper>
          </div>
        </TabPanel>

        <TabPanel value="1">
          <div class="space-y-6">
            <ConfigWrapper title="Navigation" desc="Enable navigation.">
              <ToggleButton v-model="metaData.navigation" onLabel="On" offLabel="Off" />
            </ConfigWrapper>

            <ConfigWrapper title="Navigation color" desc="Set color for the slider navigation.">
              <div class="flex flex-col items-start gap-2 text-gray-500">
                <label> Active color: </label>

                <ColorPicker v-model="metaData.navigationActiveColor" name="color" />
              </div>
            </ConfigWrapper>
          </div>
        </TabPanel>

        <TabPanel value="2">
          <div class="space-y-6">
            <ConfigWrapper title="Pagination" desc="Enable pagination.">
              <ToggleButton v-model="metaData.pagination" onLabel="On" offLabel="Off" />
            </ConfigWrapper>

            <ConfigWrapper title="Pagination style" desc="Choose pagination style.">
              <SelectButton
                v-model="metaData.paginationStyle"
                :options="PAGINATION_STYLES"
                size="small"
                option-label="name"
                option-value="value"
              />
            </ConfigWrapper>

            <ConfigWrapper title="Pagination color" desc="Set color for the slider pagination.">
              <div class="flex gap-4">
                <div class="flex flex-col items-start gap-2 text-gray-500">
                  <label> Active color: </label>

                  <ColorPicker v-model="metaData.paginationActiveColor" name="color" />
                </div>

                <div class="flex flex-col items-start gap-2 text-gray-500">
                  <label> Scrollbar background: </label>

                  <ColorPicker v-model="metaData.scrollbarBackground" name="color" />
                </div>
              </div>
            </ConfigWrapper>

            <ConfigWrapper title="Clickable" desc="Enable/disable pagination clickable.">
              <ToggleButton v-model="metaData.clickable" onLabel="On" offLabel="Off" />
            </ConfigWrapper>

            <ConfigWrapper title="Pagination margin" desc="Set margin for slider pagination.">
              <div class="flex items-center gap-2">
                <InputGroup v-for="direction in ALL_DIRECTIONS">
                  <InputGroupAddon>{{ direction }}</InputGroupAddon>
                  <InputText v-model="metaData.paginationMargin[direction]" type="number" class="!w-20" />
                </InputGroup>
              </div>
            </ConfigWrapper>
          </div>
        </TabPanel>
      </TabPanels>
    </Tabs>
  </div>
</template>
