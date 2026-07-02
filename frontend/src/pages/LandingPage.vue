<template>
  <DefaultLayout>
    <div class="space-y-10">
      <HeroSection :artist="artist" />
      <VideoSection :video="artist.video" />
      <PlatformSection :platforms="platforms" @follow="startPlatformFlow" />
    </div>
  </DefaultLayout>
</template>

<script setup>
import { ref } from "vue"
import DefaultLayout from "../layouts/DefaultLayout.vue"
import HeroSection from "../components/Hero/HeroSection.vue"
import VideoSection from "../components/Video/VideoSection.vue"
import PlatformSection from "../components/Platform/PlatformSection.vue"

const artist = {
  name: "ARIA NOVA",
  song: "Midnight Frequencies",
  artwork: "https://images.unsplash.com/photo-1614854262318-831574f15f1f?w=800",
  promo: "Follow on your favorite music platform to unlock exclusive content.",
  video: {
    title: "Midnight Frequencies — Official Music Video",
    thumbnail: "https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg",
  },
}

const platforms = ref([
  { id: "spotify", name: "Spotify", color: "#1DB954", short: "S" },
  { id: "audiomack", name: "Audiomack", color: "#FFA200", short: "A" },
  { id: "apple", name: "Apple Music", color: "#FC3C44", short: "A" },
  { id: "youtube", name: "YouTube Music", color: "#FF0000", short: "Y" },
  { id: "deezer", name: "Deezer", color: "#A238FF", short: "D" },
])

function startPlatformFlow(platformId) {
  console.log("Start flow for:", platformId)

  // Later this will:
  // 1) save the selected platform
  // 2) redirect to OAuth / follow flow
  // 3) capture email
  // 4) unlock content
}
</script>