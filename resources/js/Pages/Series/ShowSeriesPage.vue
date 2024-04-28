<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '../../Layouts/AppLayout/AppLayout.vue';
import ChaptersList from './ChaptersList/ChaptersList.vue';
import SeriesBanner from './SeriesBanner/SeriesBanner.vue';
import { Series } from '@/types';

const props = defineProps<{
    series: Series,
}>();

const seriesRef = ref(props.series);

const handleChange = (series: Series) => {
    seriesRef.value = series;
}
</script>


<template>
    <AppLayout :title="seriesRef.title">
        <div class="w-full max-w-7xl">
            <SeriesBanner :series="seriesRef" @change="handleChange" />
            <div class="w-full flex flex-col sm:flex-row pb-96 pt-11 ">

                <div class="flex-[2] overflow-hidden relative ">
                    <ChaptersList :series="seriesRef" />
                </div>

                <div class="flex-1">

                </div>
            </div>
        </div>
    </AppLayout>
</template>