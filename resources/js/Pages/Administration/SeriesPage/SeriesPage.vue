<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import SearchField from '@/Components/SearchBar/SearchField.vue';
import { ScrollType } from '@/Components/WindowScroll.vue';
import AdministrationLayout from '@/Layouts/AdministrationLayout/AdministrationLayout.vue';
import { Response, Series } from '@/types';
import fetchList from '@/utils/FetchList';
import { onMounted, ref, watch } from 'vue';
import SeriesListItem from './SeriesListItem.vue';
import ToggleButton from '@/Components/Input/ToggleButton.vue';


const data = ref<Response<Series> | null>(null);
const progress = ref<boolean>(false);
const circularProgress = ref<HTMLDivElement>();
const filter = ref<string>('');

defineProps<{
    permissions: Array<string>,
}>();

const getData = async (key: string, reset?: boolean) => {
    const url = (data.value && !reset) ? data.value.links.next : route("api.series.list", { key, filter: filter.value });
    await fetchList(data, url, progress, reset);
}

onMounted(async () => {
    await getData("");
});

const handleChange = (scroll: ScrollType) => {
    if ((circularProgress.value?.offsetTop || 0) - scroll.value < scroll.innerHeight) {
        getData("");
    }
}

const handleKeyChange = async (v: string) => {
    await getData(v, true);
}

watch(filter, async (newValue, oldValue) => {
    if (newValue != oldValue) {
        await getData("", true);
    }
});

const onSeriesUpdate = (series: Series) => {
    const i = data.value?.data.findIndex(e => e.id == series.id);

    if (!i || i == -1 || data.value == null) return;

    data.value.data[i] = series;
}
</script>

<template>
    <AdministrationLayout @scroll="handleChange" selected="series">

        <div class="w-full my-10 flex">
            <ToggleButton allow-empty :values="['published', 'unpublished']" v-model="filter" />
        </div>

        <div class="w-full h-16 bg-surface-300 flex">
            <SearchField @change="handleKeyChange" />
        </div>

        <SeriesListItem v-for="series in data?.data" :key="series.id" @seriesUpdate="onSeriesUpdate" :series="series" />

        <div v-if="data?.links.next" ref="circularProgress" class="flex justify-center my-4">
            <CircularProgress class="size-24" />
        </div>
    </AdministrationLayout>
</template>