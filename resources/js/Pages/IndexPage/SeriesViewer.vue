<script setup lang="ts">
import Viewer from '@/Components/ListViewer/ListViewer.vue';
import { Response, Series } from '@/types';
import fetchList from '@/utils/FetchList';
import { onMounted, ref } from 'vue';
import SeriesViewerItem from './SeriesViewerItem.vue';
import { router } from '@inertiajs/vue3';

const data = ref<Response<Series> | null>(null);
const progress = ref<boolean>(false);

onMounted(async () => {
    await getData();
});


const getData = async () => {
    await fetchList(data, route("api.series.list", { sort: "new_add" }), progress);
}

const handleClick = (series: Series) => {
    router.get(route("series.show", {
        series: series.id,
    }),
    );
}
</script>

<template>
    <Viewer @click="handleClick" :data="data?.data || []" class="p-20 sm:p-0">
        <template #default="{ value }">
            <SeriesViewerItem :series="value" />
        </template>
    </Viewer>
</template>
