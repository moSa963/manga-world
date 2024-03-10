<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Chapter, Series } from '@/types';
import { ref } from 'vue';

const props = defineProps<{
    chapter: Chapter,
    series: Series,
}>();

const data = ref<Array<string>>([]);

</script>

<template>
    <AppLayout :title="chapter.series">
        <img v-for="(item, index) in data" :key="index" :src="item" />
        <CircularProgress class="size-24" v-if="data.length != chapter.pages.length" />
    </AppLayout>
</template>