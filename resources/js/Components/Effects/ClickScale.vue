<script setup lang="ts">
import { ref } from 'vue';

const click = ref(false);

const emits = defineEmits<{
    click: []
}>();

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
        :style="{ transform: `scale(${click ? 0.99 : 1})` }">
        <slot />
    </div>
</template>