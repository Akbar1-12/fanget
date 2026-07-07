<template>
  <section class="relative overflow-hidden">

    <div
      class="absolute right-0 top-0 h-[500px] w-[500px] rounded-full bg-green-500/10 blur-[140px]"
    ></div>

    <div
      class="mx-auto grid max-w-7xl items-center gap-16 px-6 py-24 lg:grid-cols-2"
    >
      <div>

        <span
          class="rounded-full border border-green-500/30 bg-green-500/10 px-4 py-2 text-sm text-green-400"
        >
          Smart Music Links
        </span>

        <h1
          class="mt-8 text-5xl font-black leading-tight lg:text-7xl"
        >
          Turn Every Release Into a Fan Experience.
        </h1>

        <p
          class="mt-8 max-w-xl text-lg leading-9 text-white/70"
        >
          Create beautiful landing pages, collect fan emails,
          promote every streaming platform, and grow your audience
          from one powerful dashboard.
        </p>

        <div class="mt-10 flex flex-wrap gap-4">

          <router-link
            to="/register"
            class="rounded-full bg-green-500 px-8 py-4 font-semibold text-black transition hover:bg-green-400"
          >
            Create Free Link
          </router-link>

          <router-link
            to="/position"
            class="rounded-full border border-white/10 px-8 py-4 font-semibold hover:bg-white/5"
          >
            View Demo
          </router-link>

        </div>

      </div>

      <DashboardMockup />

    </div>

  </section>
</template>

<script setup>
import DashboardMockup from "./DashboardMockup.vue";
</script>