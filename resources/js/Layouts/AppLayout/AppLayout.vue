<script setup lang="ts">
import { ref } from 'vue';
import AppBar from './AppBar/AppBar.vue';
import { onMounted } from 'vue';
import { onUnmounted } from 'vue';
import { provide } from 'vue';
import { ScreenInfo } from '@/types';

const theme = ref<"light" | "dark">("dark");

const handleThemeModeChange = (mode: string) => {
    theme.value = mode == "dark" ? "light" : "dark";
}

const screenInfo = ref<ScreenInfo>({ size: "sm" });
const matchMedia = window.matchMedia('(min-width: 640px)');

const onResize = () => {
    screenInfo.value = {
        size: matchMedia.matches ? "lg" : "sm",
    };
}

onMounted(() => {
    screenInfo.value = {
        size: matchMedia.matches ? "lg" : "sm",
    };
    matchMedia.addEventListener("change", onResize);
});


onUnmounted(() => {
    matchMedia.removeEventListener("change", onResize);
});

provide("screenInfo", screenInfo);

</script>

<template>
    <div :class="`${theme} min-h-screen relative divide-primary bg-surface-50 text-primary !border-primary`">
        <AppBar :theme-mode="theme" @theme-change="handleThemeModeChange" />
        <slot />
    </div>
</template>
