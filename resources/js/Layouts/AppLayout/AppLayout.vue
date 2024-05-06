<script setup lang="ts">
import { ref } from 'vue';
import AppBar from './AppBar/AppBar.vue';
import { Head } from '@inertiajs/vue3';
import Layout from '../Layout.vue';

defineProps<{
    title: string,
    hideAppBar?: boolean
}>();

const theme = ref<"light" | "dark">(window.localStorage.getItem("theme") == "light" ? "light" : "dark");

const handleThemeModeChange = (mode: string) => {
    theme.value = mode == "dark" ? "light" : "dark";
    window.localStorage.setItem("theme", theme.value);
}

</script>

<template>
    <Layout>

        <Head :title="title" />

        <div :class="`${theme} min-h-screen relative divide-primary bg-surface-0 text-primary`">
            <AppBar :theme-mode="theme" @theme-change="handleThemeModeChange" :hidden="Boolean(hideAppBar)" />
            <div class=" bg-inherit flex flex-col items-center">
                <slot />
            </div>
        </div>
    </Layout>
</template>
