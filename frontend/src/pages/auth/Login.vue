<template>
  <div class="min-h-screen flex items-center justify-center bg-black px-6">
    <form
      @submit.prevent="submit"
      class="w-full max-w-md rounded-2xl bg-zinc-900 p-8 space-y-6"
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
          Artist Login
        </h1>
        <p class="text-white/50">
          Sign in to manage your campaigns.
        </p>
      </div>

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
          class="absolute inset-y-0 right-0 flex items-center px-4 text-white/50 transition hover:text-green-400"
        >
          <Eye v-if="!showPassword" class="h-5 w-5" />
          <EyeOff v-else class="h-5 w-5" />
        </button>
      </div>

      <!-- Forgot Password Link -->
      <div class="flex justify-end">
        <RouterLink
          to="/forgot-password"
          class="text-sm text-green-400 hover:underline"
        >
          Forgot Password?
        </RouterLink>
      </div>

      <!-- Login Button -->
      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black transition hover:bg-green-400 disabled:cursor-not-allowed disabled:opacity-60"
      >
        {{ loading ? "Signing in..." : "Login" }}
      </button>

      <!-- Register Link -->
      <div class="text-center text-sm text-white/60">
        Don't have an account?
        <RouterLink
          to="/register"
          class="ml-1 font-semibold text-green-400 transition hover:text-green-300"
        >
          Sign Up
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

const form = reactive({
  email: "",
  password: "",
});

async function submit() {
  loading.value = true;

  try {
    await auth.login(form);
    router.push("/dashboard");
  } catch (error) {
    /*
    |--------------------------------------------------------------------------
    | Email not verified
    |--------------------------------------------------------------------------
    */
    if (
      error.response?.status === 403 &&
      error.response?.data?.verified === false
    ) {
      router.push({
        name: "verify-email",
        query: {
          email: form.email,
        },
      });
      return;
    }

    /*
    |--------------------------------------------------------------------------
    | Awaiting approval
    |--------------------------------------------------------------------------
    */
    if (
      error.response?.status === 403 &&
      error.response?.data?.approved === false
    ) {
      router.push("/await-approval");
      return;
    }

    if (error.response?.status === 401) {
      alert("Invalid email or password.");
      return;
    }

    alert(
      error.response?.data?.message ||
      "Something went wrong."
    );
  } finally {
    loading.value = false;
  }
}
</script>