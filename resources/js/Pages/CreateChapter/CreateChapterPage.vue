<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Series, User } from '@/types';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    series: Series,
    auth: {
        user: User
    }
}>();

const form = useForm({

});

</script>


<template>
    <AppLayout title="Add chapter">

    </AppLayout>
</template>
