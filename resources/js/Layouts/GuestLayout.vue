<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-gray-100">
        <Link href="/">
        <ApplicationLogo class="w-72 h-72 fill-current text-blue-900" />
        </Link>
        <slot />
    </div>
</template>