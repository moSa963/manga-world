<script setup lang="ts">
defineProps<{
    hover: boolean,
}>();

</script>

<template>
    <div
        :class="`absolute transition-all max-h-[30%] ${hover ? 'bottom-0 rounded-none left-0 right-0' : 'bottom-5 rounded-xl left-1 right-1'} overflow-hidden text-center bg-surface-50/95 py-1`">
        <slot />
    </div>
</template>