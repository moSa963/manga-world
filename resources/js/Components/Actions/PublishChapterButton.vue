<script setup lang="ts">
import { Chapter, Series } from '@/types';
import Button from '../ButtonGroup/Button.vue';
import apiRequest from '@/utils/ApiRequest';
import { hasPermission } from '@/utils/Permissions';

const props = defineProps<{
    series: Series,
    chapter: Chapter
}>();

const emit = defineEmits<{
    change: [chapter: Chapter],
}>();

const handleClick = async () => {
    if (props.chapter.published) {
        return;
    }

    const res = await apiRequest(route('api.chapter.publish', { series: props.series.id, chapter: props.chapter.number }));

    if (res.ok) {
        emit('change', (await res.json()).data);
    }
}

</script>


<template>
    <Button v-if="hasPermission($page.props.auth.user, 'approve')" @click="handleClick" :border="true"
        :value="chapter.published ? 'published' : 'publish'" :disabled="chapter.published" />
</template>