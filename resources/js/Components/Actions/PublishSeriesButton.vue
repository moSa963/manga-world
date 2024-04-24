<script setup lang="ts">
import { Series } from '@/types';
import Button from '../ButtonGroup/Button.vue';
import apiRequest from '@/utils/ApiRequest';

const props = defineProps<{
    series: Series,

}>();

const emit = defineEmits<{
    change: [series: Series],
}>();

const handleClick = async () => {
    if (props.series.published) {
        return;
    }

    const res = await apiRequest(route('api.series.publish', { series: props.series.id }));

    if (res.ok) {
        emit('change', (await res.json()).data);
    }
}

</script>


<template>
    <Button @click="handleClick" :border="true" :value="series.published ? 'published' : 'publish'"
        :disabled="series.published" />
</template>