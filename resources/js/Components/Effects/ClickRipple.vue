<script setup lang="ts">
import { ref } from 'vue';
const click = ref<{ active: boolean, x: number, y: number } | null>(null);

const props = defineProps<{
    disabled?: boolean | null,
}>();

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

    if (!props.disabled) {
        emits("click");
    }

    if (!click.value.active) {
        click.value = null;
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
        :class="`relative overflow-hidden ${disabled ? 'opacity-50' : ''}`">
        <div v-if="click" class="absolute bg-primary-400/20 aspect-square root rounded-full object-cover"
            :style="{ top: `${click?.y}px`, left: `${click?.x}px` }">

        </div>
        <slot />
    </div>
</template>

<style scoped>
.root {
    animation: anim 400ms forwards;
    transform: translate(-50%, -50%);
    width: 1rem;
    height: 1rem;
}

@keyframes anim {
    100% {
        transform: translate(0%, 0%);
        width: 100%;
        height: 100%;
        top: 0%;
        left: 0%;
        border-radius: 0px;
    }
}
</style>