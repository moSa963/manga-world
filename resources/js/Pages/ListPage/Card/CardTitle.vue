<script setup lang="ts">
defineProps<{
    hover: boolean,
}>();

</script>

<template>
    <div
        :class="`absolute transition-all max-h-[30%] ${hover ? 'bottom-0 rounded-none left-0 right-0' : 'bottom-5 rounded-3xl left-1 right-1'} overflow-hidden text-center bg-surface-200 py-1 bg-opacity-20`">
        <slot />
    </div>
</template>