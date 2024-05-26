<script setup lang="ts">
import ClickScale from './Effects/ClickScale.vue';


defineProps<{
    src?: string,
    title: string,
    secondary?: string,
    disabled?: boolean,
    scale?: number,
}>();

defineEmits<{
    click: [],
}>();

</script>


<template>
    <ClickScale :disabled="disabled" :scale="scale" @click="$emit('click')">
        <div class="w-full flex h-16 gap-2">
            <div v-if="src" class="h-full aspect-square overflow-hidden">
                <img :src="src" class="object-cover" />
            </div>
            <div class="flex-1 flex flex-col h-full justify-center overflow-hidden">
                <p class="w-full text-nowrap overflow-hidden overflow-ellipsis">{{ title }}</p>
                <p v-if="secondary" class="text-divider text-sm">{{ secondary }}</p>
            </div>
            <slot />
        </div>
    </ClickScale>
</template>
