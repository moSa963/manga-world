<script setup lang="ts">
import ClickScale from './Effects/ClickScale.vue';

defineEmits<{
    click: [],
}>();

</script>

<template>
    <ClickScale @click="$emit('click')"
        class="bg-surface-100 rounded-full p-2 ml-3 hover:outline-[1px] outline-0 outline-divider/75 outline">
        <slot />
    </ClickScale>
</template>