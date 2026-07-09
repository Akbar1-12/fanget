<template>
  <div class="min-h-screen flex items-center justify-center bg-black px-6">

    <form
      @submit.prevent="submit"
      class="w-full max-w-md rounded-2xl bg-zinc-900 p-8 space-y-6"
    >

      <div class="text-center">

        <h1 class="text-3xl font-bold text-white">
          Forgot Password
        </h1>

        <p class="mt-2 text-zinc-400">
          Enter your email address and we'll send you a password reset link.
        </p>

      </div>

      <input
        v-model="email"
        type="email"
        placeholder="Email"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
      />

      <button
        :disabled="loading"
        class="w-full rounded-xl bg-green-500 py-3 font-semibold text-black"
      >
        {{ loading ? "Sending..." : "Send Reset Link" }}
      </button>

      <p
        v-if="success"
        class="text-center text-green-400"
      >
        Password reset email sent.
      </p>

      <router-link
        to="/login"
        class="block text-center text-green-400"
      >
        Back to Login
      </router-link>

    </form>

  </div>
</template>

<script setup>
import { ref } from "vue";
import api from "@/services/api";

const email = ref("");
const loading = ref(false);
const success = ref(false);

async function submit() {

    loading.value = true;

    try {

        await api.post("/v1/forgot-password", {

            email: email.value,

        });

        success.value = true;

    } catch {

        alert("Unable to send reset email.");

    }

    loading.value = false;

}
</script>