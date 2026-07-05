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
      class="space-y-32"
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

import { useCampaignStore } from "../../stores/campaign.js";

import DefaultLayout from "../layouts/DefaultLayout.vue";
import HeroSection from "../components/Hero/HeroSection.vue";
import PlatformSection from "../components/Platform/PlatformSection.vue";
import ConnectingOverlay from "../components/Overlay/ConnectingOverlay.vue";

import { campaignService } from "../../services/campaignService.js";

const campaignStore = useCampaignStore();

const route = useRoute();

const showOverlay = ref(false);

const selectedPlatform = ref(null);

onMounted(() => {
    campaignStore.loadCampaign(route.params.slug);
});

async function startPlatformFlow(platform) {

    selectedPlatform.value = platform;

    showOverlay.value = true;

    try {

        await campaignService.recordPlatformClick({

            campaign_id: campaignStore.campaign.id,

            platform: platform.id,

        });

        await new Promise(resolve => setTimeout(resolve, 1200));

        window.location.href =
        `http://127.0.0.1:8000/api/oauth/${platform.id}/${campaignStore.campaign.slug}`;

    } catch (error) {

        console.error(error);

        showOverlay.value = false;

    }

}
</script>