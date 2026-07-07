<template>
  <div>
    <h1 class="text-3xl font-bold text-white mb-8">
      Dashboard
    </h1>

    <div class="grid md:grid-cols-4 gap-6">
      <div
        v-for="card in cards"
        :key="card.title"
        class="rounded-2xl bg-zinc-900 border border-zinc-800 p-6"
      >
        <p class="text-gray-400 text-sm">
          {{ card.title }}
        </p>
        <h2 class="text-4xl font-black text-white mt-2">
          {{ card.value }}
        </h2>
      </div>
    </div>

    <div class="mt-10 rounded-2xl bg-zinc-900 border border-zinc-800 p-8">
      <h2 class="text-xl font-bold text-white mb-6">
        Recent Campaigns
      </h2>

      <table class="w-full">
        <thead>
          <tr class="text-left text-gray-500">
            <th>Song</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="campaign in campaigns"
            :key="campaign.id"
            class="border-t border-zinc-800"
          >
            <td class="py-5 text-white">
              {{ campaign.song }}
            </td>
            <td>
              <span
                class="rounded-full bg-green-500/20 px-3 py-1 text-xs text-green-400"
              >
                Published
              </span>
            </td>
            <td class="text-right">
              <RouterLink
                :to="`/dashboard/campaigns/${campaign.id}/edit`"
                class="text-green-400"
              >
                Edit
              </RouterLink>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useCampaignStore } from "@/stores/campaign";
import dashboardService from "@/services/dashboardService";

const store = useCampaignStore();

const stats = ref({
  campaigns: 0,
  published: 0,
  visitors: 0,
  subscribers: 0,
});

onMounted(async () => {
  store.load();
  const { data } = await dashboardService.stats();
  stats.value = data;
});

const campaigns = computed(() => store.campaigns);

const cards = computed(() => [
  { title: "Campaigns", value: stats.value.campaigns },
  { title: "Published", value: stats.value.published },
  { title: "Visitors", value: stats.value.visitors },
  { title: "Subscribers", value: stats.value.subscribers },
]);
</script>