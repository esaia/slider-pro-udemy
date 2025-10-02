import { defineStore } from "pinia";
import { ref } from "vue";

export const useGlobalStore = defineStore("global", () => {
  const metaData = ref({
    // General settings
    slideEffect: "",
    columns: { desktop: "1", laptop: "1", tablet: "1", mobile: "1" },
    paddingTop: "50",
    spaceBetween: "0",
    clickAction: "lightbox",
    orderBy: "drag",
    infiniteLoop: false,
    sliderDirection: "horizontal",
    centerSlides: false,

    // Module settings

    // Autoplay
    autoplay: false,
    autoplayDelay: "3000",
    reversedDirection: false,
    pauseonhover: true,
    stopOnLastSlide: false,

    // Navigation
    navigation: false,
    navigationActiveColor: "000000",

    // Pagination
    pagination: false,
    paginationStyle: "bullets",
    scrollbarBackground: "cccccc",
    paginationActiveColor: "cccccc",
    clickable: false,
    paginationMargin: { top: "0", right: "0", down: "0", left: "0" }
  });

  return { metaData };
});
