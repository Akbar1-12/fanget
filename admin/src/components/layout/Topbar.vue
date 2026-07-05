<template>
    <header class="bg-red-600 h-24 flex items-center justify-between px-8">

        <h1 class="text-white text-3xl">
            THIS IS THE TOPBAR
        </h1>

        <button
            @click="logout"
            class="bg-white text-black px-6 py-2 rounded"
        >
            LOGOUT
        </button>

    </header>
</template>

<script setup>
import { useRouter } from "vue-router"
import { useAuthStore } from "@/stores/auth"

const router = useRouter()
const auth = useAuthStore()

function logout() {
    auth.logout()
    router.push("/")
}
</script>
