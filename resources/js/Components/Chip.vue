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
    <ClickScale
        class="relative px-1 h-fit border-primary border-[1px] rounded-lg cursor-pointer text-center select-none"
        @click="handleClick">
        <slot />
    </ClickScale>
</template>