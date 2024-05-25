<script setup lang="ts">
import { Chapter, Response, Series } from '@/types';
import { onMounted, watch } from 'vue';
import { ref } from 'vue';
import fetchList from '@/utils/FetchList';
import ListDrawer from './ListDrawer.vue';
import List from './List.vue';

const props = defineProps<{
    series: Series,
    filter: string;
}>();

const newChapters = ref<Response<Chapter> | null>(null);
const oldChapters = ref<Response<Chapter> | null>(null);
const progress = ref<boolean>(false);

onMounted(async () => {
    await load();
});

watch(props, async () => {
    await load();
});

const load = async () => {
    await fetchList(newChapters, route("api.chapter.list", {
        series: props.series,
        order: "new",
        filter: props.filter,
    }), progress, true);

    await fetchList(oldChapters, route("api.chapter.list", {
        series: props.series,
        order: "old",
        filter: props.filter,
    }), progress, true);

    checkIntersection();
}

const loadNew = async () => {
    await fetchList(newChapters, newChapters.value?.links.next || null, progress);
    checkIntersection();
}

const loadOld = async () => {
    await fetchList(oldChapters, oldChapters.value?.links.next || null, progress);
    checkIntersection();
}

const checkIntersection = () => {
    const newData = newChapters.value?.data;
    const oldData = oldChapters.value?.data;

    if (!newData || !oldData || newData.length == 0 || oldData.length == 0) {
        return;
    }

    const newItem = newData[newData.length - 1];
    const oldItem = oldData[oldData.length - 1];

    if (newItem.number > oldItem.number) {
        return;
    }

    do {
        oldData.pop();
    } while (oldData.length > 0 && oldData[oldData.length - 1].number >= newItem.number);

    newChapters.value!.links.next = null;
    oldChapters.value!.links.next = null;
}

</script>

<template>
    <div class="root w-full border-[1px]">
        <List :chapters="newChapters?.data" :series="series" />

        <ListDrawer :progress="progress" @load-new="loadNew" @load-old="loadOld"
            :old-disabled="!Boolean(oldChapters?.links.next)" :new-disabled="!Boolean(newChapters?.links.next)" />

        <List :chapters="oldChapters?.data" :series="series" revers />
    </div>
</template>
