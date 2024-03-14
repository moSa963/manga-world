<script setup lang="ts">
import AppLayout from '../../Layouts/AppLayout/AppLayout.vue';
import ChaptersList from './ChaptersList/ChaptersList.vue';
import SeriesBanner from './SeriesBanner/SeriesBanner.vue';
import { Series } from '@/types';

defineProps<{
    series: Series,
}>();


</script>


<template>
    <AppLayout :title="series.title">
        <SeriesBanner :series="series" />
        <div class="w-full flex pb-96 pt-11">

            <div class="flex-[2] overflow-hidden relative ">
                <ChaptersList :series="series" />
            </div>

            <div class="flex-1">

            </div>
        </div>
    </AppLayout>
</template>