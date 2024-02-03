<script setup lang="ts">
import AppBar from './AppBar.vue';
</script>

<template>
    <div class="min-h-screen relative">
        <AppBar />

        <slot />
    </div>
</template>
