<template>
  <DefaultLayout>

    <!-- Loading -->
    <div
      v-if="campaignStore.loading"
      class="flex min-h-[70vh] items-center justify-center"
    >
      <div class="text-center">
        <div
          class="mx-auto h-12 w-12 animate-spin rounded-full border-4 border-green-500 border-t-transparent"
        ></div>

        <p class="mt-4 text-white/60">
          Loading campaign...
        </p>
      </div>
    </div>

    <!-- Error -->
    <div
      v-else-if="campaignStore.error"
      class="flex min-h-[70vh] items-center justify-center"
    >
      <div class="text-center">
        <h2 class="text-2xl font-bold text-red-400">
          Campaign not found
        </h2>

        <p class="mt-3 text-white/50">
          Please check the campaign link.
        </p>
      </div>
    </div>

    <!-- Campaign -->
    <div
      v-else-if="campaignStore.campaign"
      class="space-y-10"
    >
      <HeroSection
        :artist="campaignStore.campaign"
      />

      <PlatformSection
        :platforms="campaignStore.campaign.platforms"
        @follow="startPlatformFlow"
      />
    </div>

    <ConnectingOverlay
      :show="showOverlay"
      :platform="selectedPlatform || {}"
    />

  </DefaultLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

import DefaultLayout from "@/layouts/DefaultLayout.vue";

import HeroSection from "@/components/public/campaign/HeroSection.vue";
import PlatformSection from "@/components/public/campaign/PlatformSection.vue";
import ConnectingOverlay from "@/components/public/campaign/ConnectingOverlay.vue";

import { useCampaignStore } from "@/stores/campaign";

import visitorService from "@/services/visitorService";

const campaignStore = useCampaignStore();
const route = useRoute();

const showOverlay = ref(false);
const selectedPlatform = ref(null);

onMounted(async () => {

    await campaignStore.loadCampaign(route.params.slug);

    await visitorService.log(route.params.slug);

});

async function startPlatformFlow(platform) {

    selectedPlatform.value = platform;

    showOverlay.value = true;

    await new Promise(resolve => setTimeout(resolve, 1200));

    window.location.href =
        `${import.meta.env.VITE_API_URL}/oauth/${platform.slug}/${campaignStore.campaign.slug}`;

}
</script>