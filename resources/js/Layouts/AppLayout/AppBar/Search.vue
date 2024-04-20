<script setup lang="ts">
import SearchBar from '@/Components/SearchBar/SearchBar.vue';
import SearchCard from '@/Components/SearchBar/SearchCard.vue';
import SearchCardItem from '@/Components/SearchBar/SearchCardItem.vue';
import { Response, Series } from '@/types';
import fetchList from '@/utils/FetchList';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const series = ref<Response<Series> | null>(null);

const props = defineProps<{
    open: boolean,
}>();

const emits = defineEmits<{
    openChange: [boolean],
}>();

const handleOpenChange = () => {
    emits("openChange", !props.open);
}

const handleChange = async (value: string) => {
    series.value = null;
    if (!value && value.length <= 0) return;
    await loadData(value);
}

const loadData = async (key: string) => {
    await fetchList(series, route("api.series.list", { key, count: 5 }));
}

const handleClick = (series: Series) => {
    router.get(route('series.show', {
        series: series.id,
    }));
}
</script>


<template>
    <SearchBar :open="open" @status-change="handleOpenChange" @change="handleChange">
        <SearchCard v-if="Boolean(series?.data)">
            <SearchCardItem v-for="s in series?.data" :key="s.id" :title="s.title" :secondary="s.author"
                :src="route('api.series.poster', s.id)" @click="() => handleClick(s)" />
        </SearchCard>
    </SearchBar>
</template>