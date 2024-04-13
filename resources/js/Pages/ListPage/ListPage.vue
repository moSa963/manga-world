<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Response, Series } from '@/types';
import { ref } from 'vue';
import { onMounted } from 'vue';
import List from './List.vue';
import CircularProgress from '@/Components/CircularProgress.vue';
import fetchList from '@/utils/FetchList';
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import { Link } from '@inertiajs/vue3';

const data = ref<Response<Series> | null>(null);
const progress = ref<boolean>(false);
const circularProgress = ref<HTMLDivElement>();

defineProps<{
    canCreateSeries?: boolean,
}>();

const getData = async () => {
    const url = data.value ? data.value.links.next : route("api.series.list");
    await fetchList(data, url, progress);
}

onMounted(async () => {
    await getData();
});

const handleChange = (scroll: ScrollType) => {
    if ((circularProgress.value?.offsetTop || 0) - scroll.value < scroll.innerHeight) {
        getData();
    }
}
</script>

<template>
    <AppLayout title="List">
        <WindowScroll @change="handleChange">
            <div class="w-full flex flex-col-reverse md:flex-row">
                <div class="flex-1 items-center ">
                    <List v-if="data" :series="data.data" />

                    <div v-if="data?.links.next" ref="circularProgress" class="flex justify-center my-4">
                        <CircularProgress class="size-24" />
                    </div>
                </div>
                <div class="w-full md:w-72 p-1">
                    <Link :href="route('series.create')">
                    <Button v-if="canCreateSeries" border>
                        <p>Add new series</p>
                    </Button>
                    </Link>
                </div>
            </div>
        </WindowScroll>
    </AppLayout>
</template>