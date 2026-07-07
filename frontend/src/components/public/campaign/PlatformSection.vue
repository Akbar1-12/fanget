<template>
  <section class="mx-auto w-full max-w-4xl px-4 sm:px-6 mt-0">
    <!-- Heading -->
    <div class="mb-8 text-center sm:mb-10 lg:mb-12">
      <h2 class="text-2xl font-bold text-white sm:text-3xl">
        Choose your platform
      </h2>

      <p class="mt-2 text-sm text-white/50 sm:mt-3 sm:text-base">
        Continue with your preferred streaming service.
      </p>
    </div>

    <!-- Platform List -->
    <div class="space-y-4 sm:space-y-5">
      <MusicPlatformCard
        v-for="platform in orderedPlatforms"
        :key="platform.id"
        :platform="platform"
        @click="$emit('follow', platform)"
      />
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";
import MusicPlatformCard from "@/components/Platform/MusicPlatformCard.vue";

const props = defineProps({
  platforms: {
    type: Array,
    required: true,
  },
});

defineEmits(["follow"]);

const orderedPlatforms = computed(() => {
  const order = [
    "spotify",
    "apple",
    "boomplay",
    "audiomack",
    "deezer",
    "youtube",
  ];

  return [...props.platforms].sort((a, b) => {
    const indexA = order.indexOf(a.slug);
    const indexB = order.indexOf(b.slug);

    return (
      (indexA === -1 ? 999 : indexA) -
      (indexB === -1 ? 999 : indexB)
    );
  });
});
</script>