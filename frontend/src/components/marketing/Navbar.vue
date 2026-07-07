<template>
  <header
    class="sticky top-0 z-50 border-b border-white/10 bg-[#09090B]/80 backdrop-blur-xl"
  >
    <div
      class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6"
    >
      <!-- Logo -->
      <router-link
        to="/"
        class="text-3xl font-black text-green-400"
      >
        Fanget
      </router-link>

      <!-- Desktop Navigation -->
      <nav class="hidden items-center gap-10 md:flex">

        <a
          href="#features"
          class="text-white/70 transition hover:text-white"
        >
          Features
        </a>

        <a
          href="#how"
          class="text-white/70 transition hover:text-white"
        >
          How it Works
        </a>

        <router-link
          to="/login"
          class="text-white/70 transition hover:text-white"
        >
          Login
        </router-link>

        <router-link
          to="/register"
          class="rounded-full bg-green-500 px-6 py-3 font-semibold text-black transition hover:scale-105 hover:bg-green-400"
        >
          Create Free Link
        </router-link>

      </nav>

      <!-- Mobile Menu Button -->
      <button
        class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 md:hidden"
        @click="toggleMenu"
      >
        <Menu
          v-if="!menuOpen"
          class="h-6 w-6"
        />

        <X
          v-else
          class="h-6 w-6"
        />
      </button>

    </div>

    <!-- Mobile Navigation -->
    <Transition name="mobile-menu">

      <div
        v-if="menuOpen"
        class="border-t border-white/10 bg-[#09090B] md:hidden"
      >

        <nav class="flex flex-col p-6">

          <a
            href="#features"
            class="py-4 text-lg text-white/80 transition hover:text-green-400"
            @click="closeMenu"
          >
            Features
          </a>

          <a
            href="#how"
            class="py-4 text-lg text-white/80 transition hover:text-green-400"
            @click="closeMenu"
          >
            How it Works
          </a>

          <router-link
            to="/login"
            class="py-4 text-lg text-white/80 transition hover:text-green-400"
            @click="closeMenu"
          >
            Login
          </router-link>

          <router-link
            to="/register"
            class="mt-6 rounded-full bg-green-500 py-4 text-center font-semibold text-black transition hover:bg-green-400"
            @click="closeMenu"
          >
            Create Free Link
          </router-link>

        </nav>

      </div>

    </Transition>

  </header>
</template>

<script setup>
import { ref, watch } from "vue";
import { Menu, X } from "lucide-vue-next";

const menuOpen = ref(false);

function toggleMenu() {
  menuOpen.value = !menuOpen.value;
}

function closeMenu() {
  menuOpen.value = false;
}

// Prevent background scrolling while menu is open
watch(menuOpen, (open) => {
  document.body.style.overflow = open ? "hidden" : "";
});
</script>

<style scoped>
.mobile-menu-enter-active,
.mobile-menu-leave-active {
  transition: all .25s ease;
}

.mobile-menu-enter-from,
.mobile-menu-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
</style>