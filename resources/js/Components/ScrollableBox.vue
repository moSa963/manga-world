<script setup lang="ts">
import { ScrollType } from '@/Components/WindowScroll.vue';


const emits = defineEmits<{
    "scroll": [scroll: ScrollType],
}>();

const onScroll = (e: Event) => {
    const t = (e.target as HTMLElement);
    emits("scroll", {
        value: t.scrollTop,
        innerHeight: window.innerHeight,
        ratio: t.scrollTop / (t.clientHeight - window.innerHeight),
    });
}

</script>

<template>
    <div @scroll="onScroll">
        <slot />
    </div>
</template>