<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps<{
    disabled?: boolean | null,
}>();

const emits = defineEmits<{
    click: [],
}>();

const pos = ref<{ x: number, y: number } | null>(null);
const animEnd = ref<boolean>(false);

const handleDown = (e: MouseEvent) => {
    animEnd.value = false;
    pos.value = {
        x: e.offsetX,
        y: e.offsetY,
    }
}

const handleLeave = () => {
    pos.value = null;
}

const handleAnimationend = () => {
    animEnd.value = true;
}

const handleClick = () => {
    if (animEnd.value) {
        return clickAction();
    }

    setTimeout(() => {
        clickAction();
    }, 200);
}

const clickAction = () => {
    if (!props.disabled) {
        emits('click');
    }

    pos.value = null;
}
</script>



<template>
    <div @click="handleClick" @mousedown="handleDown" @animationend="handleAnimationend" @mouseleave="handleLeave"
        :class="`relative overflow-hidden ${disabled ? 'opacity-50' : ''}`">

        <div v-if="pos" :class="`effect ${disabled ? 'bg-divider/20' : 'bg-primary-400/10'}`"
            :style="{ top: `${pos.y}px`, left: `${pos.x}px` }">

        </div>

        <slot />
    </div>
</template>

<style scoped>
.effect {
    position: absolute;
    animation: anim 500ms forwards;
    width: 1%;
    height: 1%;
    transform: translate(-50%, -50%);
    border-radius: inherit;
}

@keyframes anim {
    0% {
        width: 1%;
        height: 1%;
    }

    100% {
        width: 200%;
        height: 200%;
    }
}
</style>