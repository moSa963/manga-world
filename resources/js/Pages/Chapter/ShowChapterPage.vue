<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Chapter, Series } from '@/types';
import { ref } from 'vue';
import PageToolsBar from './ChapterPageToolsBar.vue';
import PagesList from './PagesList.vue';
import ArrowCollapseDownIcon from 'vue-material-design-icons/ArrowCollapseDown.vue';
import IconButton from '@/Components/IconButton.vue';
import PublishChapterButton from '@/Components/Actions/PublishChapterButton.vue';
import CommentsList from './CommentsList.vue';
import Button from '@/Components/ButtonGroup/Button.vue';

const props = defineProps<{
    chapter: Chapter,
    next: number | null,
    prev: number | null,
    series: Series,
}>();

const hidden = ref<boolean>(false);
const refChapter = ref(props.chapter);
const commentsOpen = ref(false);

const handleVisibilityClick = () => {
    hidden.value = !hidden.value;
}

const handlePublished = (v: Chapter) => {
    refChapter.value = v;
}

const handleOpenComments = () => {
    commentsOpen.value = !commentsOpen.value;
}
</script>

<template>
    <AppLayout :title="chapter.series" :hideAppBar="hidden">
        <div class="w-full flex sticky top-9 sm:top-14 items-center justify-center mb-5 z-10">
            <PageToolsBar class="transition-transform" :style="{ transform: `translateY(${hidden ? -500 : 0}%)`, }"
                :series="series" :chapter="chapter" :next="next" :prev="prev">
                <Button @click="handleOpenComments">
                    <p>{{ commentsOpen ? 'Pages' : 'Comments' }}</p>
                </Button>
            </PageToolsBar>
            <IconButton @click="handleVisibilityClick" :title="hidden ? 'show' : 'hide'" class="transition-transform"
                :style="{ transform: `rotate(${hidden ? 0 : 180}deg)` }">
                <ArrowCollapseDownIcon size="20" />
            </IconButton>
        </div>

        <CommentsList v-if="commentsOpen" :chapter="chapter" :series="series" />
        <div v-else class="w-full flex flex-col items-center ">
            <PublishChapterButton class="w-1/2 mb-5" :series="series" :chapter="refChapter" @change="handlePublished" />
            <PagesList :chapter="chapter" :series="series" />
        </div>

    </AppLayout>
</template>