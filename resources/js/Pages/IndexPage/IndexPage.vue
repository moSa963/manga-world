<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

</script>

<template>
    <AppLayout>

        <Head title="Welcome" />
    </AppLayout>
</template>

<style></style>