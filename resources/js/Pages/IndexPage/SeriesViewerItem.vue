<script setup lang="ts">
import ChapterChip from '@/Components/ChapterChip.vue';
import { Series } from '@/types';


defineProps<{
    series: Series,
}>();

</script>


<template>
    <div class="w-full h-full bg-surface-50 p-1 overflow-hidden flex">

        <div class="bg-surface-50 flex-1 flex flex-col p-1">
            <div class="flex-1 flex justify-center items-center text-center overflow-hidden">
                <p class="font-extrabold font-serif text-lg sm:text-2xl">{{ series.title }}</p>
            </div>
            <div class="w-full flex-1 flex flex-row-reverse gap-2 justify-center items-center overflow-hidden">
                <ChapterChip v-for="c in series.latestChapters" :chapter="c" :series="series" />
            </div>
        </div>

        <div class="rounded-r-lg flex-1 overflow-hidden">
            <img :src="route('api.series.poster', series.id)" class="object-cover" />
        </div>
    </div>
</template>