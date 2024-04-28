<script setup lang="ts">
import ClickScale from '@/Components/Effects/ClickScale.vue';

defineProps<{
    hints: string[],
}>();

defineEmits<{
    click: [string],
}>();

</script>



<template>
    <div
        class="z-10 absolute right-0 left-0 top-full bg-surface-100 max-h-52 overflow-auto border-primary-900 border-t-0 border-[1px] rounded-b-lg">
        <ClickScale :scale="0.995" v-for="hint in hints" class="p-1" @click="() => $emit('click', hint)">
            {{ hint }}
        </ClickScale>
    </div>
</template>