<script setup lang="ts">
import { ref } from 'vue';


const click = ref<{ active: boolean, x: number, y: number } | null>(null);


const emits = defineEmits<{
    click: [],
}>();


const handleDown = (e: MouseEvent) => {
    click.value = {
        active: true,
        x: e.offsetX,
        y: e.offsetY,
    }
}

const handleUp = () => {
    if (click.value == null) {
        return;
    }

    if (!click.value.active) {
        click.value = null;
        emits("click");
        return;
    }

    click.value = {
        ...click.value,
        active: false,
    };
}

const handleLeave = () => {
    click.value = null;
}

</script>


<template>
    <div @mousedown="handleDown" @mouseup="handleUp" @mouseleave="handleLeave" @animationend="handleUp"
        class="relative flex justify-center items-center cursor-pointer p-1 py-2 rounded-lg hover:bg-primary-400/10 transition-colors border-primary-100/75 select-none overflow-hidden ">
        <div v-if="click" class="absolute bg-primary-400/20 aspect-square root rounded-full object-cover"
            :style="{ top: `${click?.y}px`, left: `${click?.x}px` }">

        </div>
        <slot />
    </div>
</template>

<style scoped>
.root {
    animation: anim 300ms forwards;
    transform: translate(-50%, -50%);
    width: 1rem;
    height: 1rem;
}

@keyframes anim {
    to {
        transform: translate(0%, 0%);
        width: 100%;
        height: 100%;
        top: 0%;
        left: 0%;
        border-radius: 0%;
    }
}
</style>