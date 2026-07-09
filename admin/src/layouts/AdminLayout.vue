<template>
    <div class="flex min-h-screen bg-zinc-950 text-white">

        <AdminSidebar />

        <div class="flex flex-1 flex-col">

            <AdminHeader />

            <main class="flex-1 overflow-auto p-8">

                <router-view />

            </main>

        </div>

    </div>
</template>

<script setup>
import AdminSidebar from "@/components/admin/AdminSidebar.vue";
import AdminHeader from "@/components/admin/AdminHeader.vue";
</script>
