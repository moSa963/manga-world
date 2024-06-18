<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import { Chapter, Series } from '@/types';
import { onMounted, ref } from 'vue';

const props = defineProps<{
    chapter: Chapter,
    series: Series,
}>();

const data = ref<Array<string>>([]);

const loadData = async () => {

    for (var page of props.chapter.pages) {
        const res = await fetch(route("page.show", {
            series: props.series.id,
            chapter: props.chapter.number,
            page: page.number,
        }));

        if (!res.ok) return;

        const blob = await res.blob();

        data.value.push(URL.createObjectURL(blob));
    }

}

onMounted(loadData);

</script>

<template>
    <div class="w-full flex flex-col items-center">
        <img class="max-w-4xl mb-3" v-for="(item, index) in data" :key="index" :src="item" />
        <CircularProgress class="size-24" v-if="data.length != chapter.pages.length" />
    </div>
</template>