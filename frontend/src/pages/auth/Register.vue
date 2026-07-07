<template>
  <div class="min-h-screen flex items-center justify-center bg-black px-6">
    <form
      @submit.prevent="submit"
      class="w-full max-w-lg rounded-2xl bg-zinc-900 p-8 space-y-6"
    >
      <!-- Back to Home link -->
      <RouterLink
        to="/"
        class="flex items-center text-sm text-white/50 transition hover:text-white -mt-2"
      >
        <ChevronLeft class="h-4 w-4 mr-1" />
        Back to Home
      </RouterLink>

      <div class="space-y-2 text-center">
        <h1 class="text-3xl font-bold text-white">
          Artist Registration
        </h1>
        <p class="text-white/50">
          Create your artist account and start promoting your music.
        </p>
      </div>

      <!-- Full Name -->
      <input
        v-model="form.name"
        type="text"
        placeholder="Full Name"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-green-500"
      />

      <!-- Artist Name -->
      <input
        v-model="form.artist_name"
        type="text"
        placeholder="Artist Name"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-green-500"
      />

      <!-- Email -->
      <input
        v-model="form.email"
        type="email"
        placeholder="Email Address"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-green-500"
      />

      <!-- Password -->
      <div class="relative">
        <input
          v-model="form.password"
          :type="showPassword ? 'text' : 'password'"
          placeholder="Password"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 pr-12 text-white outline-none transition focus:border-green-500"
        />
        <button
          type="button"
          @click="showPassword = !showPassword"
          class="absolute inset-y-0 right-0 flex items-center px-4 text-white/50 hover:text-green-400"
        >
          <Eye v-if="!showPassword" class="h-5 w-5" />
          <EyeOff v-else class="h-5 w-5" />
        </button>
      </div>

      <!-- Confirm Password -->
      <div class="relative">
        <input
          v-model="form.password_confirmation"
          :type="showConfirmPassword ? 'text' : 'password'"
          placeholder="Confirm Password"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 pr-12 text-white outline-none transition focus:border-green-500"
        />
        <button
          type="button"
          @click="showConfirmPassword = !showConfirmPassword"
          class="absolute inset-y-0 right-0 flex items-center px-4 text-white/50 hover:text-green-400"
        >
          <Eye v-if="!showConfirmPassword" class="h-5 w-5" />
          <EyeOff v-else class="h-5 w-5" />
        </button>
      </div>

      <!-- Password Hint -->
      <p class="text-sm text-white/40">
        Password should be at least <strong class="text-white">8 characters</strong> and contain uppercase, lowercase and a number.
      </p>

      <!-- Submit -->
      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black transition hover:bg-green-400 disabled:cursor-not-allowed disabled:opacity-60"
      >
        {{ loading ? "Creating account..." : "Create Account" }}
      </button>

      <!-- Login -->
      <div class="text-center text-sm text-white/60">
        Already have an account?
        <RouterLink
          to="/login"
          class="ml-1 font-semibold text-green-400 hover:text-green-300 transition"
        >
          Login
        </RouterLink>
      </div>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useRouter, RouterLink } from "vue-router";
import { Eye, EyeOff, ChevronLeft } from "lucide-vue-next";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const auth = useAuthStore();

const loading = ref(false);
const showPassword = ref(false);
const showConfirmPassword = ref(false);

const form = reactive({
  name: "",
  artist_name: "",
  email: "",
  password: "",
  password_confirmation: "",
});

async function submit() {
  loading.value = true;
  try {
    await auth.register(form);
    router.push("/await-approval");
  } catch (error) {
    console.error(error);
    alert(
      error.response?.data?.message ||
      "Registration failed."
    );
  } finally {
    loading.value = false;
  }
}
</script>