<script setup lang="ts">
import { onUnmounted } from 'vue';
import { onMounted } from 'vue';

export interface ScrollType {
    value: number,
    innerHeight: number,
    ratio: number
}

const emits = defineEmits<{
    "change": [scroll: ScrollType],
}>();

const onScroll = () => {
    emits("change", {
        value: window.scrollY,
        innerHeight: window.innerHeight,
        ratio: window.scrollY / (document.body.clientHeight - window.innerHeight),
    });
}

onMounted(() => {
    window.addEventListener("scroll", onScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", onScroll);
});

</script>


<template>
    <slot />
</template>