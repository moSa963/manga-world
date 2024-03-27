<script setup lang="ts">
import ClickScale from '../Effects/ClickScale.vue';

defineProps<{
    src?: string,
    title: string,
    secondary: string,
}>();

defineEmits<{
    click: [],
}>();

</script>


<template>
    <ClickScale :scale="0.99" @click="$emit('click')">
        <div class="w-full flex h-16 gap-2">
            <div class="h-full aspect-square overflow-hidden">
                <img :src="src" class="object-cover" />
            </div>
            <div class="flex flex-col h-full justify-center">
                <p>{{ title }}</p>
                <p class="text-divider text-sm">{{ secondary }}</p>
            </div>
        </div>
    </ClickScale>
</template>
