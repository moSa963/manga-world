<script setup lang="ts">
import { ref } from 'vue';
import { onMounted } from 'vue';
import { onUnmounted } from 'vue';
import { provide } from 'vue';
import { ScreenInfo } from '@/types';

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
    <slot />
</template>
