<template>
  <div class="max-w-3xl">

    <h1 class="mb-8 text-3xl font-bold text-white">
      Settings
    </h1>

    <div
      class="rounded-2xl border border-zinc-800 bg-zinc-900 p-8"
    >

      <div class="space-y-6">

        <div>

          <label class="mb-2 block text-sm text-gray-400">

            Name

          </label>

          <input
            v-model="user.name"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
          >

        </div>

        <div>

          <label class="mb-2 block text-sm text-gray-400">

            Artist Name

          </label>

          <input
            v-model="user.artist_name"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
          >

        </div>

        <div>

          <label class="mb-2 block text-sm text-gray-400">

            Email

          </label>

          <input
            v-model="user.email"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
          >

        </div>

        <button
          class="rounded-xl bg-green-500 px-8 py-3 font-semibold text-black"
        >

          Save Changes

        </button>

      </div>

    </div>

  </div>
</template>

<script setup>
import { computed } from "vue";
import { useAuthStore } from "@/stores/auth";

const auth = useAuthStore();

const user = computed(() => auth.user || {});
</script>