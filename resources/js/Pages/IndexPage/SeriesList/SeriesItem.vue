<script setup lang="ts">
import { Series } from '@/types';
import ChapterChip from '@/Components/ChapterChip.vue';

defineProps<{
    series: Series,
}>();

</script>

<template>
    <div class="flex flex-1 min-w-80">
        <div class="h-44 min-h-46 aspect-[2/3] overflow-hidden rounded-xl sm:rounded-2xl">
            <img :src="route('api.series.poster', series.id)" class="object-cover" />
        </div>
        <div class="h-full flex flex-col pl-2">
            <p class="font-extrabold font-serif text-lg sm:text-xl md:text-2xl p-1 md:p-3 text-secondary">
                {{ series.title }}
            </p>
            <div class="flex-1 flex items-center">
                <div class="w-1/2">
                    <ChapterChip class="h-fit mb-1" v-for="(item, index) in series.latestChapters" :key="index"
                        :chapter="item" :series="series" />
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>
