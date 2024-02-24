<script setup lang="ts">
import AppLayout from '../../Layouts/AppLayout/AppLayout.vue';
import ChaptersList from './ChaptersList/ChaptersList.vue';
import SeriesBanner from './SeriesBanner.vue';

</script>


<template>
    <AppLayout>
        <SeriesBanner />
        <div class="w-full flex pb-96 pt-11">

            <div class="flex-[2] overflow-hidden relative ">
                <ChaptersList />
            </div>

            <div class="flex-1">

            </div>
        </div>
    </AppLayout>
</template>