<template>
  <div class="relative min-h-screen overflow-x-hidden bg-black text-white">
    <!-- Ambient Background Glow -->
    <div
      aria-hidden="true"
      class="pointer-events-none fixed inset-0 -z-10 overflow-hidden"
    >
      <div
        class="absolute left-1/2 top-1/2
               h-[500px] w-[500px]
               sm:h-[650px] sm:w-[650px]
               md:h-[800px] md:w-[800px]
               lg:h-[1000px] lg:w-[1000px]
               -translate-x-1/2 -translate-y-1/2
               rounded-full
               bg-green-400/25
               blur-[120px]
               sm:blur-[160px]
               md:blur-[200px]
               lg:blur-[260px]"
      ></div>
    </div>

    <!-- Page Container -->
    <main
      class="mx-auto
             w-full
             max-w-7xl
             px-4
             sm:px-6
             md:px-8
             lg:px-10
             py-8
             sm:py-10
             md:py-14
             lg:py-20"
    >
      <slot />
    </main>
  </div>
</template>

<script setup>
</script>