<template>
  <Transition name="fade">
    <div
      v-if="show"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-lg"
    >
      <div class="text-center">

        <img
          :src="platform.logo"
          :alt="platform.name"
          class="mx-auto h-20 w-20 animate-bounce"
        />

        <h2 class="text-2xl font-semibold">
    Connecting to {{ platform.name }}
</h2>

<p class="mt-3 text-white/60">
    Please wait while we securely connect your music account.
</p>

        <div
class="mt-8 h-2 overflow-hidden rounded-full bg-white/10">

<div
class="h-full w-full animate-pulse rounded-full bg-green-500">
</div>

</div>

      </div>
    </div>
  </Transition>
</template>

<script setup>
defineProps({
  show: Boolean,
  platform: Object
})
</script>