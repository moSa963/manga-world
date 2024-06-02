<script setup lang="ts">
import { onMounted, ref } from 'vue';
import SeriesItem from './SeriesItem.vue';
import { Response, Series } from '@/types';
import fetchList from '@/utils/FetchList';
import CircularProgress from '@/Components/CircularProgress.vue';

const data = ref<Response<Series> | null>(null);
const progress = ref<boolean>(false);

const props = defineProps<{
    title: string,
    genre: string,
    count?: number
}>();

onMounted(async () => {
    await getData();
});

const getData = async () => {
    const url = route("api.series.list", { genre: props.genre, count: props.count || 3 });
    await fetchList(data, url, progress, true);
}
</script>

<template>

    <p class="font-extrabold font-serif text-3xl p-1 md:p-3">{{ title }}</p>
    <div class="w-full flex flex-wrap gap-4 p-5">
        <SeriesItem v-if="data" v-for="v in data?.data" :series="v" />
        <CircularProgress v-if="!data" class="size-24" />
    </div>
</template>