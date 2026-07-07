<template>
  <section class="border-y border-white/10 py-6 sm:py-8 lg:py-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
      <!-- Platform logos row -->
      <div
        class="flex flex-wrap items-center justify-center gap-4 text-sm text-white/40 sm:gap-6 sm:text-base lg:gap-10"
      >
        <span>Spotify</span>
        <span>Apple Music</span>
        <span>Boomplay</span>
        <span>Audiomack</span>
        <span>Deezer</span>
        <span>YouTube Music</span>
        <span>Tidal</span>
      </div>

      <!-- Footer notice -->
      <div class="mt-6 text-center text-xs text-white/30 sm:mt-8 sm:text-sm">
        <p>
          &copy; {{ new Date().getFullYear() }}
          <span class="font-medium text-white/50">Pecker Digital</span>.
          All rights reserved. | Powered by Pecker Digital
        </p>
      </div>
    </div>
  </section>
</template>