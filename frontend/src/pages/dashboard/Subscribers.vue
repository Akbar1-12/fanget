<template>
  <div>

    <div class="flex items-center justify-between mb-8">

      <h1 class="text-3xl font-bold text-white">
        Subscribers
      </h1>

      <span class="text-gray-400">
        {{ subscribers.length }} Total
      </span>

    </div>

    <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">

      <table class="w-full">

        <thead class="border-b border-zinc-800">

          <tr class="text-left text-gray-400">

            <th class="p-4">Email</th>
            <th class="p-4">Campaign</th>
            <th class="p-4">Date</th>

          </tr>

        </thead>

        <tbody>

          <tr
            v-if="!subscribers.length"
            class="border-b border-zinc-800"
          >

            <td
              colspan="3"
              class="p-10 text-center text-gray-500"
            >
              No subscribers yet.
            </td>

          </tr>

          <tr
            v-for="subscriber in subscribers"
            :key="subscriber.id"
            class="border-b border-zinc-800"
          >

            <td class="p-4 text-white">
              {{ subscriber.email }}
            </td>

            <td class="p-4 text-gray-300">
              {{ subscriber.campaign }}
            </td>

            <td class="p-4 text-gray-500">
              {{ subscriber.created_at }}
            </td>

          </tr>

        </tbody>

      </table>

    </div>

  </div>
</template>

<script setup>
import { ref } from "vue";

const subscribers = ref([]);
</script>