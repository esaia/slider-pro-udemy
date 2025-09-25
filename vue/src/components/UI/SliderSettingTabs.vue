<script setup lang="ts">
import Tabs from "primevue/tabs";
import TabList from "primevue/tablist";
import Tab from "primevue/tab";
import TabPanels from "primevue/tabpanels";
import TabPanel from "primevue/tabpanel";
import GeneralSettings from "@components/settingTabs/GeneralSettings.vue";
import ModuleSettings from "@components/settingTabs/ModuleSettings.vue";
</script>
<template>
  <div>
    <Tabs value="0">
      <TabList>
        <Tab value="0">General settings</Tab>
        <Tab value="1">Style settings</Tab>
        <Tab value="2">Module settings</Tab>
      </TabList>
      <TabPanels>
        <TabPanel value="0">
          <GeneralSettings />
        </TabPanel>
        <TabPanel value="1">
          <p>Your config</p>
        </TabPanel>
        <TabPanel value="2">
          <ModuleSettings />
        </TabPanel>
      </TabPanels>
    </Tabs>
  </div>
</template>
