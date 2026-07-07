<template>
  <div>

    <h1 class="text-3xl font-bold text-white mb-8">
      Analytics
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

      <div
        v-for="card in cards"
        :key="card.title"
        class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"
      >

        <p class="text-gray-400">
          {{ card.title }}
        </p>

        <h2 class="mt-2 text-4xl font-black text-white">
          {{ card.value }}
        </h2>

      </div>

    </div>

    <div
      class="mt-8 rounded-2xl border border-zinc-800 bg-zinc-900 p-10"
    >

      <div
        class="flex h-80 items-center justify-center text-gray-500"
      >

        Analytics charts coming soon

      </div>

    </div>

  </div>
</template>

<script setup>
const cards = [

    {

        title: "Visitors",

        value: 0,

    },

    {

        title: "Platform Clicks",

        value: 0,

    },

    {

        title: "Video Plays",

        value: 0,

    },

    {

        title: "Subscribers",

        value: 0,

    },

];
</script>