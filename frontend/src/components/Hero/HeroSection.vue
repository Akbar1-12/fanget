<template>
  <section class="animate-fade-up text-center">

    <!-- Album Artwork -->
    <div class="mx-auto w-72 md:w-80">
      <img
        :src="artist.artwork"
        :alt="artist.name"
        class="w-full rounded-3xl shadow-2xl border border-white/10"
      />
    </div>

    <!-- Artist -->
    <h1
      class="mt-8 text-4xl md:text-5xl font-black tracking-tight"
    >
      {{ artist.name }}
    </h1>

    <!-- Song -->
    <h2
      class="mt-2 text-xl md:text-2xl text-green-400 font-semibold"
    >
      {{ artist.song }}
    </h2>

    <!-- Promo -->
    <p
      class="mt-6 text-white/70 leading-7 max-w-xl mx-auto"
    >
      {{ artist.promo }}
    </p>

  </section>
</template>

<script setup>
defineProps({
  artist: {
    type: Object,
    required: true
  }
})
</script>