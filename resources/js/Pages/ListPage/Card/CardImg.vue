<script setup lang="ts">
defineProps<{
    src: string,
    open: boolean,
}>();
</script>

<template>
    <div class="absolute inset-0 overflow-hidden transition-transform"
        :style="{ 'clip-path': 'inset(0 0 50% 0)', transform: `translateY(${open ? -10 : 0}%)` }">
        <img :src="src" class="absolute inset-0 object-cover" />
    </div>

    <div class="absolute inset-0 overflow-hidden transition-transform"
        :style="{ 'clip-path': 'inset(50% 0 0 0)', transform: `translateY(${open ? 10 : 0}%)` }">
        <img :src="src" class="object-cover" />
    </div>
</template>