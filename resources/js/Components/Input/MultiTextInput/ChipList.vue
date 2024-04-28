<script setup lang="ts">
import InputChip from './InputChip.vue';

defineProps<{
    error: boolean,
    data?: string[],
}>();

defineEmits<{
    click: [number],
}>();

</script>


<template>
    <div
        :class="`flex gap-1 flex-wrap m-3 p-3 border-[1px] border-t-0 ${error ? 'border-red-700' : 'border-divider/25'}`">
        <InputChip v-for="(text, i) in data" :key="i" :text="text" @click="$emit('click', i)" />
    </div>
</template>