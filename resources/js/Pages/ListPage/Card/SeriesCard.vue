<script setup lang="ts">
import { ref } from 'vue';
import { Series } from '@/types';
import CardTitle from './CardTitle.vue';
import CardImg from './CardImg.vue';
import Chip from '@/Components/Chip.vue';

const hover = ref(false);

defineProps<{
    series: Series,
}>();

const handleMouseEnter = () => {
    hover.value = true;
}

const handleMouseLeave = () => {
    hover.value = false;
}

</script>

<template>
    <div class="relative overflow-hidden flex justify-center items-center transition-transform rounded-2xl border-[1px] border-primary p-1 cursor-pointer select-none"
        @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">

        <div class="w-full h-[20%] flex gap-2 justify-center items-center bg-surface-50 shadow-inner">
            <Chip @click="() => console.log('chapter 1107')">
                <p>1107</p>
            </Chip>
            <Chip @click="() => console.log('chapter 1106')">
                <p>1106</p>
            </Chip>
        </div>

        <div
            class="absolute inset-0 overflow-hidden rounded-2xl border-surface-50 border-[3px] grayscale-0 hover:grayscale-[50%] pointer-events-none">

            <CardImg :src="series.image" :open="hover" />

            <CardTitle :hover="hover">
                <p class="font-bold">{{ series.title }}</p>
            </CardTitle>
        </div>
    </div>
</template>

