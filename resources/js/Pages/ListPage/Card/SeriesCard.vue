<script setup lang="ts">
import { ref } from 'vue';
import { Series } from '@/types';
import CardTitle from './CardTitle.vue';
import CardImg from './CardImg.vue';
import { Link } from '@inertiajs/vue3';
import ChapterChip from '@/Components/ChapterChip.vue';

const hover = ref(false);

const p = defineProps<{
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
    <Link :href="route('series.show', series.id)"
        class="relative overflow-hidden flex justify-center items-center transition-transform rounded-2xl border-[1px] border-primary p-1 cursor-pointer select-none"
        @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">

    <div
        class="w-full h-[20%] flex flex-row-reverse gap-2 justify-center items-center bg-surface-50 shadow-inner overflow-hidden">
        <ChapterChip v-for="(item, index) in p.series.latestChapters" :key="index" :chapter="item" :series="series" />
    </div>

    <div
        class="absolute inset-0 overflow-hidden rounded-2xl border-surface-50 border-[3px] grayscale-0 hover:grayscale-[50%] pointer-events-none">

        <CardImg :src="route('api.series.poster', series.id)" :open="hover" />

        <CardTitle :hover="hover">
            <p :class="`${series.published ? '' : 'text-primary-100'} font-bold`">{{ series.title }}</p>
        </CardTitle>
    </div>
    </Link>
</template>
