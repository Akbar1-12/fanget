<template>
  <div class="max-w-4xl">
    <h1 class="text-3xl font-bold text-white mb-8">
      {{ editing ? "Edit Campaign" : "Create Campaign" }}
    </h1>

    <!-- Step Indicator -->
    <StepIndicator :step="step" />

    <!-- Form wrapped for final submission -->
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

      <!-- Navigation Buttons -->
      <div class="flex justify-between mt-10">
        <button
          v-if="step > 1"
          type="button"
          @click="previousStep"
          class="px-6 py-3 rounded-xl bg-zinc-800 text-white"
        >
          Back
        </button>

        <button
          v-if="step < 5"
          type="button"
          @click="nextStep"
          class="ml-auto px-6 py-3 rounded-xl bg-green-500 text-black"
        >
          Continue
        </button>

        <button
          v-if="step === 5"
          type="submit"
          :disabled="loading"
          class="ml-auto px-8 py-3 rounded-xl bg-green-500 text-black disabled:opacity-50"
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

// Step components
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
  youtube_video_id: "",
  youtube_channel_url: "",
  youtube_button_text: "Subscribe",
  youtube_button_url: "",
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

function selectArtwork(e) {
  form.artwork = e.target.files[0];
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

  form.song_title = campaign.song;
  form.promo = campaign.promo;
  form.youtube_video_id = campaign.video.video_id;
  form.youtube_channel_url = campaign.video.channel_url;
  form.youtube_button_text = campaign.video.button_text;
  form.youtube_button_url = campaign.video.button_url;
  form.show_video = campaign.video.show;
  form.autoplay_video = campaign.video.autoplay;
  form.autoplay_seconds = campaign.video.duration;

  form.platforms.forEach(platform => {
    const existing = campaign.platforms.find(
      p => p.id === platform.platform_id
    );
    if (existing) {
      platform.destination_url = existing.destination_url;
    }
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
    Object.keys(form).forEach(key => {
      if (key === "platforms") return;
      if (form[key] !== null) {
        data.append(key, form[key]);
      }
    });

    form.platforms
      .filter(platform => platform.destination_url.trim() !== "")
      .forEach((platform, index) => {
        data.append(`platforms[${index}][platform_id]`, platform.platform_id);
        data.append(`platforms[${index}][destination_url]`, platform.destination_url);
      });

    if (editing.value) {
      await campaignStore.update(route.params.id, data);
      router.push("/dashboard/campaigns");
    } else {
      const response = await campaignStore.create(data);
      router.push({
        path: "/dashboard/campaign-success",
        query: {
          url: response.campaign_url,
        },
      });
    }
  } catch (error) {
    console.error(error);
  } finally {
    loading.value = false;
  }
}
</script>