<template>
  <header
    class="sticky top-0 z-50 border-b border-white/10 bg-[#09090B]/80 backdrop-blur-xl"
  >
    <div
      class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6"
    >
      <router-link
        to="/"
        class="text-3xl font-black text-green-400"
      >
        Fanget
      </router-link>

      <nav class="hidden items-center gap-10 md:flex">

        <a href="#features" class="text-white/70 hover:text-white">
          Features
        </a>

        <a href="#how" class="text-white/70 hover:text-white">
          How it Works
        </a>

        <router-link
          to="/login"
          class="text-white/70 hover:text-white"
        >
          Login
        </router-link>

        <router-link
          to="/register"
          class="rounded-full bg-green-500 px-6 py-3 font-semibold text-black transition hover:bg-green-400"
        >
          Create Free Link
        </router-link>

      </nav>

      <router-link
        to="/register"
        class="rounded-full bg-green-500 px-5 py-2 text-sm font-semibold text-black md:hidden"
      >
        Get Started
      </router-link>

    </div>
  </header>
</template>