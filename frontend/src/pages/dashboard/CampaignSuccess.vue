<template>
  <div class="mx-auto max-w-4xl py-16">

    <div class="rounded-3xl border border-zinc-800 bg-zinc-900 p-10">

      <div class="text-center">

        <div class="text-6xl mb-6">
          🎉
        </div>

        <h1 class="text-4xl font-bold text-white">
          Campaign Published!
        </h1>

        <p class="mt-4 text-zinc-400">
          Your campaign is now live.
        </p>

      </div>

      <div class="mt-10">

        <label class="text-sm text-zinc-500">
          Campaign Link
        </label>

        <div
          class="mt-2 flex rounded-xl border border-zinc-700 overflow-hidden"
        >

          <input
            readonly
            :value="campaignUrl"
            class="flex-1 bg-zinc-950 px-4 py-4 text-white outline-none"
          >

          <button
            @click="copy"
            class="bg-green-500 px-8 font-semibold text-black"
          >
            Copy
          </button>

        </div>

      </div>

      <div class="mt-8 flex gap-4">

        <a
          :href="campaignUrl"
          target="_blank"
          class="rounded-xl bg-green-500 px-8 py-4 font-semibold text-black"
        >
          Open Campaign
        </a>

        <RouterLink
          to="/dashboard/campaigns"
          class="rounded-xl bg-zinc-800 px-8 py-4 text-white"
        >
          My Campaigns
        </RouterLink>

      </div>

    </div>

  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const campaignUrl = computed(() => route.query.url);

function copy() {
    navigator.clipboard.writeText(campaignUrl.value);
    alert("Campaign link copied.");
}
</script>