<template>
  <div class="flex min-h-screen items-center justify-center bg-slate-950 px-6">

    <AppCard class="w-full max-w-md">

      <div class="mb-8 flex justify-center">
        <AppLogo />
      </div>

      <h2 class="mb-2 text-center text-3xl font-bold text-white">
        Welcome Back
      </h2>

      <p class="mb-8 text-center text-slate-400">
        Sign in to your Fanget dashboard.
      </p>

      <form @submit.prevent="handleLogin" class="space-y-5">

    <AppInput
        v-model="email"
        label="Email"
        placeholder="admin@fanget.com"
    />

    <AppInput
        v-model="password"
        type="password"
        label="Password"
        placeholder="••••••••"
    />

    <p
        v-if="error"
        class="text-sm text-red-500"
    >
        {{ error }}
    </p>

    <AppButton>
        {{ loading ? "Signing In..." : "Sign In" }}
    </AppButton>

</form>

    </AppCard>

  </div>
</template>

<script setup>
import { ref } from "vue"
import { useRouter } from "vue-router"

import AppLogo from "@/components/ui/AppLogo.vue"
import AppCard from "@/components/ui/AppCard.vue"
import AppInput from "@/components/ui/AppInput.vue"
import AppButton from "@/components/ui/AppButton.vue"

import { login } from "@/services/auth"
import { useAuthStore } from "@/stores/auth"

const router = useRouter()
const authStore = useAuthStore()

const email = ref("")
const password = ref("")
const loading = ref(false)
const error = ref("")

const handleLogin = async () => {
    error.value = ""
    loading.value = true

    try {
        const response = await login({
            email: email.value,
            password: password.value,
        })

        authStore.login(
            response.data.token,
            response.data.admin
        )

        router.push("/dashboard")
    } catch (err) {
        error.value =
            err.response?.data?.message || "Login failed."
    } finally {
        loading.value = false
    }
}
</script>
