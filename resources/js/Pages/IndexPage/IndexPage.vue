<script setup lang="ts">
import Viewer from '@/Components/ListViewer/ListViewer.vue';
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import SeriesViewer from './SeriesViewer.vue';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

</script>

<template>
    <AppLayout title="Home">

        <SeriesViewer />

    </AppLayout>
</template>

<style></style>
