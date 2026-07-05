<template>
  <section class="mt-14">


    <button
      @click="$emit('open')"
      class="group relative w-full overflow-hidden rounded-3xl border border-white/10"
    >

      <img
        :src="thumbnail"
        loading="lazy"
        decoding="async"
        :alt="videoTitle"
        class="aspect-video w-full object-cover transition duration-500 group-hover:scale-105"
      />

      <div
        class="absolute inset-0 bg-black/40 transition group-hover:bg-black/30"
      ></div>

      <div
        class="absolute inset-0 flex items-center justify-center"
      >

        <div
          class="flex h-20 w-20 items-center justify-center rounded-full bg-white/20 backdrop-blur-md transition duration-300 group-hover:scale-110"
        >

          ▶

        </div>

      </div>

    </button>

  </section>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  video: {
    type: Object,
    required: true,
  },
});

defineEmits(["open"]);

const thumbnail = computed(() => {
  if (!props.video?.video_id) return "";

  return (
    props.video.thumbnail ||
    `https://img.youtube.com/vi/${props.video.video_id}/maxresdefault.jpg`
  );
});

const videoTitle = computed(() => {
  return props.video?.title || "Official Video";
});
</script>