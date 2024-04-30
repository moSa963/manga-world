<script setup lang="ts">
import { Series } from '@/types';
import Card from './Card/SeriesCard.vue';

defineProps<{

    series: Array<Series>,

}>();


</script>



<template>
    <div :class="`relative flex w-full flex-wrap justify-center gap-2 sm:gap-5`">
        <Card :series="card" :key="card.id" :class="`w-full max-w-28 sm:max-w-52 shrink-0 aspect-square`"
            v-for="(card, _) in series" />

    </div>
</template>
