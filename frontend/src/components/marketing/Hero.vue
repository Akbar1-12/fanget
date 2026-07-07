<template>
  <section class="relative overflow-hidden px-4 py-12 sm:px-6 sm:py-16 lg:py-24">
    <!-- Background blur - responsive sizing and positioning -->
    <div
      class="absolute -right-20 top-0 h-[300px] w-[300px] rounded-full bg-green-500/10 blur-[100px] sm:h-[400px] sm:w-[400px] lg:h-[500px] lg:w-[500px] lg:blur-[140px]"
    ></div>

    <div
      class="relative mx-auto grid max-w-7xl gap-8 sm:gap-12 lg:grid-cols-2 lg:gap-16"
    >
      <!-- Left Content -->
      <div class="order-2 flex flex-col items-center text-center lg:order-1 lg:items-start lg:text-left">
        <span
          class="rounded-full border border-green-500/30 bg-green-500/10 px-3 py-1.5 text-xs font-medium text-green-400 sm:px-4 sm:py-2 sm:text-sm"
        >
          Smart Music Links
        </span>

        <h1
          class="mt-6 text-4xl font-black leading-tight sm:text-5xl lg:mt-8 lg:text-6xl xl:text-7xl"
        >
          Turn Every Release Into a Fan Experience.
        </h1>

        <p
          class="mt-4 max-w-xl text-base leading-relaxed text-white/70 sm:mt-6 sm:text-lg sm:leading-9 lg:mt-8"
        >
          Create beautiful landing pages, collect fan emails,
          promote every streaming platform, and grow your audience
          from one powerful dashboard.
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 sm:mt-8 sm:gap-4 lg:mt-10 lg:justify-start">
          <router-link
            to="/register"
            class="rounded-full bg-green-500 px-6 py-3 text-sm font-semibold text-black transition hover:bg-green-400 sm:px-8 sm:py-4 sm:text-base"
          >
            Create Free Link
          </router-link>

          <router-link
            to="/position"
            class="rounded-full border border-white/10 px-6 py-3 text-sm font-semibold hover:bg-white/5 sm:px-8 sm:py-4 sm:text-base"
          >
            View Demo
          </router-link>
        </div>
      </div>

      <!-- Right Content - Dashboard Mockup -->
      <div class="order-1 lg:order-2">
        <DashboardMockup />
      </div>
    </div>
  </section>
</template>

<script setup>
import DashboardMockup from "./DashboardMockup.vue";
</script>