<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Chapter, Series } from '@/types';
import { onMounted, ref } from 'vue';
import PageToolsBar from './ChapterPageToolsBar.vue';
import ArrowCollapseDownIcon from 'vue-material-design-icons/ArrowCollapseDown.vue';
import IconButton from '@/Components/IconButton.vue';
import PublishChapterButton from '@/Components/Actions/PublishChapterButton.vue';

const props = defineProps<{
    chapter: Chapter,
    next: number | null,
    prev: number | null,
    series: Series,
}>();

const data = ref<Array<string>>([]);
const hidden = ref<boolean>(false);
const refChapter = ref(props.chapter);

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

const handleVisibilityClick = () => {
    hidden.value = !hidden.value;
}

const handlePublished = (v: Chapter) => {
    refChapter.value = v;
}
</script>

<template>
    <AppLayout :title="chapter.series" :hideAppBar="hidden">
        <div class="w-full flex sticky top-9 sm:top-14 items-center justify-center mb-5 ">
            <PageToolsBar class="transition-transform" :style="{ transform: `translateY(${hidden ? -500 : 0}%)`, }"
                :series="series" :chapter="chapter" :next="next" :prev="prev" />
            <IconButton @click="handleVisibilityClick" :title="hidden ? 'show' : 'hide'" class="transition-transform"
                :style="{ transform: `rotate(${hidden ? 0 : 180}deg)` }">
                <ArrowCollapseDownIcon size="20" />
            </IconButton>
        </div>

        <div class="w-full flex flex-col items-center">
            <img class="max-w-4xl mb-3" v-for="(item, index) in data" :key="index" :src="item" />
            <CircularProgress class="size-24" v-if="data.length != chapter.pages.length" />
        </div>
        <PublishChapterButton class="w-1/2" :series="series" :chapter="refChapter" @change="handlePublished" />
    </AppLayout>
</template>