<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Chapter, Series } from '@/types';
import { onMounted, ref } from 'vue';
import PageToolsBar from './ChapterPageToolsBar.vue';
import PagesList from './PagesList.vue';
import ArrowCollapseDownIcon from 'vue-material-design-icons/ArrowCollapseDown.vue';
import IconButton from '@/Components/IconButton.vue';
import PublishChapterButton from '@/Components/Actions/PublishChapterButton.vue';

const props = defineProps<{
    chapter: Chapter,
    next: number | null,
    prev: number | null,
    series: Series,
}>();

const hidden = ref<boolean>(false);
const refChapter = ref(props.chapter);

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

        <PagesList :chapter="chapter" :series="series" />

        <PublishChapterButton class="w-1/2" :series="series" :chapter="refChapter" @change="handlePublished" />
    </AppLayout>
</template>