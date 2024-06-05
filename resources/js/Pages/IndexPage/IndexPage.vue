<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import SeriesViewer from './SeriesViewer.vue';
import SeriesList from './SeriesList/SeriesList.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import { hasPermission } from '@/utils/Permissions';
import { User } from '@/types';

defineProps<{
    auth: {
        user: User
    };
}>();

</script>

<template>
    <AppLayout title="Home">

        <SeriesViewer />


        <div class="w-full flex pt-20 flex-col-reverse md:flex-row gap-4">
            <div class="flex-1 px-4">
                <SeriesList title="Shonen" genre="shonen" />
                <hr />
                <SeriesList title="Comedy" genre="comedy" />
                <hr />
                <SeriesList title="Action" genre="action" />
            </div>
            <div class="w-full md:w-64">
                <Link v-if="hasPermission(auth.user, 'admin')" :href="route('admin.users.list')">
                <Button border>
                    <p>Admin</p>
                </Button>
                </Link>
            </div>
        </div>

    </AppLayout>
</template>

<style></style>
