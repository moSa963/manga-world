<script setup lang="ts">

const emits = defineEmits<{
    click: [],
}>();

const handleClick = () => {
    emits("click");
}
</script>


<template>
    <div @click="handleClick"
        class="relative flex justify-center items-center cursor-pointer p-1 py-2 rounded-lg hover:bg-primary-200/15 transition-colors border-primary-100/75 select-none overflow-hidden ">
        <slot />
    </div>
</template>