<script setup lang="ts">
import ClickScale from './Effects/ClickScale.vue';

const emits = defineEmits<{
    click: [],
}>();

const handleClick = () => {
    emits("click");
}
</script>

<template>
    <ClickScale class="px-1 h-fit border-primary border-[1px] rounded-lg cursor-pointer hover:bg-surface-600"
        @click="handleClick">
        <slot />
    </ClickScale>
</template>