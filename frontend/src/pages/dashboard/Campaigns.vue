<template>
  <div>

    <div class="flex items-center justify-between mb-8">

      <h1 class="text-3xl font-bold text-white">
        Campaigns
      </h1>

      <RouterLink
        to="/dashboard/campaigns/create"
        class="rounded-xl bg-green-500 px-6 py-3 font-semibold text-black"
      >
        New Campaign
      </RouterLink>

    </div>

    <input
      v-model="search"
      placeholder="Search campaigns..."
      class="mb-6 w-full rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white"
    />

    <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">

      <table class="w-full">

        <thead class="border-b border-zinc-800">

          <tr class="text-left text-gray-400">

            <th class="p-4">Song</th>
            <th class="p-4">Slug</th>
            <th class="p-4">Status</th>
            <th class="p-4 text-right">Actions</th>

          </tr>

        </thead>

        <tbody>

          <tr
            v-for="campaign in filteredCampaigns"
            :key="campaign.id"
            class="border-b border-zinc-800"
          >

            <td class="p-4 text-white">
              {{ campaign.song }}
            </td>

            <td class="p-4 text-gray-400">
              {{ campaign.slug }}
            </td>

            <td class="p-4">

              <span
                class="rounded-full bg-green-500/20 px-3 py-1 text-xs text-green-400"
              >
                Published
              </span>

            </td>

            <td class="p-4">

              <div class="flex justify-end gap-3">

                <button
                  @click="copyLink(campaign)"
                  class="text-blue-400"
                >
                  Copy
                </button>

                <a
                  :href="`${website}/campaign/${campaign.slug}`"
                  target="_blank"
                  class="text-green-400"
                >
                  View
                </a>

                <RouterLink
                  :to="`/dashboard/campaigns/${campaign.id}/edit`"
                  class="text-yellow-400"
                >
                  Edit
                </RouterLink>

                <button
                  @click="remove(campaign.id)"
                  class="text-red-400"
                >
                  Delete
                </button>

              </div>

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

const store = useCampaignStore();

const search = ref("");

const website = window.location.origin;

onMounted(() => {

    store.load();

});

const filteredCampaigns = computed(() => {

    return store.campaigns.filter(campaign =>

        campaign.song
            .toLowerCase()
            .includes(search.value.toLowerCase())

    );

});

async function remove(id) {

    if (!confirm("Delete this campaign?")) return;

    await store.delete(id);

}

async function copyLink(campaign) {

    await navigator.clipboard.writeText(

        `${website}/campaign/${campaign.slug}`

    );

    alert("Campaign link copied.");

}
</script>