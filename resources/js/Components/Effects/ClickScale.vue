<script setup lang="ts">
import { ref } from 'vue';

const click = ref(false);

const emits = defineEmits<{
    click: []
}>();

withDefaults(
    defineProps<{
        scale?: number
    }>(),
    {
        scale: 0.95
    },
);

const handleDown = () => {
    click.value = true;
}

const handleUp = () => {
    click.value = false;
}

const handleClick = () => {
    emits("click");
}
</script>

<template>
    <div @click="handleClick" @mousedown="handleDown" @mouseup="handleUp" @mouseleave="handleUp"
        class="root relative cursor-pointer hover:after:bg-divider/10 overflow-hidden"
        :style="{ transform: `scale(${click ? 100 * scale : 100}%)`, opacity: click ? 0.9 : 1 }">
        <slot />
    </div>
</template>


<style scoped>
.root::after {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;
}
</style>