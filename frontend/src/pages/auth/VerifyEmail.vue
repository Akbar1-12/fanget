<template>
    <div class="min-h-screen flex items-center justify-center bg-black px-6">

        <div class="w-full max-w-md rounded-2xl bg-zinc-900 p-8">

            <h1 class="text-3xl font-bold text-white">
                Verify your Email
            </h1>

            <p class="mt-4 text-zinc-400">
                Before you can log in, you need to verify your email address.
            </p>

            <button
                @click="resend"
                :disabled="loading"
                class="mt-8 w-full rounded-xl bg-green-500 py-3 font-semibold text-black"
            >
                {{ loading ? "Sending..." : "Resend Verification Email" }}
            </button>

            <router-link
                to="/login"
                class="mt-6 block text-center text-green-400"
            >
                Back to Login
            </router-link>

        </div>

    </div>
</template>

<script setup>
import api from "@/services/api";
import { ref } from "vue";

const loading = ref(false);

async function resend() {

    loading.value = true;

    try {

        await api.post("/v1/email/resend");

        alert("Verification email sent.");

    } catch {

        alert("Unable to send email.");

    }

    loading.value = false;

}
</script>