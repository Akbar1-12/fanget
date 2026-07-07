<template>
  <div class="max-w-4xl">
    <h1 class="mb-8 text-3xl font-bold text-white">
      {{ editing ? "Edit Campaign" : "Create Campaign" }}
    </h1>

    <StepIndicator :step="step" />

    <form @submit.prevent="submit">
      <StepOne
        v-if="step === 1"
        v-model:form="form"
      />

      <StepTwo
        v-if="step === 2"
        v-model:platforms="form.platforms"
      />

      <StepThree
        v-if="step === 3"
        v-model:form="form"
      />

      <StepFour
        v-if="step === 4"
        :form="form"
      />

      <StepFive
        v-if="step === 5"
        :form="form"
      />

      <div class="mt-10 flex justify-between">
        <button
          v-if="step > 1"
          type="button"
          @click="previousStep"
          class="rounded-xl bg-zinc-800 px-6 py-3 text-white"
        >
          Back
        </button>

        <button
          v-if="step < 5"
          type="button"
          @click="nextStep"
          class="ml-auto rounded-xl bg-green-500 px-6 py-3 text-black"
        >
          Continue
        </button>

        <button
          v-if="step === 5"
          type="submit"
          :disabled="loading"
          class="ml-auto rounded-xl bg-green-500 px-8 py-3 text-black disabled:opacity-50"
        >
          {{ loading ? "Saving..." : "Publish Campaign" }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";

import { useCampaignStore } from "@/stores/campaign";
import platformService from "@/services/platformService";

import StepIndicator from "@/components/campaign-builder/StepIndicator.vue";
import StepOne from "@/components/campaign-builder/StepOne.vue";
import StepTwo from "@/components/campaign-builder/StepTwo.vue";
import StepThree from "@/components/campaign-builder/StepThree.vue";
import StepFour from "@/components/campaign-builder/StepFour.vue";
import StepFive from "@/components/campaign-builder/StepFive.vue";

const router = useRouter();
const route = useRoute();

const campaignStore = useCampaignStore();

const loading = ref(false);
const editing = ref(false);
const step = ref(1);

const form = reactive({
  song_title: "",
  promo: "",
  artwork: null,

  youtube_video_url: "",
  youtube_channel_url: "",

  show_video: true,
  autoplay_video: true,
  autoplay_seconds: 60,

  platforms: [],
});

function nextStep() {
  if (step.value < 5) step.value++;
}

function previousStep() {
  if (step.value > 1) step.value--;
}

async function loadPlatforms() {
  const { data } = await platformService.getAll();

  form.platforms = data.data.map(platform => ({
    platform_id: platform.id,
    name: platform.name,
    slug: platform.slug,
    logo: platform.logo,
    destination_url: "",
  }));
}

async function loadCampaign() {
  if (!route.params.id) return;

  editing.value = true;

  const campaign = await campaignStore.show(route.params.id);

  form.song_title = campaign.song_title;
  form.promo = campaign.promo;

  form.youtube_video_url = campaign.youtube_video_url;
  form.youtube_channel_url = campaign.youtube_channel_url;

  form.show_video = campaign.show_video;
  form.autoplay_video = campaign.autoplay_video;
  form.autoplay_seconds = campaign.autoplay_seconds;

  /*
  |--------------------------------------------------------------------------
  | Map platforms to include destination_url from the campaign
  |--------------------------------------------------------------------------
  */
  form.platforms = form.platforms.map(platform => {
    const existing = campaign.platforms.find(
      p => p.id === platform.platform_id
    );
    return {
      ...platform,
      destination_url: existing ? existing.destination_url : "",
    };
  });
}

onMounted(async () => {
  await loadPlatforms();
  await loadCampaign();
});

async function submit() {
  loading.value = true;

  try {
    const data = new FormData();

    data.append("song_title", form.song_title);
    data.append("promo", form.promo ?? "");

    if (form.artwork) {
      data.append("artwork", form.artwork);
    }

    data.append("youtube_video_url", form.youtube_video_url ?? "");
    data.append("youtube_channel_url", form.youtube_channel_url ?? "");

    data.append("show_video", form.show_video ? 1 : 0);
    data.append("autoplay_video", form.autoplay_video ? 1 : 0);
    data.append("autoplay_seconds", form.autoplay_seconds);

    const selectedPlatforms = form.platforms.filter(
      p => p.destination_url.trim() !== ""
    );

    selectedPlatforms.forEach((platform, index) => {
      data.append(
        `platforms[${index}][platform_id]`,
        platform.platform_id
      );
      data.append(
        `platforms[${index}][destination_url]`,
        platform.destination_url
      );
    });

    let response;

    if (editing.value) {
      response = await campaignStore.update(
        route.params.id,
        data
      );
      router.push("/dashboard/campaigns");
    } else {
      response = await campaignStore.create(data);
      router.push({
        path: "/dashboard/campaign-success",
        query: {
          url: response.campaign_url,
        },
      });
    }
  } catch (error) {
    console.error(error);

    if (error.response) {
      console.log(error.response.data);
      alert(
        error.response.data.message ??
        "Unable to create campaign."
      );
    } else {
      alert("Something went wrong.");
    }
  } finally {
    loading.value = false;
  }
}
</script>