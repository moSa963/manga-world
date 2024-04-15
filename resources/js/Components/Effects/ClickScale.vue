<script setup lang="ts">
import { computed, ref } from 'vue';

const click = ref(false);

const emits = defineEmits<{
    click: []
}>();

const props = withDefaults(
    defineProps<{
        scale?: number,
        disabled?: boolean,
    }>(),
    {
        scale: 0.95,
        disabled: false,
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

const itemStyle = computed(() => {
    if (props.disabled) {
        return { transform: "scale(1)", opacity: 1 };
    }
    return { transform: `scale(${click.value ? 100 * props.scale : 100}%)`, opacity: click.value ? 0.9 : 1 };
})
</script>

<template>
    <div @click="handleClick" @mousedown="handleDown" @mouseup="handleUp" @mouseleave="handleUp"
        :class="`root relative cursor-pointer overflow-hidden select-none ${disabled ? '' : 'hover:after:bg-divider/10'}`"
        :style="itemStyle">
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