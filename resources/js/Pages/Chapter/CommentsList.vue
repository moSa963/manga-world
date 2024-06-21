<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import { Chapter, Comment, Response, Series } from '@/types';
import fetchList from '@/utils/FetchList';
import { onMounted, ref } from 'vue';
import CommentItem from './CommentItem.vue';
import CommentInputCard from './CommentInputCard.vue';
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';

const props = defineProps<{
    chapter: Chapter,
    series: Series,
}>();

const data = ref<Response<Comment>>();
const progress = ref<boolean>(false);
const circularProgress = ref<HTMLDivElement>();

onMounted(async () => {
    await getData();
});

const handleCommentCreated = (comment: Comment) => {
    if (data.value?.data) {
        data.value.data = [comment, ...data.value.data]
    }
}

const getData = async (reset?: boolean) => {
    const url = (data.value && !reset) ? data.value.links.next : route('api.chapter.comments.list', {
        series: props.series.id,
        chapter: props.chapter.number,
    });

    await fetchList(data, url, progress, reset);
}

const handleChange = (scroll: ScrollType) => {
    if ((circularProgress.value?.offsetTop || 0) - scroll.value < scroll.innerHeight) {
        getData();
    }
}

</script>

<template>
    <WindowScroll @change="handleChange">
        <div class="w-full flex flex-col items-center gap-4">
            <CommentInputCard :chapter="chapter" :series="series" @created="handleCommentCreated" />
            <CommentItem v-if="data" v-for="v in data.data" :key="v.id" :comment="v" />
            <CircularProgress class="size-24" v-if="data?.links.next" ref="circularProgress" />
        </div>
    </WindowScroll>
</template>