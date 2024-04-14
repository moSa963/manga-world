<script setup lang="ts">
import ClickScale from '../Effects/ClickScale.vue';
import ListItem from '../ListItem.vue';

defineProps<{
    src?: string,
    title: string,
    secondary: string,
}>();

defineEmits<{
    click: [],
}>();

</script>


<template>
    <ListItem @click="$emit('click')" :scale="0.99" :src="src" :title="title" :secondary="secondary" />
</template>
