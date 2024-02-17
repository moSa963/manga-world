<script setup lang="ts">
const emits = defineEmits<{
    click: [],
}>();

const handleClick = (payload: MouseEvent) => {
    emits("click");
}
</script>

<template>
    <div class="px-1 h-fit border-primary border-[1px] rounded-lg cursor-pointer hover:bg-surface-600" @click="handleClick">
        <slot />
    </div>
</template>