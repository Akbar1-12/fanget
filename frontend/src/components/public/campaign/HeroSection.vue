<template>
  <section
    class="relative overflow-hidden bg-[#09090B] pt-3 pb-4 lg:min-h-[900px] lg:overflow-visible lg:pt-10 lg:pb-14"
  >
    <!-- Background Glow -->
    <div
      class="absolute inset-0 bg-[radial-gradient(circle_at_75%_35%,rgba(34,197,94,.18),transparent_55%)]"
    ></div>

    <div
      class="absolute bottom-0 left-0 h-[450px] w-[450px] rounded-full bg-green-500/5 blur-[150px]"
    ></div>

    <div
      class="relative mx-auto grid max-w-7xl items-center gap-2 lg:gap-20 px-5 lg:min-h-[900px] lg:grid-cols-2 lg:gap-20 lg:px-12"
    >
      <!-- LEFT CONTENT -->
      <div class="z-20 mx-auto max-w-xl text-center lg:mx-0 lg:text-left">
        <p
          class="text-sm font-semibold uppercase tracking-[0.45em] text-green-400"
        >
          NOW PLAYING
        </p>

        <h1
          class="mt-2 text-4xl font-black leading-[0.9] text-white sm:text-5xl lg:mt-6 lg:text-8xl"
        >
          {{ artist.song }}
        </h1>

        <h2
          class="mt-1 text-xl font-medium text-white/70 sm:text-2xl lg:mt-6 lg:text-3xl"
        >
          {{ artist.name }}
        </h2>

        <p
          class="mx-auto mt-2 max-w-md text-base leading-7 text-white/60 lg:mx-0 lg:mt-10 lg:max-w-lg lg:text-lg lg:leading-9"
        >
          {{ artist.promo }}
        </p>
      </div>

      <!-- RIGHT -->
      <div
        class="relative mt-2 flex flex-col items-center lg:mt-0 lg:block"
      >
        <!-- Floating Video -->
        <div
          class="relative z-20 mb-2 w-full max-w-[360px] overflow-hidden rounded-3xl border border-white/15 bg-black/50 shadow-2xl backdrop-blur-xl sm:max-w-[380px] lg:absolute lg:-top-24 lg:right-6 lg:mb-0 lg:max-w-[360px]"
        >
          <div v-if="video.show">
            <iframe
              id="youtube-player"
              class="aspect-video w-full rounded-t-3xl"
              :src="embedUrl"
              title="Official Video"
              frameborder="0"
              allow="autoplay; encrypted-media"
              allowfullscreen
            ></iframe>

            <div class="flex items-center justify-center gap-2 rounded-b-3xl bg-black/30 p-3">
              <a
                :href="video.channel_url"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 rounded-full bg-red-600 px-3 py-2 text-center text-xs font-semibold text-white transition hover:bg-red-500"
              >
                {{ video.button_text || "Subscribe" }}
              </a>
              <a
                :href="youtubeUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 rounded-full border border-white/20 px-3 py-2 text-center text-xs font-semibold text-white transition hover:bg-white/10"
              >
                Watch on YouTube
              </a>
            </div>
          </div>
        </div>

        <!-- Artist Artwork -->
        <img
          :src="artist.artwork"
          :alt="artist.song"
          loading="lazy"
          decoding="async"
          class="hidden lg:block
                relative z-10
                mx-auto
                w-[860px]
                xl:w-[960px]
                lg:top-24
                lg:right-[-40px]
                drop-shadow-[0_40px_80px_rgba(0,0,0,.55)]
                transition
                duration-500
                hover:scale-[1.02]"
        />
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";

const props = defineProps({
  artist: {
    type: Object,
    required: true,
  },
});

const player = ref(null);

const video = computed(() => props.artist.video || {});

const embedUrl = computed(() => {
  if (!video.value.video_id) return "";

  return `https://www.youtube.com/embed/${video.value.video_id}?enablejsapi=1&autoplay=${
    video.value.autoplay ? 1 : 0
  }&mute=1&controls=1&rel=0&playsinline=1`;
});

const youtubeUrl = computed(() => {
  return (
    video.value.button_url ||
    `https://www.youtube.com/watch?v=${video.value.video_id}`
  );
});

function loadYouTubeAPI() {
  return new Promise((resolve) => {
    if (window.YT && window.YT.Player) {
      resolve();
      return;
    }

    window.onYouTubeIframeAPIReady = resolve;

    const script = document.createElement("script");
    script.src = "https://www.youtube.com/iframe_api";

    document.body.appendChild(script);
  });
}

onMounted(async () => {
  if (!video.value.show || !video.value.video_id) return;

  await loadYouTubeAPI();

  player.value = new window.YT.Player("youtube-player", {
    events: {
      onReady(event) {
        if (!video.value.autoplay) return;

        event.target.mute();

        event.target.playVideo();

        setTimeout(() => {
          event.target.pauseVideo();
        }, (video.value.duration || 10) * 1000);
      },
    },
  });
});
</script>